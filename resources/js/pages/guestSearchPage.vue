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
                            <v-layout justify-end>
                                <v-chip color="orange" text-color="white">{{ libro.existencia }} de {{libro.cantidad}}</v-chip>
                            </v-layout>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
    import helper from './../helper.js'
    export default {
        created() {
        },
        data () {
            return {
                bookList: [],
                search: '',
                searching: false,
            }
        },
        computed: {
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
                } else {
                    this.bookList = []
                }
                    this.searching = false
            },250),
            getBookURL(imagen) {
                return (imagen == null) ? '/img/noimage.jpg' : imagen
            },
        }
    }
</script>

<style scoped>
</style>
