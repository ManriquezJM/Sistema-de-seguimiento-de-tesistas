<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reportes de Tesistas</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de busqueda</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Rut Alumno</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="fillBsqTesisReporte.nRut">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Escuelas</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqTesisReporte.nIdEscuela" @change="getListarProfesorByEscuela"
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
                                <el-select v-model="fillBsqTesisReporte.nIdProfesor" 
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
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nota Pendiente</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqTesisReporte.cEstadoNotap" 
                            placeholder="Seleccione un estado"
                            clearable>
                              <el-option
                                v-for="item in listTipoDeNotap"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                              </el-option>
                            </el-select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Estado Tesis</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqTesisReporte.cEstadoTesis" 
                            placeholder="Seleccione un estado"
                            clearable>
                              <el-option
                                v-for="item in listEstadosTesis"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                              </el-option>
                            </el-select>
                        </div>
                      </div>
                    </div>

                    
                     <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Fecha de ultimo ramo aprobado</label>
                            <div class="col-md-9">
                                <el-date-picker
                                    v-model="fillBsqTesisReporte.dfecharango"
                                    type="monthrange"
                                    range-separator="Hasta"
                                    start-placeholder="Fecha Inicio"
                                    end-placeholder="Fecha Fin"
                                    value-format="yyyy-MM-dd">
                                </el-date-picker>
                            </div>
                        </div>
                    </div>
                    
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarTesisReporte" v-loading.fullscreen.lock="fullscreenLoading"
                      >Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                    <template v-if="listTesis.length">
                        <el-tooltip class="item" effect="dark" content="Exportar en Formato Excel" placement="right">
                          <el-button @click.prevent="setGenerarDocumento">
                          <i  class="fas fa-file-excel"></i>
                          Exportar
                          </el-button>
                        </el-tooltip>
                    </template>
                  Bandeja de resultados</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listTesis.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Alumno</th>
                        <th>Rut</th>
                        <th>Escuela</th>
                        <th>Profesor Tutor</th>
                        <th>Estado Tesis</th>
                        <th>Detalles Tesis</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listTesis" :key="index">
                        <td v-text="item.nombre_int1"></td>
                        <td v-text="item.rut_int1"></td>
                        <td v-text="item.escuela_nom"></td>
                        <td v-text="item.nombre_pt"></td>
                        <td>
                          <template v-if="item.estado == 'D'">
                            <span class="badge badge-warning" >En desarrollo</span>
                          </template>
                          <template v-else-if="item.estado == 'A'">
                            <span class="badge badge-success" >Aprobada</span>
                          </template>
                          <template v-else>
                            <span class="badge badge-danger" >Reprobada</span>
                          </template>
                        </td>
                        <td>
                          <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'tesis.ver', params:{id: item.id}}">
                              Fit
                          </router-link>
                          <router-link class="btn btn-flat btn-success btn-sm" :to="{name:'reportes.detallesavances', params:{id: item.IDalumno}}">
                             avances
                          </router-link>
                          <router-link class="btn btn-flat btn-secondary btn-sm" :to="{name:'reportes.detallesbitacoras', params:{id: item.IDalumno}}">
                             Bitacoras
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
        fillBsqTesisReporte:{
          nRut: '',
          nIdEscuela:'',
          nIdProfesor:'',
          nIdTesis: '',
          cEstadoNotap: '',
          cTitulo: '',
          cNombreI1: '',
          cEstadoPg: '',
          cEstadoD: '',
          
          dfecharango: '',
          cEstadoTesis: ''
        },
        listRolPermisosByUsuario: JSON.parse(localStorage.getItem('listRolPermisosByUsuario')),
        listFechaUR: [
          {value: '1', label: 'hace 1 año'},
          {value: '2', label: 'hace 2 años'},
          {value: '3', label: 'hace 3 años'},
          {value: '4', label: 'mas de 3 años'}
        ],
        listTipoDeNotap: [
          {value: 'A', label: 'Activa'},
          {value: 'V', label: 'Vencida'}
        ],
        listTipoDeTrabajo: [
          {value: 'Tesis', label: 'Tesis'},
          {value: 'Memoria', label: 'Memoria'}
        ],
        listTipoVinculacion: [
          {value: 'Fondo Concursable', label: 'Fondo Concursable'},
          {value: 'Empresa', label: 'Empresa'},
          {value: 'Comunidad', label: 'Comunidad'}
        ],
        listEstadosTesis: [
          {value: 'A', label: 'Aprobada'},
          {value: 'R', label: 'Reprobada'},
          {value: 'D', label: 'En Desarrollo'}
        ],
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
            'nIdEscuela' : this.fillBsqTesisReporte.nIdEscuela,
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
      getListarTesisReporte(){
        this.fullscreenLoading = true;
        var url = '/administracion/reportes/getListarTesisReporte'
        axios.get(url, {
          params: {
            'nRut'        : this.fillBsqTesisReporte.nRut,
            'nIdEscuela'  : this.fillBsqTesisReporte.nIdEscuela,
            'cEstadoNotap'  : this.fillBsqTesisReporte.cEstadoNotap,
            'dFechaUR'  : this.fillBsqTesisReporte.dFechaUR,
            'nIdProfesor' : this.fillBsqTesisReporte.nIdProfesor,
            'cTipo'       : this.fillBsqTesisReporte.cTipo,
            
            'cEstadoTesis': this.fillBsqTesisReporte.cEstadoTesis,
            'dFechaInicio': (!this.fillBsqTesisReporte.dfecharango) ? '' : this.fillBsqTesisReporte.dfecharango[0],
            'dFechaFin'   : (!this.fillBsqTesisReporte.dfecharango) ? '' : this.fillBsqTesisReporte.dfecharango[1],
          }
        }).then(response => {
            this.inicializarPaginacion();
            this.listTesis = response.data;
            this.fullscreenLoading = false;
        })
      },
      limpiarCriteriosBsq(){
        this.fillBsqTesisReporte.nRut = '';
        this.fillBsqTesisReporte.nIdEscuela = '';
        this.fillBsqTesisReporte.cEstadoNotap = '';
        this.fillBsqTesisReporte.dFechaUR = '';
        this.fillBsqTesisReporte.nIdProfesor = '';
        this.fillBsqTesisReporte.cTipo = '';
        
        this.fillBsqTesisReporte.cEstadoTesis = '';
        this.fillBsqTesisReporte.dfecharango = '';
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
    
    
    }//cierre de methods
  }
</script>

<style>
.scrollTable{
    max-height: 350px !important;
    overflow: auto !important; 
}
.el-range-editor.el-input__inner{
    width: 100% !important;
}
.el-date-editor .el-range-separator{
    width: 7% !important;
}
</style>
