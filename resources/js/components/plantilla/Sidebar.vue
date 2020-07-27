<template>
  
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img :src="ruta + '/img/ucm1.jpg'"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">   
      <span class="brand-text font-weight-light">Sistema de Tesis UCM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <template v-if="!usuario.id_files">
            <img :src="ruta + '/img/avatar.png'" class="img-circle elevation-2" :alt="usuario.fullname">
          </template>
          
          <template v-else>
            <img :src="usuario.file.path" class="img-circle elevation-2" :alt="usuario.fullname" style="height:34px !important;">
          </template>
          
        </div>
        <div class="info">
          <router-link class="d-block" :to="{name: 'usuarios.ver', params:{id_user: usuario.id_user}}">
              {{usuario.nombres}}
          </router-link>
         
        </div>
      </div>

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block" @click.prevent="logout" v-loading.fullscreen.lock="fullscreenLoading">
            <i class="fas fa-sing-out-alt"></i>Cerrar Sesión
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <template v-if="listPermisos.includes('dashboard.index')">
              <router-link class="nav-link" :to="'/'">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </router-link>
            </template>
          </li>
          <template  v-if="listPermisos.includes('usuarios.index', 'roles.index', 'permisos.index')">
            <li class="nav-header">CONTROL DE USUARIOS</li>
              <template v-if="listPermisos.includes('usuarios.index')">
                <li class="nav-item">
                  <router-link class="nav-link" :to="'/usuarios'">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                      Usuarios
                    </p>
                  </router-link>
                </li>
              </template>
            <li class="nav-item">
              <template v-if="listPermisos.includes('roles.index')">
                <router-link class="nav-link" :to="'/roles'">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Roles
                  </p>
                </router-link>
              </template>
            </li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('permisos.index')">
                <router-link class="nav-link" :to="'/permisos'">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    Permisos
                  </p>
                </router-link>  
              </template>
            </li>
          </template>
          <template  v-if="listPermisos.includes('escuelas.index', 'areatesis.index')">
            <li class="nav-header">CONTROL DE ESCUELAS</li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('escuelas.index')">
                <router-link class="nav-link" :to="'/escuelas'">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    Escuelas
                  </p>
                </router-link>  
              </template>
            </li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('areatesis.index')">
                <router-link class="nav-link" :to="'/areatesis'">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    Areas de tesis
                  </p>
                </router-link>
              </template>    
            </li>
          </template>
          <template  v-if="listPermisos.includes('documentos.index')">
            <li class="nav-header">CONTROL DE DOCUMENTOS</li>
            <li class="nav-item">
              <template v-if="listPermisos.includes('documentos.index')">
                <router-link class="nav-link" :to="'/documentos'">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    configurar documentos
                  </p>
                </router-link>  
              </template>
            </li>
          </template>
          
          <!-- sitios de interes 
          <li class="nav-header">Sitios de interes</li>
          <li class="nav-item">
            <a href="http://www.sibib.ucm.cl/" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>Sibib UCM</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://scholar.google.com//" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>Google Scholar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://sci-hub.tw/" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>Sci-Hub</p>
            </a>
          </li>

          -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
export default {
  props: ['ruta', 'usuario', 'listPermisos'],
  data(){
    return{
      fullscreenLoading: false
    }
  },
  methods:{
    logout(){
      this.fullscreenLoading = true;
      var url='/authenticate/logout'
      axios.post(url).then(response => {
        if(response.data.code == 204){
          this.$router.push({name: 'login'})
          location.reload();
          localStorage.clear();
          this.fullscreenLoading = false;
        }
        
      })
    }
  },
}
</script>

<style>

</style>