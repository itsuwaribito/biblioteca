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
import UsuariosPage from './pages/usuariosPage'

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
            meta: {
                requiresAuth: true
            },
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
                    path: '/usuarios',
                    name: 'Usuarios',
                    component: UsuariosPage
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

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        console.log('user', localStorage.user)
        console.log('from', from)
        console.log('to', to)
        console.log('next', next)
        if(!(from.path == '/' && to.name == 'Home')) {

            if (localStorage.user == "null") {
                next({
                    name: 'Login',
                    query: {
                        redirect: to.fullPath
                    }
                })
            }    
        }
    }
    next()
})

export default router