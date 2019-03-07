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
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex sm6 md12>
                                <v-text-field label="Titulo"></v-text-field>
                            </v-flex>
                            <v-flex sm6 md8>
                                <v-text-field label="Autor"></v-text-field>
                            </v-flex>
                            <v-flex sm6 md2>
                                <v-text-field label="Edicion"></v-text-field>
                            </v-flex>
                            <v-flex sm6 md2>
                                <v-text-field mask="###" messages="Solo se permiten numeros" label="En existencia"></v-text-field>
                            </v-flex>
                            <v-flex sm6 md4>
                                <v-text-field label="Editorial"></v-text-field>
                            </v-flex>
                            <v-flex sm6 md4>
                                <v-text-field mask="####" messages="Solo se permiten numeros" label="Año de publicacion"></v-text-field>
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
                                        v-model="dates.adquisicion"
                                        locale="es"
                                        no-title
                                        @input="menu = false"
                                    ></v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex sm6 md12>
                                <v-textarea
                                    name="input-7-1"
                                    label="Observaciones"
                                    v-model="observaciones"
                                ></v-textarea>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="dialog = !dialog">Cerrar</v-btn>
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
                    text: "En exitencia",
                    value: "cantidad",
                    sortable: false
                },
            ],
            search: '',
            dialog: true,
            dates: {
                adquisicion: new Date().toISOString().substr(0, 10),
            },
            menu: false,
            publicacion: '',
            observaciones: ''
        }
    },
    mounted() {

        this.fillBookList()
    },
    computed: {
        computedFormatedDate() {
            return this.formatedDate(this.dates.adquisicion)    
        }
    },
    methods: {
        async fillBookList() {
            const response = await axios.get('/api/catalogos/libros', {
                        params: {
                            search: this.search,
                            all: true
                        }
                    })
            this.libros = response.data
        },
        altaLibro() {
            console.log('nuevo libro')
            this.dialog = true
        },
        formatedDate (dateString) {
            var aux = dateString.split("-")
            var date = new Date(aux[0],aux[1],aux[2])
            return `${date.getDate().toString().padStart(2, "0")}/${(date.getMonth() + 1)}/${date.getFullYear()}`
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
