<template>
    <v-layout>
        <v-flex xs12 sm10 offset-sm1>
                    <h2>Buscar libro</h2>
            <v-layout class="mb-3">
                <v-flex xs12 sm12 md6>
                    <v-text-field
                        label="Busqueda..."
                        prepend-icon="search"
                        :loading="searching"
                        v-model="search"
                        v-on:keyup="searchBook"

                    ></v-text-field>
                </v-flex>
            </v-layout>
            <v-layout row wrap>
                <v-flex sm12 v-if="bookList.length == 0" class="">
                    <h4 color="grey lighten-1">Sin libros para mostrar</h4>
                </v-flex>
                <v-flex pa-4 d-flex xs12 sm6 md4 lg3 v-for="libro in bookList" :key="libro.id">
                    <v-card width="350" light color="#E7E7E7">

                        <v-img
                            height="250"
                            
                            :src="getBookURL(libro.imagen)"
                        >
                            <v-container fill-height fluid>
                                <v-layout fill-height>
                                    <v-flex xs12 align-end flexbox>
                                        <span class="headline">{{ libro.titulo }}</span>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-img>

                        <v-card-title primary-title>
                            <div>
                                <h4 class="mb-0 grey--text">{{ libro.autor }}</h4>
                                <div> {{ libro.editorial }} </div>
                            </div>
                        </v-card-title>

                        <v-card-actions>
                            <v-flex>
                                <v-btn
                                    bottom
                                    flat
                                    color="orange"
                                    :disabled="libro.existencia == 0"
                                    @click="showPrestamo(libro)"
                                >Préstamo</v-btn>
                                <v-btn
                                    bottom
                                    flat
                                    color="orange"
                                    class="ml-0"
                                    @click="showDevolucion(libro)"
                                >Devoución</v-btn>
                            </v-flex>
                            <v-layout justify-end>
                                <v-chip color="orange" text-color="white">{{ libro.existencia }}/{{libro.cantidad}}</v-chip>
                            </v-layout>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>

        <v-dialog v-model="modal.devolucion" max-width="800px">
            <v-card>
                <v-container>
                    <v-toolbar-title>Devolucion de libros</v-toolbar-title>
                    <v-layout wrap>
                        <v-flex xs12 sm12>
                            <v-list>
                                <template v-for="(alumno,index) in alumnos">
                                    <v-list-tile
                                        :key="alumno.id"
                                    >
                                        <v-list-tile-action>
                                            <v-checkbox
                                                v-model="selected.devolucion"
                                                :value="alumno.id"
                                                :label="alumno.full_name"
                                            ></v-checkbox>
                                        </v-list-tile-action>
                                    </v-list-tile>
                                    <v-divider :key="index" v-if="index + 1 < alumnos.length" class="ma-0"></v-divider>
                                </template>
                            </v-list>
                        </v-flex>
                    </v-layout>
                </v-container>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat :loading="saving" @click="setDevolucion">Guardar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-dialog v-model="modal.prestamo" max-height="500px" max-width="800px">
        <v-card>
            <v-container>
                <v-toolbar-title>Prestamo de libros</v-toolbar-title>
                <v-layout row>
                    <v-flex xs12 sm12>
                        <v-text-field
                            label="Busqueda..."
                            prepend-icon="search"
                            v-model="search_alumno"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex sx12 sm12>
                        <v-textarea
                            label="Observaciones"
                            rows="2"
                            v-model="observaciones"
                        ></v-textarea>
                    </v-flex>
                </v-layout>
                <v-responsive max-height="400px" class="overflow-y-display">
                        <v-list>
                            <template v-for="(alumno,index) in filtered_alumnos">
                                <v-list-tile
                                    :key="alumno.id"
                                >
                                    <v-list-tile-action>
                                        <v-checkbox
                                            v-model="selected.prestamo"
                                            :value="alumno.id"
                                        ></v-checkbox>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>{{alumno.numero_control}}</v-list-tile-title>
                                        <v-list-tile-sub-title>{{alumno.full_name}}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider :key="index" v-if="index + 1 < filtered_alumnos.length"></v-divider>
                            </template>
                        </v-list>
                </v-responsive>
            </v-container>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat :loading="saving" @click="setPrestamo">Guardar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-snackbar
      v-model="snackbar.visible"
      :bottom="true"
    >
      {{ error_text}}
      <v-btn
        color="pink"
        flat
        @click="snackbar = false"
      >
        Cerrar
      </v-btn>
    </v-snackbar>

    </v-layout>
</template>

<script>
    import helper from './../helper.js'
    export default {
        created() {
            this.getAllAlumnos()
        },
        data () {
            return {
                snackbar: {
                    visible: false,
                    prestamo: true
                },
                observaciones: 'Libro en buenas condiciones',
                elLibro: {
                    alumnos_pendientes: [],
                    alumnos_no_pendientes: []
                },
                bookList: [],
                search: '',
                search_alumno: '',
                searching: false,
                modal: {
                    devolucion: false,
                    prestamo: false
                },
                alumnos: [],
                todos_alumnos: [],
                selected: {
                    devolucion: [],
                    prestamo: []
                },
                saving: false
            }
        },
        computed: {
            filtered_alumnos() {
                return this.todos_alumnos.filter((alumno) => {
                    if(this.search_alumno.length == 0)
                        return true

                    return (alumno.full_name.toLowerCase().indexOf(this.search_alumno.toLowerCase()) != -1 || alumno.numero_control.indexOf(this.search_alumno) != -1)
                }).filter((alumno) => {
                    var temp = this.pluck(this.elLibro.alumnos_pendientes, 'id')
                    return !temp.includes(alumno.id)
                })
            },
            error_text() {
                return this.snackbar.prestamo ? 'No se cuenta con suficientes libros para prestar' : 'Error en el servidor'
            }
        },
        methods: {
            searchBook: helper.debounce(async function () {
                if(this.search.length > 3) {
                    this.searching = true
                    const response = await axios.get('/api/catalogos/libros',{
                        params: {
                            search: this.search,
                            all: false
                        }
                    })
                    this.bookList = response.data
                    this.searching = false
                } else {
                    this.bookList = []
                }
                this.search_alumno = ''
                this.selected = {
                    devolucion: [],
                    prestamo: []
                }
            },250),
            getBookURL(imagen) {
                return (imagen == null) ? '/img/noimage.jpg' : imagen
            },
            showPrestamo(libro) {
                this.elLibro = libro
                this.modal.prestamo = true
            },
            showDevolucion(libro) {
                this.elLibro = libro
                this.alumnos = libro.alumnos_pendientes
                this.modal.devolucion = true
            },
            async getAllAlumnos() {
                const {data} = await axios.get('/api/catalogos/alumnos')
                this.todos_alumnos = data
            },
            async setDevolucion() {
                this.saving = true
                try {
                    const {data} = await axios.post(`/api/libros/${this.elLibro.id}/devolucion`, {
                        alumnos: this.selected.devolucion
                    })
                } catch(e) {
                    this.snackbar.visible = true
                    this.snackbar.prestamo = false
                }
                this.saving = false
                this.modal.devolucion = false
                this.searchBook()
            },
            async setPrestamo() {
                this.saving = true
                try {
                    const {data} = await axios.post(`/api/libros/${this.elLibro.id}/prestamo`, {
                        alumnos: this.selected.prestamo,
                        observaciones: this.observaciones
                })
                } catch(e) {
                    this.snackbar.visible = true
                    this.snackbar.prestamo = true
                }
                this.saving = false
                this.modal.prestamo = false
                this.searchBook()
            },
            pluck(array, key) {
                return array.map(function(obj) {
                    return obj[key];
                });
            }
        }
    }
</script>

<style scoped>
.overflow-y-display {
    overflow-y: auto;
}
</style>
