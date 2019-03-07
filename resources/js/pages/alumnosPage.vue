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
                                <v-text-field label="Matricula"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field label="Nombre(s)"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field label="Apellido parterno"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md4>
                                <v-text-field label="Apellido materno"></v-text-field>
                            </v-flex>
                        </v-layout>
                 </v-container>
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
            ],
            alumnos:[],
            search: '',
            dialog: false
        }
    },
    methods:{
        async getAlumnos() {
            const response = await axios.get('/api/catalogos/alumnos')
            this.alumnos = response.data
        },
        altaAlumno() {
            this.dialog = true
        }
    }
}
</script>

<style lang="sass" scoped>

</style>
