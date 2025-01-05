<script setup>
</script>

<template>
    <v-card>
        <v-card-title >Management options</v-card-title>
        <v-container>
            <v-row class="mb-6 ml-2" v-if="$page.props.user.permissions.includes('create roles')">
                <v-btn prepend-icon="$vuetify">
                    Manage roles
                </v-btn>
            </v-row>
            <v-row class="mb-6 ml-2" v-if="$page.props.user.permissions.includes('create lessons')">
                <v-btn prepend-icon="$vuetify">
                    Manage lessons
                </v-btn>
            </v-row>
        </v-container>
    </v-card>
</template>
