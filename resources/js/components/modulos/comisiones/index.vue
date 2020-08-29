<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Comisiones</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/comisiones/crear'">
              <i class="fas fa-plus-square"></i> Registrar Nueva Comision
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Mis comisiones</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listMisComisiones.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects ">
                    <thead>
                      <tr>
                        <th>Alumno</th>
                        <th>profesor 1</th>
                        <th>profesor 2</th>
                        <th>profesor externo</th>
                        <th>Acciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listMisComisiones" :key="index">
                        <td v-text="item.Anombres"></td>
                        <td v-text="item.P1nombres"></td>
                        <td v-text="item.P2nombres"></td>
                        <td v-text="item.p_externo"></td>
                        <td>
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'comisiones.editar', params:{id: item.id}}">
                              <i class="fas fa-pencil-alt"></i>Editar
                            </router-link>
                            <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'tesis.ver', params:{id: item.id_fit}}">
                              <i class="fas fa-eye"></i> Ver Fit
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
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Comisiones donde soy participe</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listComisiones.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects ">
                    <thead>
                      <tr>
                        <th>Alumno</th>
                        <th>Profesor guia</th>
                        <th>Profesor 1</th>
                        <th>Profesor 2</th>
                        <th>Profesor Ext.</th>
                        <th>Acciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listComisiones" :key="index">
                        <td v-text="item.Anombres"></td>
                        <td v-text="item.Pnombres"></td>
                        <td v-text="item.P1nombres"></td>
                        <td v-text="item.P2nombres"></td>
                        <td v-text="item.p_externo"></td>
                        <td>
                            <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'tesis.ver', params:{id: item.id_fit}}">
                              <i class="fas fa-eye"></i> Ver Fit
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
        id_user: '',

      },
      listRolPermisosByUsuario: JSON.parse(localStorage.getItem('listRolPermisosByUsuario')),
      listAlumnos:[],
      listPermisos:[],
      listMisComisiones:[],
      listComisiones:[],
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
      let a = this.listComisiones.length,
          b = this.perPage;
      return Math.ceil(a / b);
    },
    listarTesisPaginated(){
        
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listComisiones.slice(inicio, fin);
    },
    pagesList(){
      let a = this.listComisiones.length,
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
    this.getListarMisComisiones();
    this.getListarComisiones();
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
    getListarMisComisiones(){
      this.fullscreenLoading = true;
      var url = '/comisiones/getListarMisComisiones'
      axios.get(url, {
        
      }).then(response => {
          this.inicializarPaginacion();
          this.listMisComisiones = response.data;
          this.fullscreenLoading = false;
      })
    },
    getListarComisiones(){
      this.fullscreenLoading = true;
      var url = '/comisiones/getListarComisiones'
      axios.get(url, {
        
      }).then(response => {
          this.inicializarPaginacion();
          this.listComisiones = response.data;
          this.fullscreenLoading = false;
      })
    },

    limpiarCriteriosBsq(){
      this.fillBsqBitacoraByAlumno.id_user = '';
    },
    limpiarBandejaUsuarios(){
      this.listComisiones = [];
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