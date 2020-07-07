<template>
  
  <div>      
    <!-- navbar -->
    <Navbar :ruta="ruta"> </Navbar>  
    <!-- Main Sidebar Container -->
      <Sidebar :ruta="ruta" > </Sidebar> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <transition name="slide" mode="in-out">
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
import Content from './plantilla/Content'
import Footer from './plantilla/Footer'
export default {
    props: ['ruta'],
    components:{Navbar, Sidebar, Content, Footer}
}
</script>

<style>

</style>