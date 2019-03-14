import Vue from 'vue'
import Router from 'vue-router'

import defaultLayout from './layouts/default'
import NoMenuLayout from './layouts/no_menu'

import HomePage from './pages/homePage'
import LibrosPage from './pages/librosPage'
import AlumnosPage from './pages/alumnosPage'
import EstantesPage from './pages/estantesPage'
import LoginPage from './pages/loginPage'
import GuestSearchPage from './pages/guestSearchPage'

Vue.use(Router)

const router = new Router ({
    mode: 'history',
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    },
    routes: [
        {
            path: '/admin',
            component: defaultLayout,
            children: [
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
                },
                {
                    path: '/estantes',
                    name: 'Estantes',
                    component: EstantesPage
                },
                {
                    path: '*',
                    redirect: {
                        name: 'Home'
                    }
                },
            ]
        },
        {
            path: '/',
            component: NoMenuLayout,
            children: [
                {
                    path: '/',
                    name: 'Inicio',
                    component: GuestSearchPage
                },
                {
                    path: '/login',
                    name: 'Login',
                    component: LoginPage
                },
                {
                    path: '*',
                    redirect: {
                        name: 'Inicio'
                    }
                },
            ]
        },
    ]
})

export default router