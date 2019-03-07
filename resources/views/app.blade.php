<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        {{--  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">  --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      
    </head>
    <body>
        <div id="app">
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
                        <v-list-tile @@click="$router.push({ name: 'Home'})">
                            <v-list-tile-action>
                                <v-icon>dashboard</v-icon>
                            </v-list-tile-action>
                        
                            <v-list-tile-content>
                                <v-list-tile-title>Inicio</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile @@click="$router.push({ name: 'Libros'})">
                            <v-list-tile-action>
                                <v-icon>book</v-icon>
                            </v-list-tile-action>
                        
                            <v-list-tile-content>
                                <v-list-tile-title>Libros</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile @@click="">
                            <v-list-tile-action>
                                <v-icon>people</v-icon>
                            </v-list-tile-action>
                        
                            <v-list-tile-content>
                                <v-list-tile-title>Alumnos</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile @@click="">
                            <v-list-tile-action>
                                <v-icon>apps</v-icon>
                            </v-list-tile-action>
                        
                            <v-list-tile-content>
                                <v-list-tile-title>Ubicaciones</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-navigation-drawer>
                <v-toolbar app fixed>
                    <v-toolbar-side-icon @@click.stop="drawer = !drawer"></v-toolbar-side-icon>
                    <v-toolbar-title>{{ config('app.name') }}</v-toolbar-title>

                    <v-spacer></v-spacer>
                    <v-toolbar-items class="hidden-sm-and-down">
                        <v-btn flat>Link One</v-btn>
                        <v-btn flat>Link Two</v-btn>
                        <v-btn flat>Link Three</v-btn>
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

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
