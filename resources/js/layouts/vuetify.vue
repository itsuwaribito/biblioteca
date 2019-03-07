<template>
    <div>
        <v-app>
                <v-navigation-drawer
                    app
                    v-model="drawer"
                    dark
                    
                >
                    <v-toolbar flat>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-title class="title">
                                UNIDEP
                                </v-list-tile-title>
                            </v-list-tile>
                        </v-list>
                    </v-toolbar>
              
                    {{--  <v-divider></v-divider>  --}}

                    <v-list>
                        <v-list-tile @@click="">
                            <v-list-tile-action>
                                <v-icon>dashboard</v-icon>
                            </v-list-tile-action>
                        
                            <v-list-tile-content>
                                <v-list-tile-title>Inicio</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile @@click="">
                            <v-list-tile-action>
                                <v-icon>question_answer</v-icon>
                            </v-list-tile-action>
                        
                            <v-list-tile-content>
                                <v-list-tile-title>Acerca de</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-navigation-drawer>
                <v-toolbar app top>
                    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                    <v-toolbar-title>{{ config('app.name') }}</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-btn flat>Link One</v-btn>
                    <v-btn flat>Link Two</v-btn>
                    <v-btn flat>Link Three</v-btn>
                </v-toolbar>
                <v-content>
                    <v-container fluid>
                        <router-view></router-view>
                    </v-container>
                </v-content>
                <!-- <v-footer app></v-footer> -->
            </v-app>
    </div>
</template>

<script>
export default {
    data: () => ({
        drawer: false
      }),
}
</script>
