import vue from 'vue'
import Router from 'vue-router'

vue.use(Router)

export default new Router({
    routes: [

        {
            path: '/login',
            name: 'login',
            component: require('./components/modulos/authenticate/login').default

        },

        { path: '/', component: require('./components/modulos/dashboard/Index').default },


/*********      RUTAS MODULO ADMINISTRACION DE USUARIOS           *********/
        { path: '/usuarios', component: require('./components/modulos/usuarios/Index').default },
        { path: '/usuarios/crear', component: require('./components/modulos/usuarios/create').default },
        { 
            path: '/usuarios/editar/:id_user',
            name: 'usuarios.editar',
            component: require('./components/modulos/usuarios/edit').default,
            props: true
        },
        { 
            path: '/usuarios/ver/:id_user',
            name: 'usuarios.ver',
            component: require('./components/modulos/usuarios/view').default,
            props: true
        },
        { 
            path: '/usuarios/permisos/:id_user',
            name: 'usuarios.permisos',
            component: require('./components/modulos/usuarios/permission').default,
            props: true
        },
/*********    RUTAS MODULO DE ADMINISTRACION DE ROLES      **********/
        { path: '/roles', component: require('./components/modulos/roles/Index').default },
        { path: '/roles/crear', component: require('./components/modulos/roles/create').default },
        { 
            path: '/roles/editar/:id',
            name: 'roles.editar',
            component: require('./components/modulos/roles/edit').default,
            props : true
         },

/******** RUTAS MODULO DE ADMINISTRACION DE  PERMISOS ********/
        { path: '/permisos', component: require('./components/modulos/permisos/Index').default },
        { path: '/permisos/crear', component: require('./components/modulos/permisos/create').default },
        { 
            path: '/permisos/editar/:id',
            name: 'permisos.editar',
            component: require('./components/modulos/permisos/edit').default,
            props : true
        },





/******** RUTAS MODULO DE ADMINISTRACION DE  restantes ********/
        { path: '/areatesis', component: require('./components/modulos/areatesis/Index').default },

        { path: '/escuelas', component: require('./components/modulos/escuelas/Index').default },
        { path: '/documentos ', component: require('./components/modulos/documentos/Index').default }
    ],
    mode: 'history',
    linkActiveClass: 'active'
})