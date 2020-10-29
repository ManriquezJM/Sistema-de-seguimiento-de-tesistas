<template>
    <div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
        <a class="navbar-brand" href="#">Repositorio academico FCI UCM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            <router-link  :to="'/'">
              <li class="nav-item">
                <a class="nav-link">Home</a>
              </li>
            </router-link>
            <router-link  :to="'/login'">
              <li class="nav-item">
                <a class="nav-link">Ingresar</a>
              </li>
            </router-link>
            <li class="nav-item">
                <a class="nav-link" href="#">Contacto</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-primary py-5 mb-5">
        <div class="container h-150">
        <div class="row h-150 align-items-center">
            <div class="col-lg-12">
            <br>
            <br>
            <img src="/img/logoucm.png" >
            <h2 class="display-4 text-white mt-5 mb-2" style="text-align:justify">Repositorio academico Facultad de Ciencias de la Ingenieria Universidad Catolica del Maule</h2>
            <p class="lead mb-5 text-white-50" ></p>
            </div>
        </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">
        
      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Criterios de busqueda de tesis</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Titulo</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="fillBsqTesis.cTitulo">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Escuelas</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqTesis.nIdEscuela" @change="getListarProfesorByEscuela"
                            placeholder="Asignar Escuela"
                            clearable>
                            <el-option
                                v-for="item in listEscuelas"
                                :key="item.id"
                                :label="item.nombre"
                                :value="item.id">
                            </el-option>
                            </el-select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Profesor</label>
                        <div class="col-md-9">
                                <el-select v-model="fillBsqTesis.nIdProfesor" 
                                placeholder="Asignar Escuela"
                                clearable>
                                <el-option
                                    v-for="item in listProfesores"
                                    :key="item.id"
                                    :label="item.fullname"
                                    :value="item.id_user">
                                </el-option>
                                </el-select>
                            </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-primary btnWidth" @click.prevent="getListarTesisHome" v-loading.fullscreen.lock="fullscreenLoading"
                      >Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  Bandeja de Resultados</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listTesis.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>PDF</th>
                        <th>Titulo</th>
                        <th>Profesor</th>
                        <th>Escuela</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr v-for="(item, index) in listTesis" :key="index">
                        <td>
                          <a class="btn btn-flat btn-warning btn-sm" :href="item.path" target="_blank"><i class="fas fa-file-download"> </i> PDF</a>
                        </td>
                        <td v-text="item.titulo"></td>
                        <td v-text="item.nombre_pt"></td>
                        <td v-text="item.escuela_nom"></td>
                        
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
                  <div class="callout callout-primary">
                    <h5> No se han encontrado resultados...</h5>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container" style="text-align: center">
          <!-- Por favor por respeto a los colaboradores de este proyecto no eliminar las referencias de las personas que han participado-->
        <strong >Este es un trabajo realizado por los siguientes colaboradores  <a href="https://github.com/ManriquezJM">J.M.M.T</a>.</strong> All rights
    reserved.
        </div>
        <!-- Por favor por respeto a los colaboradores de este proyecto no eliminar las referencias de las personas que han participado-->
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    </div>
</template>

<script>
export default {
    data(){
      return{
        fillBsqTesis:{
          cTitulo: '',
          cAutor: '',
          nIdEscuela:'',
          nIdProfesor:'',
          
          cEstadoTesis: ''
        },
        listRolPermisosByUsuario: JSON.parse(localStorage.getItem('listRolPermisosByUsuario')),
         
        listTesis:[],
        listEscuelas:[],
        listProfesores:[],
        fullscreenLoading: false,
        pageNumber: 0,
        perPage: 10,
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
        let a = this.listTesis.length,
            b = this.perPage;
        return Math.ceil(a / b);
      },
      listarTesisPaginated(){
        //
        let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
        return this.listTesis.slice(inicio, fin);
      },
      pagesList(){
        let a = this.listTesis.length,
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
      this.getListarEscuelas();
      this.getListarProfesorByEscuela();
    },
    methods:{
      getListarEscuelas(){
        this.fullscreenLoading = true;
        var url = '/administracion/escuelas/getListarEscuelas'
        axios.get(url, {
        }).then(response => {
            this.listEscuelas = response.data;
            this.fullscreenLoading = false;
        })
      },
      getListarProfesorByEscuela(){
        this.fullscreenLoading = true;
        var url = '/reportes/getListarProfesorByEscuela'
        axios.get(url, {
          params: {
            'nIdEscuela' : this.fillBsqTesis.nIdEscuela,
          }
        }).then(response => {
            this.listProfesores = response.data;
            this.fullscreenLoading = false;
        })
      },
      setGenerarDocumento(){
        //this.fullscreenLoading = true;
        var url = '/administracion/reportes/export'
        axios.get(url, {
            responseType: 'blob',
            params:{
                'listTesis': JSON.stringify(this.listTesis)
            }
        }).then(response => {
          var oMyBlob = new Blob([response.data], {type : 'application/vnd.ms-excel'});
          var url = document.createElement('a')
          url.href = URL.createObjectURL(oMyBlob);
          url.download = 'usuarios.xlsx'
          url.click()
        })
      },
      getListarTesisHome(){
        this.fullscreenLoading = true;
        var url = '/administracion/reportes/getListarTesisHome'
        axios.get(url, {
          params: {
            'cTitulo'        : this.fillBsqTesis.cTitulo,
            'nIdEscuela'  : this.fillBsqTesis.nIdEscuela,
            'cEstadoNotap'  : this.fillBsqTesis.cEstadoNotap,
            'dFechaUR'  : this.fillBsqTesis.dFechaUR,
            'nIdProfesor' : this.fillBsqTesis.nIdProfesor,
            'cTipo'       : this.fillBsqTesis.cTipo,
            'cVinculacion': this.fillBsqTesis.cVinculacion,
            'cEstadoTesis': this.fillBsqTesis.cEstadoTesis,
            'dFechaInicio': (!this.fillBsqTesis.dfecharango) ? '' : this.fillBsqTesis.dfecharango[0],
            'dFechaFin'   : (!this.fillBsqTesis.dfecharango) ? '' : this.fillBsqTesis.dfecharango[1],
          }
        }).then(response => {
            this.inicializarPaginacion();
            this.listTesis = response.data;
            this.fullscreenLoading = false;
        })
      },
      limpiarCriteriosBsq(){
        this.fillBsqTesis.cTitulo = '';
        this.fillBsqTesis.nIdEscuela = '';
        this.fillBsqTesis.cEstadoNotap = '';
        this.fillBsqTesis.dFechaUR = '';
        this.fillBsqTesis.nIdProfesor = '';
        this.fillBsqTesis.cTipo = '';
        this.fillBsqTesis.cVinculacion = '';
        this.fillBsqTesis.cEstadoTesis = '';
        this.fillBsqTesis.dfecharango = '';
      },
      limpiarBandejaUsuarios(){
        this.listTesis = [];
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
      limpiarModal(){
        this.fillVerFIT.cNombre = ''
        this.fillVerFIT.cSlug = ''
        this.listPermisos = [];
        this.modalOption = 0;
      },
    
    }
}
</script>

<style>

</style>