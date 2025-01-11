<script>
import {useForm} from "@inertiajs/vue3";
import Swal from "sweetalert2";

export default {
    name: 'LessonsIndex',
    data: () => ({
        itemsPerPage: null,
        headers: [
            {title: 'ID', key: 'id', align: 'left', sortable: true},
            {title: 'Name', key: 'name', align: 'left', sortable: true},
            {title: 'Description', key: 'description', sortable: false},
            {title: 'Level', key: 'level_name', sortable: false},
            {title: 'Free', key: 'is_free', sortable: false},
            {title: 'Image', key: 'image_uri', sortable: false},
            {title: 'Content', key: 'content_uri', sortable: false},
            {title: 'PDF', key: 'pdf_uri', sortable: false},
        ],
        newLessonDialog: false,
        newLessonForm: useForm({
            id: null,
            name: '',
            description: '',
            image_uri: '',
            content_uri: '',
            pdf_uri: '',
            level_id: '',
            is_free: '',
        }),
        isFree: [
            {name: 'Yes', value: true},
            {name: 'No', value: false}
        ]
    }),
    methods: {
        submitNewLesson() {
            if (!this.newLessonForm.id) {
                console.log(this.selected)
                this.newLessonForm.post(route('lessons.store'), {
                    onSuccess: () => {
                        this.newLessonDialog = false;
                        Swal.fire({
                            title: "Lesson created sucessfully",
                            text: "Lesson has been created successfully",
                            icon: "success",
                            confirmButtonText: "Close"
                        })
                    },
                    onError: (error) => {
                        this.newLessonDialog = false;
                        Swal.fire({
                            title: "Error while creating lesson",
                            text: error.name,
                            icon: "success",
                            confirmButtonText: "Close"
                        })
                    }
                })
            }
        }
    },
    watch: {
        newLessonDialog(value) {
            if (!value) {
                this.newLessonForm.reset();
            }
        }
    }

}
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";

defineProps({
    lessons: {
        type: Object,
        required: true
    },
    levels: {
        type: Object,
        required: true
    },


})

</script>

<template>
    <app-layout title="Lessons">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
                Lessons
            </h2>
            <v-dialog
                v-model="newLessonDialog"
                max-width="600">

                <template v-slot:activator="{ props: activatorProps }">
                    <v-row align="end" justify="end" class="mb-2">
                        <v-btn
                            color="success"
                            v-bind="activatorProps"
                            prepend-icon="mdi-plus"
                        >Create Lesson
                        </v-btn>
                    </v-row>
                </template>

                <v-card>
                    <v-card-title>
                        <v-col v-if="!newLessonForm.id" cols="auto">Create Lesson</v-col>
                        <v-col v-else cols="auto">Edit Lesson</v-col>
                    </v-card-title>

                    <v-card-text>
                        <form @submit.prevent="submitNewLesson">

                            <input-label for="id" value="Id" v-if="newLessonForm.id"/>
                            <v-text-field
                                id="id"
                                v-model="newLessonForm.id"
                                variant="outlined"
                                disabled
                                placeholder="Id"
                                v-if="newLessonForm.id"
                            />

                            <input-label for="name" value="Name"/>
                            <v-text-field
                                id="name"
                                v-model="newLessonForm.name"
                                variant="outlined"
                                placeholder="Name"
                                clearable
                            />

                            <input-label for="description" value="Description"/>
                            <v-textarea
                                id="description"
                                v-model="newLessonForm.description"
                                variant="outlined"
                                placeholder="Description"
                                clearable
                            />
                            <v-row>
                                <v-col cols="4">
                                    <input-label for="level_id" value="Level"/>
                                    <v-autocomplete
                                        id="level_id"
                                        v-model="newLessonForm.level_id"
                                        :items="levels"
                                        item-title="name"
                                        item-value="id"
                                        variant="outlined"
                                    />
                                </v-col>
                                <v-col cols="4">
                                    <input-label for="is_free" value="Is Free"/>
                                    <v-autocomplete
                                        id="is_free"
                                        v-model="newLessonForm.is_free"
                                        :items="isFree"
                                        item-title="name"
                                        item-value="value"
                                        variant="outlined"
                                    />
                                </v-col>
                            </v-row>

                            <v-row align="end" justify="end">
                                <v-col cols="auto">
                                    <v-btn type="submit" block color="primary">
                                        <span v-if="newLessonForm.id">Edit</span>
                                        <span v-else>Create</span>
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </form>
                    </v-card-text>
                </v-card>

            </v-dialog>

            <v-data-table-server
                :items-per-page="itemsPerPage"
                :headers="headers"
                :items="Object.values(lessons.data)"
                :items-length="lessons.total"
            >
                <template v-slot:item.is_free="{ item }">
                    <v-icon v-if="item.is_free === true"> mdi-check-circle</v-icon>
                    <v-icon v-if="item.is_free === false"> mdi-close-circle</v-icon>
                </template>
            </v-data-table-server>

        </template>
    </app-layout>
</template>
