<script>
export default {
    name: 'CategoriesIndex',
    data: () => ({
        headers: [
            {title: 'ID', key: 'id', align: 'left', sortable: true},
            {title: 'Name', key: 'name', align: 'left', sortable: true},
            {title: 'Actions', key: 'actions', sortable: false},
        ],
        itemsPerPage: 3
    })
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
                    <!--                    <v-col cols="auto">-->
                    <!--                        <v-btn color="error">Delete Category</v-btn>-->
                    <!--                    </v-col>-->
                    <!--                    <v-col cols="auto">-->
                    <!--                        <v-btn color="primary">Modify Category</v-btn>-->
                    <!--                    </v-col>-->
                    <v-col cols="auto">
                        <Link :href="route('categories.index')">
                            <v-btn color="success">Create Category</v-btn>
                        </Link>
                    </v-col>
                </v-row>
            </v-container>

            <v-data-table-server
                :items-per-page="itemsPerPage"
                :headers="headers"
                :items="Object.values(categories.data)"
                :items-length="categories.total">
                <template v-slot:item.actions="{ item }">
                    <v-icon
                        class="me-2 text-black"
                        @click=""
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        class="text-black"
                        @click=""
                    >
                        mdi-delete
                    </v-icon>
                </template>

            </v-data-table-server>

        </template>
    </AppLayout>
</template>
