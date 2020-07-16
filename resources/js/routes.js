import vue from 'vue'
import Router from 'vue-router'

vue.use(Router)

export default new Router({
    routes: [
        { path: '/', component: require('./components/modulos/dashboard/Index').default },

        { path: '/usuarios', component: require('./components/modulos/usuarios/Index').default },
        { path: '/usuarios/crear', component: require('./components/modulos/usuarios/create').default },



        { path: '/areatesis', component: require('./components/modulos/areatesis/Index').default },
        { path: '/roles', component: require('./components/modulos/roles/Index').default },
        { path: '/permisos', component: require('./components/modulos/permisos/Index').default },
        { path: '/escuelas', component: require('./components/modulos/escuelas/Index').default },
        { path: '/documentos ', component: require('./components/modulos/documentos/Index').default }
    ],
    mode: 'history',
    linkExactActiveClass: 'active'
})