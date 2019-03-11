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

        <v-dialog v-model="dialog" persistent max-width="600px">
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
                    <v-btn color="blue darken-1" flat @click="dialog = !dialog">Cancelar</v-btn>
                    <v-btn color="blue darken-1" flat :loading="isLoading" @click="saveAlumno">Guardar</v-btn>
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
            dialog: false,
            isLoading: false
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
            this.dialog = true
            this.formData = {
                numero_control: '',
                nombre: '',
                apellido_paterno: '',
                apellido_materno: ''
            }
        },
        editItem(alumno) {
            this.dialog = true
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
            this.dialog = false
            this.getAlumnos()
        }
        
    }
}
</script>

<style lang="sass" scoped>

</style>
