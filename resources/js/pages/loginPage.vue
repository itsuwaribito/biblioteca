<template>
    <v-layout>
        <v-flex xs12 md4 offset-md4>
            <v-alert
                :value="showError"
                color="error"
                icon="warning"
                class="mb-5"
                outline
            >
                Credenciales incorrectas
            </v-alert>
            <v-card>
                <v-card-title primary-title class="pl-5 pr-5">
                    <h2 class="pa-0">Inicio de sesion</h2>
                </v-card-title>
                <v-divider></v-divider>
                <v-form
                    ref="form"
                    lazy-validation
                    class="pl-5 pr-5 pb-3"
                >
                    <v-text-field
                        v-model="formData.username"
                        label="Nombre de usuario"
                        required
                    ></v-text-field>

                    <v-text-field
                        v-model="formData.password"
                        label="Contraseña"
                        :append-icon="show1 ? 'visibility' : 'visibility_off'"
                        :type="show1 ? 'text' : 'password'"
                        @click:append="show1 = !show1"
                        required
                    ></v-text-field>
                    <v-btn color="primary" @click="submit" >iniciar sesion</v-btn>
                </v-form>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        data() {
            return {
                formData: {
                    username: '',
                    password: '',
                },
                show1: false,
                showError: false
            }
        },
        methods: {
            submit() {
                this.showError = false
                axios.post('/login',this.formData)
                .then((response) => {
                    if(response.status == 200) {
                        window.location.assign('/admin')
                    }
                })
                .catch((error) => {
                    console.log(error)
                    this.showError = true
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>

