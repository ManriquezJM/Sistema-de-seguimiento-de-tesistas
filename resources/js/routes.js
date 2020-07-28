import vue from 'vue'
import Router from 'vue-router'

vue.use(Router)


function verificarAcceso(to, from, next) {
    let authUser = JSON.parse(localStorage.getItem('authUser'));
    if (authUser) {
        let listRolPermisosByUsuario = JSON.parse(localStorage.getItem('listRolPermisosByUsuario'));
        if (listRolPermisosByUsuario.includes(to.name)) {
            next();
        } else {
            let listRolPermisosByUsuarioFilter = [];
            listRolPermisosByUsuario.map(function(x) {
                if (x.includes('index')) {
                    listRolPermisosByUsuarioFilter.push(x);
                }
            })
            if (to.name == 'dashboard.index') {
                next({ name: listRolPermisosByUsuarioFilter[0] });
            } else {
                next(from.path)
            }
        }
    } else {
        next('/login')
    }
}
//concentracion de rutas
export const rutas = [
    {
        path: '/login',
        name: 'login',
        component: require('./components/modulos/authenticate/login').default
    },
    { 
        path: '/',
        name: 'dashboard.index',
        component: require('./components/modulos/dashboard/Index').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },
/*********      RUTAS MODULO ADMINISTRACION DE USUARIOS           *********/
    { 
        path: '/usuarios',
        name: 'usuarios.index',
        component: require('./components/modulos/usuarios/Index').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },
    { 
        path: '/usuarios/crear',
        name: 'usuarios.crear',
        component: require('./components/modulos/usuarios/create').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },
    { 
        path: '/usuarios/editar/:id_user',
        name: 'usuarios.editar',
        component: require('./components/modulos/usuarios/edit').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        }, 
        props: true
    },
    { 
        path: '/usuarios/ver/:id_user',
        name: 'usuarios.ver',
        component: require('./components/modulos/usuarios/view').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        },
        props: true
    },
    { 
        path: '/usuarios/permisos/:id_user',
        name: 'usuarios.permisos',
        component: require('./components/modulos/usuarios/permission').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        },
        props: true
    },
/*********    RUTAS MODULO DE ADMINISTRACION DE ROLES      **********/
    { 
        path: '/roles',
        name: 'roles.index',
        component: require('./components/modulos/roles/Index').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
     },
    { 
        path: '/roles/crear',
        name: 'roles.crear',
        component: require('./components/modulos/roles/create').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        }
    },
    { 
        path: '/roles/editar/:id',
        name: 'roles.editar',
        component: require('./components/modulos/roles/edit').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        },
        props : true
     },
/******** RUTAS MODULO DE ADMINISTRACION DE  PERMISOS ********/
    { 
        path: '/permisos',
        name: 'permisos.index',
        component: require('./components/modulos/permisos/Index').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },
    { 
        path: '/permisos/crear',
        name: 'permisos.crear',
        component: require('./components/modulos/permisos/create').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },
    { 
        path: '/permisos/editar/:id',
        name: 'permisos.editar',
        component: require('./components/modulos/permisos/edit').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        },
        props : true
    },
/******** RUTAS MODULO DE ADMINISTRACION DE ESCUELAS ********/
    { 
        path: '/escuelas', 
        name: 'escuelas.index',
        component: require('./components/modulos/escuelas/Index').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },
    { 
        path: '/escuelas/crear',
        name: 'escuelas.crear',
        component: require('./components/modulos/escuelas/create').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },
    { 
        path: '/escuelas/editar/:id',
        name: 'escuelas.editar',
        component: require('./components/modulos/escuelas/edit').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        },
        props : true
    },
/******** RUTAS MODULO DE ADMINISTRACION DE  restantes ********/
    { 
        path: '/areatesis',
        name: 'areatesis.index',
        component: require('./components/modulos/areatesis/Index').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        } 
    },

/******** RUTAS MODULO DE ADMINISTRACION DE DOCUMENTOS *********/
    { 
        path: '/documentos ',
        name: 'documentos.index',
        component: require('./components/modulos/documentos/Index').default,
        beforeEnter: (to, from, next) => {
            verificarAcceso(to, from, next);
        }
    },
    { 
        path: '*',
        component: require('./components/plantilla/404').default,
    }

]

export default new Router({
    routes: rutas,
    mode: 'history',
    linkActiveClass: 'active'
})