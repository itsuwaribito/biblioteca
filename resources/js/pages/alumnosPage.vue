<template>
    <v-layout>
        <v-flex xs12 sm10 offset-sm1>
            <h2 class="mb-4">Adiministrador de alumnos</h2>
            
            <v-card>
                <v-card-title>
                    Listado de alumnos
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Buscar"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-card-title>
                <v-data-table
                    :headers="headers"
                    :items="alumnos"
                    class="elevation-1"
                    :search="search"
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.numero_control }}</td>
                        <td>{{ props.item.nombre }}</td>
                        <td>{{ props.item.apellido_paterno }}</td>
                        <td>{{ props.item.apellido_materno }}</td>
                        <td class="justify-center layout ">
                            <v-icon
                                small
                                class="ma-auto"
                                @click="editItem(props.item)"
                            >
                                edit
                            </v-icon>

                            <v-tooltip left>
                                <template v-slot:activator="{ on }">
                                    <img
                                        v-on="on"
                                        src="/img/return-book.png"
                                        alt="Libros prestados"
                                        class="ma-auto pointer"
                                        height="20"
                                        contain
                                        @click="showBorrowedBooks(props.item)"
                                    >
                                </template>
                                <span>Libros prestados</span>
                            </v-tooltip>

                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <img
                                        v-on="on"
                                        alt="Libros devueltos"
                                        src="/img/borrow-book.png"
                                        class="ma-auto pointer"
                                        height="20"
                                        contain
                                        @click="showReturnedBooks(props.item)"
                                    >
                                </template>
                                <span>Libros devueltos</span>
                            </v-tooltip>
                        </td>
                    </template>
                </v-data-table>
                <v-fab-transition>
                    <v-btn
                        color="blue"
                        dark
                        fab
                        fixed
                        bottom
                        right
                        @click="altaAlumno"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </v-fab-transition>
            </v-card>
        </v-flex>

        <v-dialog v-model="modal.formulario" persistent max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="headline">Alta de alumno</span>
                </v-card-title>
                 <v-container grid-list-lg>
                        <v-layout wrap>
                            <v-flex xs12 sm12>
                                <v-text-field
                                    label="Matricula"
                                    :mask="'nnnnnnnnnnnnnnn'"
                                    v-model="formData.numero_control"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field
                                    label="Nombre(s)"
                                    v-model="formData.nombre"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field
                                    label="Apellido parterno"
                                    v-model="formData.apellido_paterno"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field
                                    label="Apellido materno"
                                    v-model="formData.apellido_materno"
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                 </v-container>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="modal.formulario = false">Cancelar</v-btn>
                    <v-btn color="blue darken-1" flat :loading="isLoading" @click="saveAlumno">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="modal.listado" max-width="800px">
            <v-card>
                <v-card-title>
                    <span class="headline">{{ listado_title }} a <b>{{listado.selected.full_name}}</b></span>
                </v-card-title>
                 <v-container grid-list-lg>
                        <v-layout wrap>
                            <v-flex xs12 sm12>
                                <v-list two-line subheader>
                                    <!-- <v-divider></v-divider> -->
                                    <v-alert
                                        :value="true"
                                        color="info"
                                        icon="info"
                                        outline
                                        v-if="listado.data.length == 0"
                                    >
                                        No se encontraron libros
                                    </v-alert>
                                    <template v-else v-for="(libro,index) in listado.data">
                                        <v-list-tile
                                            :key="libro.titulo"
                                        >
                                            <v-list-tile-content>
                                                <v-list-tile-title>{{ libro.titulo }}</v-list-tile-title>
                                                <v-list-tile-sub-title>{{ libro.edicion }}</v-list-tile-sub-title>
                                            </v-list-tile-content>
                                                <v-list-tile-action>
                                                    {{ libro.pivot.fecha_prestamo }}
                                                </v-list-tile-action>
                                        </v-list-tile>
                                        <v-divider
                                            v-if="index + 1 < listado.data.length"
                                            :key="index"
                                            class="ma-0"
                                        ></v-divider>
                                    </template>
                                </v-list>
                            </v-flex>
                        </v-layout>
                 </v-container>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="modal.listado = false">Cerrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

    </v-layout>
</template>

<script>

export default {
    created(){
        this.getAlumnos()
    },
    data() {
        return {
            headers: [
                {
                    text: 'Matricula',
                    value: 'numero_control',
                    sortable: false
                },
                {
                    text: 'Nombre(s)',
                    value: 'nombre',
                    sortable: false
                },
                {
                    text: 'Apellido parterno',
                    value: 'apellido_paterno',
                    sortable: false
                },
                {
                    text: 'Apellido materno',
                    value: 'apellido_materno',
                    sortable: false
                },
                {
                    text: "Acciones",
                    value: "nombre",
                    sortable: false
                },
            ],
            formData: {
                numero_control: '',
                nombre: '',
                apellido_paterno: '',
                apellido_materno: ''
            },
            alumnos:[],
            search: '',
            isLoading: false,
            modal: {
                formulario: false,
                listado: false
            },
            listado: {
                returned: true,
                data: [],
                selected: {
                    full_name: ''
                }
            }
        }
    },
    computed: {
        listado_title() {
            return (this.listado.returned) ? 'Libros devueltos':'Libros prestados'
        }
    },
    methods:{
        async getAlumnos() {
            this.isLoading = true
            const response = await axios.get('/api/catalogos/alumnos')
            this.alumnos = response.data
            this.isLoading = false
        },
        altaAlumno() {
            this.modal.formulario = true
            this.formData = {
                numero_control: '',
                nombre: '',
                apellido_paterno: '',
                apellido_materno: ''
            }
        },
        editItem(alumno) {
            this.modal.formulario = true
            this.formData = alumno
        },
        async saveAlumno() {
            this.isLoading = true
            var response = null
            if(this.formData.hasOwnProperty('id')) {
                response = await axios.put(`/api/alumnos/${this.formData.id}`, this.formData)
            } else {
                response = await axios.post('/api/alumnos', this.formData)
            }
            this.modal.formulario = false
            this.getAlumnos()
        },
        async showBorrowedBooks(alumno) {
            // const {data} = await axios.get(`/api/alumnos/${alumno.id}/borrowedBooks`)
            this.listado.data = alumno.libros_prestados
            this.listado.selected = alumno
            this.listado.returned = false
            this.modal.listado = true
        },
        async showReturnedBooks(alumno) {
            // const {data} = await axios.get(`/api/alumnos/${alumno.id}/returnedBooks`)
            this.listado.data = alumno.libros_debueltos
            this.listado.selected = alumno
            this.listado.returned = true
            this.modal.listado = true
        }
    }
}
</script>

<style scoped>
    .pointer {
        cursor: pointer
    }
</style>
