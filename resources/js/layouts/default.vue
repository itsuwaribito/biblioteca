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

                <v-list>
                    <v-list-tile @click="$router.push({ name: 'Home'})">
                        <v-list-tile-action>
                            <v-icon>dashboard</v-icon>
                        </v-list-tile-action>
                    
                        <v-list-tile-content>
                            <v-list-tile-title>Inicio</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile @click="$router.push({ name: 'Libros'})">
                        <v-list-tile-action>
                            <v-icon>book</v-icon>
                        </v-list-tile-action>
                    
                        <v-list-tile-content>
                            <v-list-tile-title>Libros</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile @click="$router.push({ name: 'Alumnos'})">
                        <v-list-tile-action>
                            <v-icon>people</v-icon>
                        </v-list-tile-action>
                    
                        <v-list-tile-content>
                            <v-list-tile-title>Alumnos</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile @click="$router.push({ name: 'Estantes'})">
                        <v-list-tile-action>
                            <v-icon>apps</v-icon>
                        </v-list-tile-action>
                    
                        <v-list-tile-content>
                            <v-list-tile-title>Estantes</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-navigation-drawer>
            <v-toolbar app fixed>
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <v-toolbar-title>Biblioteca de libros</v-toolbar-title>

                <v-spacer></v-spacer>
                
                
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn
                        flat
                        :ripple="false"
                    >
                        Nombre del bato
                    </v-btn>
                </v-toolbar-items>
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn flat @click="logout">Cerrar sesion</v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <v-content>
                <v-container fluid>
                    <router-view></router-view>
                </v-container>
            </v-content>
            <v-footer app></v-footer>
        </v-app>
    </div>
</template>

<script>
export default {
    data: () => ({
        drawer: false
      }),
    methods: {
        logout() {
            axios.post('/logout')
            .then((response) => {
                if(response.status == 200) {
                    window.location.assign('/')
                }
            })
        }
    }
}
</script>
