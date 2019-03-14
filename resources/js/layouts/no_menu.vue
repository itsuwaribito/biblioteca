<template>
    <v-app>
        <v-toolbar app fixed>
            <v-toolbar-title>Biblioteca de libros</v-toolbar-title>

            <v-spacer></v-spacer>
        </v-toolbar>
        <v-content>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</template>

<script>
export default {
    data: () => ({

      }),
}
</script>
