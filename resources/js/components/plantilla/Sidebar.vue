<template>
  

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
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
          <img :src="ruta + '/img/avatar.png'" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Jose Manriquez</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <router-link class="nav-link" :to="'/'">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>


          <li class="nav-header">CONTROL DE USUARIOS</li>
          <li class="nav-item">
            <router-link class="nav-link" :to="'/usuarios'">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Usuarios
              </p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link class="nav-link" :to="'/roles'">
              <i class="nav-icon far fa-image"></i>
              <p>
                Roles
              </p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link class="nav-link" :to="'/permisos'">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Permisos
              </p>
            </router-link>  
          </li>
          <li class="nav-header">CONTROL DE ESCUELAS</li>
          <li class="nav-item">
            <router-link class="nav-link" :to="'/escuelas'">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Escuelas
              </p>
            </router-link>  
          </li>

          <li class="nav-item">
            <router-link class="nav-link" :to="'/areatesis'">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Areas de tesis
              </p>
            </router-link>  
          </li>

          <li class="nav-header">CONTROL DE DOCUMENTOS</li>
          <li class="nav-item">
            <router-link class="nav-link" :to="'/documentos'">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                configurar documentos
              </p>
            </router-link>  
          </li>
          
          

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
  props: ['ruta']
}
</script>

<style>

</style>