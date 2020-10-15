<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bitacoras</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <template  v-if="listRolPermisosByUsuario.includes('reportes.reportefit')">
          <div class="card-header">
            <div class="card-tools">
                <router-link class="btn btn-info bnt-sm" :to="'/reportes'">
                    <i class="fas fa-arrow-left"></i> Volver a Reportes
                </router-link> 
            </div>
          </div>
        </template>
        <div class="card-body">
          <div class="container-fluid">
              <template  v-if="listRolPermisosByUsuario.includes('avances.listaralumnos')">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de busqueda</h3>
              </div>
             <!-- Filtro de busqueda de avances -->
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label">Seleccionar alumno</label>
                          <div class="col-md-9">
                              <el-select v-model="fillBsqBitacoraByAlumno.id_user" 
                              placeholder="Asignar alumno"
                              clearable>
                              <el-option
                                  v-for="item in listAlumnos"
                                  :key="item.id_user"
                                  :label="item.nombres"
                                  :value="item.id_user">
                              </el-option>
                              </el-select>
                          </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div> <!-- Filtro de busqueda de avances -->
              
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarBitacorasByAlumno" v-loading.fullscreen.lock="fullscreenLoading"
                      >Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                  </div>
                </div>
              </div>
              </div>
            </template>

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de resultados</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listBitacoras.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects ">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Comentario</th>
                        <th>Acciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listBitacoras" :key="index">
                        <td v-text="item.fecha"></td>
                        <td v-text="item.comentario"></td>
                        <td>
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'bitacoras.editar', params:{id: item.id}}">
                              <i class="fas fa-pencil-alt"></i> Editar
                            </router-link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item" v-if="pageNumber > 0">
                        <a href="#" class="page-link" @click.prevent="prevPage">Ant</a>
                      </li>
                      <li class="page-item" v-for="(page, index) in pagesList" :key="index"
                        :class="[page == pageNumber ? 'active' : '']">
                        <a href="#" class=page-link @click.prevent="selectPage(page)"> {{page+1}}</a>
                      </li>
                      <li class="page-item" v-if="pageNumber < pageCount -1">
                        <a href="#" class="page-link" @click.prevent="nextPage">Post</a>
                      </li>
                    </ul>
                  </div>
                </template>
                <template v-else>
                  <div class="callout callout-info">
                    <h5> No se han encontrado resultados...</h5>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>

</template>

<script>
export default {
    props: ['usuario'],
  data(){
    return{
        fillBsqBitacoraByAlumno:{
        id_user: this.$attrs.id,
      },
      listRolPermisosByUsuario: JSON.parse(localStorage.getItem('listRolPermisosByUsuario')),
      listAlumnos:[],
      listPermisos:[],
      listBitacoras:[],
      fullscreenLoading: false,
      pageNumber: 0,
      perPage: 5,
      modalShow: false,
      modalOption: 0, 
      mostrarModal: {
        display: 'block',
        background: '#0000006b',
      },
      ocultarModal: {
        display: 'none',
      },
      error: 0,
      mensajeError:[]
    }
  },
  computed: {
    pageCount(){
      //obtener el numero de paginas 
      let a = this.listBitacoras.length,
          b = this.perPage;
      return Math.ceil(a / b);
    },
    listarTesisPaginated(){
      //
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listBitacoras.slice(inicio, fin);
    },
    pagesList(){
      let a = this.listBitacoras.length,
          b = this.perPage;
      let pageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];
      while (count < pageCount){
        pagesArray.push(count);
        count++;
      }
      return pagesArray;

    }
  },
  mounted(){
    this.getListarBitacorasByAlumno();
    //this.getListarMisBitacoras();
    this.getListarAlumnosByprofesor();
  },
  methods:{
    getListarAlumnosByprofesor(){
      this.fullscreenLoading = true;
      var url = '/avances/getListarAlumnosByprofesor'
      axios.get(url, {
      }).then(response => {
          this.inicializarPaginacion();
          this.listAlumnos = response.data;
          this.fullscreenLoading = false;
      })
    },
    getListarMisBitacoras(){
      this.fullscreenLoading = true;
      var url = '/bitacoras/getListarMisBitacoras'
      axios.get(url, {
        
      }).then(response => {
          this.inicializarPaginacion();
          this.listBitacoras = response.data;
          this.fullscreenLoading = false;
      })
    },
    getListarBitacorasByAlumno(){
      this.fullscreenLoading = true;
      var url = '/bitacoras/getListarBitacorasByAlumno'
      axios.get(url, {
        params: {
          'id_user' : this.fillBsqBitacoraByAlumno.id_user,
        }
      }).then(response => {
          this.inicializarPaginacion();
          this.listBitacoras = response.data;
          this.fullscreenLoading = false;
      })
    },
    limpiarCriteriosBsq(){
      this.fillBsqBitacoraByAlumno.id_user = '';
    },
    limpiarBandejaUsuarios(){
      this.listBitacoras = [];
    },
    nextPage(){
      this.pageNumber++;
    },
    prevPage(){
      this.pageNumber--;
    },
    selectPage(page){
      this.pageNumber = page;
    },
    inicializarPaginacion(){
      this.pageNumber = 0;
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
      this.limpiarModal();
    },
  }//cierre de methods
}
</script>

<style>
  .scrollTable{
    max-height: 350px !important;
    overflow: auto !important; 
  }

</style>