<template>
    <v-layout>
        <v-flex xs12 sm10 offset-sm1>
            <h2 class="mb-4">Adiministrador de usuarios</h2>
            <v-card>
                 <v-card-title>
                    
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="table.search"
                        append-icon="search"
                        label="Buscar"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-card-title>
                <v-data-table
                    :headers="table.headers"
                    :items="table.items"
                    :search="table.search"
                    :loading="loading"
                    class="elevation-1"
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.username }}</td>
                        <td>{{ props.item.name }}</td>
                        <td>{{ props.item.apellidos }}</td>
                        <td>{{ props.item.email }}</td>
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

                <v-dialog v-model="modal.showing" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{modal.titulo}}</span>
                        </v-card-title>
                        <v-container grid-list-lg>
                            <v-alert
                                :value="true"
                                color="error"
                                icon="warning"
                                v-if="errores.length != 0"
                            >
                                <ol>
                                    <li v-for="(error,index) in errores" :key="index">{{error[0]}}</li>
                                </ol>
                            </v-alert>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field
                                            label="Nombre de usuario"
                                            v-model="formData.username"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field
                                            label="Contraseña"
                                            v-model="formData.password"
                                            :append-icon="show1 ? 'visibility' : 'visibility_off'"
                                            :type="show1 ? 'text' : 'password'"
                                            @click:append="show1 = !show1"
                                            counter
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12>
                                        <v-text-field
                                            label="Nombre(s)"
                                            v-model="formData.name"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field
                                            label="Apellido parterno"
                                            v-model="formData.apellido_paterno"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field
                                            label="Apellido materno"
                                            v-model="formData.apellido_materno"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12>
                                        <v-text-field
                                            label="Correo electronico"
                                            prepend-inner-icon="mail"
                                            v-model="formData.email"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                        </v-container>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="modal.showing = false">Cancelar</v-btn>
                            <v-btn color="blue darken-1" flat :loading="loading" @click="saveUsuario">Guardar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <v-fab-transition>
                    <v-btn
                        color="blue"
                        dark
                        fab
                        fixed
                        bottom
                        right
                        @click="altaUsuario"
                    >
                        <v-icon>add</v-icon>
                    </v-btn>
                </v-fab-transition>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    created() {
        this.getUsuarios()
    },
    data() {
        return {
            table: {
                headers: [
                    {
                        text: "Nombre de usuario",
                        value: "username",
                        sortable: false
                    },
                    {
                        text: "Nombre",
                        value: "full_name",
                        sortable: false
                    },
                    {
                        text: "Apellidos",
                        value: "apellidos",
                        sortable: false
                    },
                    {
                        text: "Correo electronico",
                        value: "email",
                        sortable: false
                    },
                    {
                        text: "Acciones",
                        value: "nombre",
                        sortable: false
                    },
                ],
                items: [],
                search: ''
            },
            formData: {
                username: '',
                name: '',
                apellido_paterno: '',
                apellido_materno: '',
                email: '',
                password: ''
            },
            modal: {
                showing: false,
                titulo: 'Alta de usuario'
            },
            loading: false,
            show1: false,
            errores: []
        }
    },
    methods: {
        altaUsuario() {
            console.log('click')
        },
        async getUsuarios() {
            this.loading = true
            const response = await axios.get('/api/catalogos/usuarios')
            this.table.items = response.data
            this.loading = false
        },
        editItem(user) {
            this.modal.showing = true
            this.modal.titulo = 'Modificar usuario'
        },
        async saveUsuario() {
            this.loading = true
            this.errores = []
            try {
                const response = await axios.post('/api/usuarios', this.formData)
                this.modal.showing = false
            } catch(e) {
                if(e.response.status == 422)
                    this.errores = e.response.data.errors
            }
            this.loading = false
            this.getUsuarios()
        },
        altaUsuario() {
            this.modal.showing = true
            this.modal.titulo = 'Alta de usuario'
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
