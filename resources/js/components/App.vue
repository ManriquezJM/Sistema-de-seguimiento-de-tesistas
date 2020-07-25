<template>
  
  <div>      
    <!-- navbar -->
    <Navbar :ruta="ruta"> </Navbar>  
    <!-- Main Sidebar Container -->
      <Sidebar :ruta="ruta" :usuario="authUser" > </Sidebar> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <transition name="slide-fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </div>
    <!-- /.content-wrapper -->
      <Footer></Footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

</template>

<script>
import Navbar from'./plantilla/Navbar'
import Sidebar from'./plantilla/Sidebar'
import Footer from './plantilla/Footer'
export default {
    props: ['ruta', 'usuario'],
    components:{Navbar, Sidebar, Footer},
    data(){
      return{
        authUser: this.usuario
      }
    },
    mounted(){
      EventBus.$on('verifyAuthenticatedUser', data => {
        console.log('Evento ejecutado desde el componente App vue')
        console.log(data);
        this.authUser = data;
      })
    },
}
</script>

<style>

</style>