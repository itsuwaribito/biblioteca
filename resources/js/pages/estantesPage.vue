<template>
    <v-layout>
        <v-flex xs12 md10 offset-md1>
            <v-layout>
                <v-flex xs12>
                    <h2 class="mb-4">Administrador de ubicaciones</h2>
                </v-flex>
            </v-layout>

            <v-layout>
                <v-flex sm4>
                    <v-select
                        :items="secciones"
                        item-text="nombre"
                        item-value="id"
                        label="Seleccionar seccion"
                        v-model="seccion"
                    ></v-select>
                </v-flex>
            </v-layout>

            <v-layout>
                <v-flex sm12>
                    <v-alert
                        :value="true"
                        type="warning"
                        class="mb-3"
                    >
                        This is a warning alert.
                    </v-alert>
                </v-flex>
            </v-layout>

            <v-layout>
                <v-flex sm5>
                    <v-card>
                        <v-list two-line subheader>
                            <v-subheader inset>Disponibles</v-subheader>
                            
                            <v-list-tile
                                v-for="item in disponibles"
                                :key="item.id"
                            >
                                <v-list-tile-content>
                                    <v-list-tile-title>{{ item.nombre }}</v-list-tile-title>
                                </v-list-tile-content>

                                <v-list-tile-action v-if="seccion != null">
                                    <v-btn icon ripple @click="seleccionar(item)">
                                        <v-icon color="grey lighten-1">keyboard_arrow_right</v-icon>
                                    </v-btn>
                                </v-list-tile-action>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>

                <v-flex sm5 offset-sm2>
                    <v-card>
                        <v-list two-line subheader>
                            <v-subheader inset>Seleccionados</v-subheader>

                            <v-list-tile
                                v-for="item in seleccionados"
                                :key="item.id"
                            >

                                <v-list-tile-action>
                                <v-btn icon ripple @click="disponible(item)">
                                    <v-icon color="grey lighten-1">keyboard_arrow_left</v-icon>
                                </v-btn>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>{{ item.nombre }}</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>
        <v-fab-transition>
                <v-btn
                    color="blue"
                    dark
                    fab
                    fixed
                    bottom
                    right
                    @click="saveSelection"
                    :disabled="seccion == null"
                >
                    <v-icon>save</v-icon>
                </v-btn>
            </v-fab-transition>
    </v-layout>
</template>

<script>

export default {
    
    data() {
        return {
            estantes: [],
            secciones: [],
            seccion: null
        }
    },
    created() {
        this.getEstantes()
        this.getSecciones()
    },
    computed: {
        disponibles() {
            return this.estantes.filter((estante) => {
                return !estante.isSelected
            })
        },
        seleccionados() {
            return this.estantes.filter((estante) => {
                return estante.isSelected
            })
        }
    },
    methods: {
        async getEstantes() {
            const response = await axios.get('/api/catalogos/estantes')
            var temp = response.data
            temp.forEach(element => {
                element.isSelected = false
            });

            this.estantes = temp
        },
        async getEstantesSeleccionados() {
            const response = await axios.get('/api/catalogos/estantes', {
                params: {
                    seccion: this.seccion
                }
            })

            var temp = response.data
            this.estantes.forEach(value => {
                value.isSelected = false
                temp.forEach(element => {
                    if(element.id == value.id) {
                        value.isSelected = true
                    }
                })
            })
        },
        async getSecciones() {
            const response = await axios.get('/api/catalogos/secciones')
            this.secciones = response.data
        },
        disponible(estante) {
            estante.isSelected = false
        },
        seleccionar(estante) {
            estante.isSelected = true
        },
        async saveSelection() {
            const response = await axios.put(`/api/ubicaciones/${this.seccion}`,{
                disponibles: this.disponibles,
                seleccionados: this.seleccionados
            } )

            console.log(response)
        }
    },
    watch: {
        seccion() {
            this.getEstantesSeleccionados()
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
