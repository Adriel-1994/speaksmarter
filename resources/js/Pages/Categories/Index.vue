<script>

export default {
    name: 'CategoriesIndex',
    data: () => ({
        headers: [
            {title: 'ID', key: 'id', align: 'left', sortable: true},
            {title: 'Name', key: 'name', align: 'left', sortable: true},
            {title: 'Actions', key: 'actions', sortable: false},
        ],
        itemsPerPage: 5,
        itemsPerPageOptions: [
            {title: '5', value: '5'},
            {title: '10', value: '10'},
            {title: '20', value: '20'},
            {value: -1, title: '$vuetify.dataFooter.itemsPerPageAll'}
        ]
    }),
    methods: {
        editItem(item) {
            console.log("Editar:", item);
        },
        deleteItem(item) {
            console.log("Eliminar:", item);
        },
    }
}
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from "@inertiajs/vue3";

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

            <v-container>
                <v-row>
                    <v-col>
                        <Link :href="route('categories.index')">
                            <v-btn
                                prepend-icon="mdi-plus"
                                color="success">
                                Create Category
                            </v-btn>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>

            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="Object.values(categories.data)"
                :items-length="categories.total"
                :items-per-page-options="itemsPerPageOptions">
                <template v-slot:item.actions="{ item }">
                    <v-btn
                        class="m-2"
                        icon="mdi-delete"
                        color="error"
                        @click="deleteItem(item)">
                    </v-btn>
                    <v-btn
                        class="m-2"
                        icon="mdi-pencil"
                        @click="editItem(item)"
                        color="primary">
                    </v-btn>
                </template>

            </v-data-table>

        </template>
    </AppLayout>
</template>
