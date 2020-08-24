<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reportes de Tesis</h1>
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
                        <label class="col-md-3 col-form-label">Tipo de trabajo</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqTesisReporte.cTipo" 
                            placeholder="Seleccione un estado"
                            clearable>
                              <el-option
                                v-for="item in listTipoDeTrabajo"
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
                        <label class="col-md-3 col-form-label">Vinculacion</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqTesisReporte.cVinculacion" 
                            placeholder="Seleccione un estado"
                            clearable>
                              <el-option
                                v-for="item in listTipoVinculacion"
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
                        <label class="col-md-3 col-form-label">Estado</label>
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
                            <label class="col-md-3 col-form-label">Rango de Fechas</label>
                            <div class="col-md-9">
                                <el-date-picker
                                    v-model="fillBsqTesisReporte.dfecharango"
                                    type="daterange"
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
                            <i @click.prevent="setGenerarDocumento" class="fas fa-file-excel"></i>
                        </el-tooltip>
                    </template>
                Bandeja de resultados</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listTesis.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Titulo</th>
                        <th>Alumno</th>
                        <th>Vinculacion</th>
                        <th>Estado Tesis</th>
                        <th>Acciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listTesis" :key="index">
                        <td v-text="item.titulo"></td>
                        <td v-text="item.nombre_int1"></td>
                        <td v-text="item.namevinculacion"></td>
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
                            <i class="fas fa-folder"></i> Ver
                          </router-link>
                          <template v-if="item.aprobado_pg == 'A'">
                            <button class="btn btn-flat btn-light btn-sm" @click.prevent="setGenerarDocumento(item.id)">
                              <i class="fas fa-pencil-alt"></i> Ver PDF
                            </button>
                          </template>
                          <template v-if="item.aprobado_pg == 'P' || item.aprobado_pg == 'R'">
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'tesis.editar', params:{id: item.id}}">
                              <i class="fas fa-pencil-alt"></i> Editar
                            </router-link>
                            <template  v-if="listRolPermisosByUsuario.includes('tesis.aprobar')">
                                <button class="btn btn-flat btn-success btn-sm" @click.prevent="setCambiarEstadoFIT(1, item.id)">
                                  <i class="fas fa-check"></i>Aprobar
                                </button>
                                <button class="btn btn-flat btn-danger btn-sm" @click.prevent="setCambiarEstadoFIT(2, item.id)">
                                  <i class="fas fa-trash"></i>Rechazar
                                </button>
                            </template>
                          </template>
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
    <div class="modal fade" :class="{ show: modalShow }" :style="modalShow ? mostrarModal : ocultarModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sistema de tesis UCM</h5>
            <button class="close" @click="abrirModal"></button>
          </div>
          <div class="modal-body">
            
            <template v-if="modalOption == 1">
              <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index" v-text="item"></div>
            </template>
            <template v-if="modalOption == 2">
              
                    <div class="container-fluid">
                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Formulario de inscripcion de tesis</h3>
                        </div>
                        <div class="card-body">
                          <form role="form">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group row">
                                  <label class="col-md-12 col-form-label">Alumno</label>
                                  <div class="col-md-9">
                                      <span class="form-control" v-text="fillVerFIT.cNombre"></span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group row">
                                  <label class="col-md-12 col-form-label">Profesor Guia</label>
                                  <div class="col-md-9">
                                      <span class="form-control" v-text="fillVerFIT.cSlug"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>

                      <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Listado de Permisos</h3>
                        </div>
                        <div class="card-body table-resposive">
                          <template v-if="listPermisos.length">
                          <div class="scrollTable">
                            <table class ="table table-hover table-head-fixed text-nowrap projects">
                              <thead>
                                <tr>
                                  <th>Nombre</th>
                                  <th>Url amigable </th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="(item, index) in listPermisos" :key="index">
                                  <td v-text="item.name"></td>
                                  <td v-text="item.slug"></td>
                                </tr>
                              </tbody>
                            </table>
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

            </template>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
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
        nIdTesis: '',
        cTitulo: '',
        nIdPg: '',
        cNombreI1: '',
        cEstadoPg: '',
        cEstadoD: '',
        cTipo: '',
        cVinculacion: '',
        dfecharango: '',
        cEstadoTesis: ''
      },
      fillVerFIT:{
        cNombre: '',
        cSlug: ''
      },
      listRolPermisosByUsuario: JSON.parse(localStorage.getItem('listRolPermisosByUsuario')),
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
    //this.getListarTesisReporte();
  },
  methods:{
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
          'cTipo'     : this.fillBsqTesisReporte.cTipo,
          'cVinculacion'   : this.fillBsqTesisReporte.cVinculacion,
          'cEstadoTesis'     : this.fillBsqTesisReporte.cEstadoTesis,
          'dFechaInicio'  :   (!this.fillBsqTesisReporte.dfecharango) ? '' : this.fillBsqTesisReporte.dfecharango[0],
          'dFechaFin'     :   (!this.fillBsqTesisReporte.dfecharango) ? '' : this.fillBsqTesisReporte.dfecharango[1],
        }
      }).then(response => {
          this.inicializarPaginacion();
          this.listTesis = response.data;
          this.fullscreenLoading = false;
      })
    },
    limpiarCriteriosBsq(){
      this.fillBsqTesisReporte.cTipo = '';
      this.fillBsqTesisReporte.cVinculacion = '';
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
    abrirModalByOption(modulo, accion, data){
    switch (modulo) {
      case "roles":
        {
          switch (accion) {
            case "ver":
              {
                this.fillVerFIT.cNombre = data.name;
                this.fillVerFIT.cSlug = data.slug;
                //obtener los permisos por el rol seleccionado
                this.getListarPermisosByRol(data.id);
              }
              break;
          
            default:
              break;
          }
        }
        
        break;
    
      default:
        break;
    }
  },
  setCambiarEstadoFIT(op, id){
      Swal.fire({
      title: 'Estas seguro? ' + ((op == 1) ? 'Aprobar ' : 'Rechazar ') + '  El formulario de inscripcion',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: ((op == 1) ? 'Si, Aprobar' : 'Si, Rechazar')
    }).then((result) => {
      if (result.value) {
        this.fullscreenLoading = true;
        var url = '/administracion/alumno/setCambiarEstadoFIT'
        axios.post(url, {
          'nIdTesis' : id,
          'cEstadoPg'    : (op == 1) ? 'A' : 'R'
        }).then(response => {
            Swal.fire({
            icon: 'success',
            title: 'Se ' + ((op == 1) ? 'Aprobo ' : 'Rechazo ') +' El formulario de inscripcion',
            showConfirmButton: false,
            timer: 1500
            })
            this.getListarTesisReporte();
        })
      }
    })
    }
   

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
