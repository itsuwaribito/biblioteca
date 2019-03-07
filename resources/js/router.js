import Vue from 'vue'
import Router from 'vue-router'

import HomePage from './pages/homePage'
import LibrosPage from './pages/librosPage'
import AlumnosPage from './pages/alumnosPage'

Vue.use(Router)

const router = new Router ({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: HomePage
        },
        {
            path: '/libros',
            name: 'Libros',
            component: LibrosPage
        },
        {
            path: '/alumnos',
            name: 'Alumnos',
            component: AlumnosPage
        }
    ]
})

export default router