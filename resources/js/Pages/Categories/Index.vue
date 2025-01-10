<script>
import Swal from "sweetalert2";
import {router, useForm} from "@inertiajs/vue3";

export default {
    name: 'CategoriesIndex',
    data: () => ({
        headers: [
            {title: 'ID', key: 'id', align: 'left', sortable: true},
            {title: 'Name', key: 'name', align: 'left', sortable: true},
            {title: 'Actions', key: 'actions', sortable: false},
        ],
        itemsPerPage: null,
        page: null,
        canUpdate: false,
        loading: false,
        newCategoryForm: useForm({
            id: null,
            name: ''
        }),
        newCategoryDialog: false,
    }),
    methods: {
        fetchCategories(params) {
            let isSamePage = this.page === params.page;
            let isSameItemsPerPage = this.itemsPerPage === params.itemsPerPage;

            if (this.canUpdate && (!isSamePage || !isSameItemsPerPage)) {
                this.loading = true;
                router.get('/categories', params);
            }
        },
        editItem(category) {
            this.newCategoryForm.id = category.id;
            this.newCategoryForm.name = category.name;
            this.newCategoryDialog = true;
        },
        deleteItem(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "No, cancel",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('categories.destroy', id), {
                        onSuccess: () => {
                            Swal.fire({
                                title: "Category deleted",
                                text: "Category has been deleted successfully",
                                icon: "success",
                                confirmButtonText: "Close"
                            })
                        },
                        onError: (errors) => {
                            Swal.fire({
                                title: "Error deleting category",
                                text: JSON.stringify(errors),
                                icon: "error",
                                confirmButtonText: "Close"
                            })
                        }
                    })
                }
            })
        },
        submitNewCategory() {
            if (this.newCategoryForm.id) {
                this.newCategoryForm.put(route('categories.update', this.newCategoryForm.id), {
                    onSuccess: () => {
                        this.newCategoryDialog = false;

                        Swal.fire({
                            title: "Category updated",
                            text: "Category has been updated successfully",
                            icon: "success",
                            confirmButtonText: "Close"
                        })
                    },
                    onError: (errors) => {
                        this.newCategoryDialog = false;

                        Swal.fire({
                            title: "Error updating category",
                            text: errors.name,
                            icon: "error",
                            confirmButtonText: "Close"
                        })
                    }
                })
            } else {
                this.newCategoryForm.post(route('categories.store'), {
                    onSuccess: () => {
                        this.newCategoryDialog = false;

                        Swal.fire({
                            title: "Category created",
                            text: "Category has been created successfully",
                            icon: "success",
                            confirmButtonText: "Close"
                        })
                    },
                    onError: (errors) => {
                        this.newCategoryDialog = false;

                        Swal.fire({
                            title: "Error creating category",
                            text: errors.name,
                            icon: "error",
                            confirmButtonText: "Close"
                        })
                    }
                })
            }
        }
    },
    watch: {
        newCategoryDialog(value) {
            if (!value) {
                this.newCategoryForm.reset();
            }
        }
    },
    mounted() {
        this.page = this.categories.current_page ?? 1;
        this.itemsPerPage = this.categories.per_page ?? 10;
        this.$nextTick(() => {
            this.canUpdate = true;
        })
    }
}
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";

defineProps({
    categories: {
        type: Object,
        required: true
    }

})

</script>


<template>
    <AppLayout title="Categories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
                Categories
            </h2>
            <!--            Dialog-->
            <v-dialog v-model="newCategoryDialog" max-width="600">
                <template v-slot:activator="{ props: activatorProps}">
                    <v-row align="end" justify="end">
                        <v-btn v-if="$page.props.user.permissions.includes('create categories')"
                               prepend-icon="mdi-plus"
                               color="success"
                               v-bind="activatorProps">
                            Create Category
                        </v-btn>
                    </v-row>
                </template>
                <v-card>
                    <v-card-title class="d-flex justify-space-between align-center">
                        <div>
                            <template v-if="newCategoryForm.id">
                                <v-icon icon="mdi-tag-edit"/>
                                Edit category
                            </template>
                            <template v-else>
                                <v-icon icon="mdi-tag-plus"/>
                                Create category
                            </template>
                        </div>
                        <v-btn icon="mdi-close" variant="text" @click="newCategoryDialog=false"></v-btn>
                    </v-card-title>
                    <v-card-text>
                        <form @submit.prevent="submitNewCategory">
                            <input-label for="id" value="Id" v-if="newCategoryForm.id"/>

                            <v-text-field
                                id="id"
                                v-model="newCategoryForm.id"
                                variant="outlined"
                                disabled
                                placeholder="Id"
                                v-if="newCategoryForm.id"/>

                            <input-label for="name" value="Name"/>

                            <v-text-field
                                id="name"
                                v-model="newCategoryForm.name"
                                required
                                hint="Insert the category name"
                                variant="outlined"
                                placeholder="Name"/>
                            <v-row align="end" justify="end">
                                <v-col cols="auto">
                                    <v-btn class="mt-2" color="primary" type="submit" block>
                                        <span v-if="newCategoryForm.id">Edit</span>
                                        <span v-else>Create</span>
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </form>
                    </v-card-text>
                </v-card>
            </v-dialog>

            <!--            data table-->
            <v-data-table-server
                :items-per-page="itemsPerPage"
                :headers="headers"
                :items="Object.values(categories.data)"
                :page="page"
                :items-length="categories.total"
                :loading="loading"
                @update:options="fetchCategories">
                <template v-slot:item.actions="{ item }">
                    <v-btn v-if="$page.props.user.permissions.includes('delete categories')"
                           class="m-2"
                           icon="mdi-delete"
                           color="error"
                           @click="deleteItem(item.id)">
                    </v-btn>
                    <v-btn v-if="$page.props.user.permissions.includes('update categories')"
                           class="m-2"
                           icon="mdi-pencil"
                           @click="editItem(item)"
                           color="primary">
                    </v-btn>
                </template>
            </v-data-table-server>

        </template>
    </AppLayout>
</template>
