<template>
    <v-layout>
        <v-flex xs12 sm10 offset-sm1>
            <h2 class="mb-4">Adiministrador de libros</h2>
            
            <v-card>
                <v-card-title>
                    Listado de libros
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
                    :items="libros"
                    class="elevation-1"
                    :search="search"
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.titulo }}</td>
                        <td>{{ props.item.autor }}</td>
                        <td>{{ props.item.editorial }}</td>
                        <td>{{ props.item.edicion }}</td>
                        <td>{{ props.item.observaciones }}</td>
                        <td>{{ props.item.cantidad }}</td>
                        <td class="justify-center layout ">
                            <v-icon
                                small
                                class="ma-auto"
                                @click="editItem(props.item)"
                            >
                                edit
                            </v-icon>
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
                    @click="altaLibro"
                >
                    <v-icon>add</v-icon>
                </v-btn>
            </v-fab-transition>
            </v-card>
        </v-flex>

        <v-dialog v-model="dialog" persistent max-width="1200px">
            <v-card>
                <v-card-title>
                    <span class="headline">Alta de libro</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-lg>
                        <v-layout wrap >
                            <v-flex xs12>
                                <v-text-field
                                    label="Titulo"
                                    v-model="formData.titulo"
                                ></v-text-field>
                            </v-flex>
                            <v-flex xs12 md8>
                                <v-text-field
                                    label="Autor"
                                    v-model="formData.autor"
                                ></v-text-field>
                            </v-flex>
                            <v-flex sm6 md2>
                                <v-text-field
                                    label="Edicion"
                                    v-model="formData.edicion"
                                ></v-text-field>
                            </v-flex>
                            <v-flex sm6 md2>
                                <v-text-field
                                    mask="###"
                                    messages="Solo se permiten numeros"
                                    label="Total de copias"
                                    v-model="formData.cantidad"
                                ></v-text-field>
                            </v-flex>
                            <v-flex sm6 md4>
                                <v-text-field
                                    label="Editorial"
                                    v-model="formData.editorial"
                                ></v-text-field>
                            </v-flex>
                            <v-flex sm6 md4>
                                <v-text-field mask="####" messages="Solo se permiten numeros"
                                    label="Año de publicacion"
                                    v-model="formData.publicacion"
                                ></v-text-field>
                            </v-flex>
                            <v-flex sm6 md4>
                                <v-menu
                                    v-model="menu"
                                    :nudge-right="40"
                                    lazy
                                    transition="scale-transition"
                                    offset-y
                                    full-width
                                    max-width="290px"
                                    min-width="290px"
                                    >
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            v-model="computedFormatedDate"
                                            label="Fecha de adquisicion"
                                            persistent-hint
                                            prepend-icon="event"
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="formData.adquisicion"
                                        locale="es"
                                        no-title
                                        @input="menu = false"
                                    ></v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12 sm7 md9>
                                <v-textarea
                                    name="input-7-1"
                                    label="Observaciones"
                                    v-model="formData.observaciones"
                                ></v-textarea>
                            </v-flex>
                            <v-flex xs12 sm5 md3>
                                <v-select
                                    :items="ubicaciones"
                                    label="Ubicacion"
                                    item-value="id"
                                    item-text="nombre"
                                    v-model="formData.ubicaciones_id"
                                ></v-select>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1"
                        flat
                        @click="dialog = !dialog"
                        :loading="loading"
                    >Cancelar</v-btn>
                    <v-btn color="blue darken-1"
                        flat
                        @click="guardarLibro"
                        :loading="loading"
                    >Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
export default {
    data() {
        return {
            libros: [],
            ubicaciones: [],
            headers: [
                {
                    text: "Titulo",
                    value: "titulo",
                    sortable: false
                },
                {
                    text: "Autor",
                    value: "autor",
                    sortable: false
                },
                {
                    text: "Editorial",
                    value: "editorial",
                    sortable: false
                },
                {
                    text: "Edicion",
                    value: "edicion",
                    sortable: false
                },
                {
                    text: "Observaciones",
                    value: "observaciones",
                    sortable: false
                },
                {
                    text: "Total de copias",
                    value: "cantidad",
                    sortable: false
                },
                {
                    text: "Acciones",
                    value: "cantidad",
                    sortable: false
                },
            ],
            search: '',
            dialog: false,
            formData: {
                adquisicion: new Date().toISOString().substr(0, 10),
                titulo: '',
                autor: '',
                edicion: '',
                cantidad: '',
                editorial: '',
                publicacion: '',
                observaciones: '',
                ubicaciones_id: null
            },
            menu: false,
            publicacion: '',
            observaciones: '',
            loading: false,
        }
    },
    mounted() {

        this.fillBookList()
        this.getUbicaciones()
    },
    computed: {
        computedFormatedDate() {
            return this.formatedDate(this.formData.adquisicion)    
        }
    },
    methods: {
        async fillBookList() {
            this.loading = true
            const response = await axios.get('/api/catalogos/libros', {
                        params: {
                            all: true
                        }
                    })
            this.libros = response.data
            this.loading = false
            
        },
        async getUbicaciones() {
            const response = await axios.get('/api/catalogos/ubicaciones')
            this.ubicaciones = response.data
        },
        altaLibro() {
            this.dialog = true
            this.formData = {
                adquisicion: new Date().toISOString().substr(0, 10),
                titulo: '',
                autor: '',
                edicion: '',
                cantidad: '',
                editorial: '',
                publicacion: '',
                observaciones: '',
            }
        },
        formatedDate (dateString) {
            var aux = dateString.split("-")
            var date = new Date(aux[0],aux[1],aux[2])
            return `${date.getDate().toString().padStart(2, "0")}/${(date.getMonth() + 1)}/${date.getFullYear()}`
        },
        editItem(alumno) {
            this.dialog = true
            alumno.adquisicion = new Date(alumno.adquisicion).toISOString().substr(0, 10)
            this.formData = alumno
            console.log(alumno)
            
        },
        async guardarLibro() {
            this.loading = true
            var reponse = null
            if(this.formData.hasOwnProperty('id')) {
                reponse = await axios.put(`/api/libros/${this.formData.id}`,this.formData)
            } else {
                reponse = await axios.post('/api/libros',this.formData)
            }
            this.fillBookList()
            this.dialog = false
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
