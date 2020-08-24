<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ingresar formulario de inscripcion de tesis</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/tesis'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario  inscripcion de tesis</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Titulo</label>
                                                <div class="col-md-9">
                                                    <el-input
                                                      type="textarea"
                                                      :autosize="{ minRows: 2, maxRows: 5}"
                                                      maxlength="200"
                                                      placeholder="Objetivo"
                                                      v-model="fillCrearFIT.cTitulo">
                                                    </el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Profesor Guia</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillCrearFIT.nIdPg" 
                                                    placeholder="Asignar Profesor Guia"
                                                    clearable>
                                                    <el-option
                                                        v-for="item in listProfesores"
                                                        :key="item.id_user"
                                                        :label="item.fullname"
                                                        :value="item.id_user">
                                                    </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Vinculacion</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillCrearFIT.nIdVinculacion" 
                                                    placeholder="Asignar Vinculacion"
                                                    clearable>
                                                    <el-option
                                                        v-for="item in listVinculacion"
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
                                                <label class="col-md-3 col-form-label">Tipo de trabajo</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillCrearFIT.cTipo" 
                                                    placeholder="Seleccione un Tipo"
                                                    clearable>
                                                    <el-option
                                                        v-for="item in listTipo"
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
                                                <label class="col-md-3 col-form-label">Objetivo
                                                </label>
                                                <div class="col-md-9">
                                                    <el-input
                                                      type="textarea"
                                                      :autosize="{ minRows: 2, maxRows: 5}"
                                                      maxlength="500"
                                                      placeholder="Objetivo"
                                                      v-model="fillCrearFIT.cObjetivo">
                                                    </el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Contribucion</label>
                                                <div class="col-md-9">
                                                    <el-input
                                                      type="textarea"
                                                      :autosize="{ minRows: 2, maxRows: 5}"
                                                      maxlength="500"
                                                      placeholder="Contribucion"
                                                      v-model="fillCrearFIT.cContribucion">
                                                    </el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nombre integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cNombreI1" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Rut Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cRutI1" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Telefono Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cTelefonoI1" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Año ingreso Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cIngresoI1" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">email Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cEmailI1" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nombre Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cNombreI2" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Rut Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cRutI2" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Email Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cEmailI2" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Año ingreso Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cIngresoI2" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Telefono Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillCrearFIT.cTelefonoI2" @keyup.enter="setRegistrarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarTesis" v-loading.fullscreen.lock="fullscreenLoading"
                                    >Registrar</button>
                                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriterios">Limpiar</button>
                                    </div>
                                </div>
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
            <div class="callout callout-danger" style="padding: 5px" v-for="(item, index) in mensajeError" :key="index" v-text="item"></div>
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
  data(){
    return{
      fillCrearFIT:{
        cTitulo: '',
        nIdPg: '',
        nIdVinculacion: '',
        cTipo: '',
        cObjetivo: '',
        cContribucion: '',
        cNombreI1: '',
        cRutI1: '',
        cTelefonoI1: '',
        cIngresoI1: '',
        cEmailI1: '',
        cNombreI2: '',
        cRutI2: '',
        cEmailI2: '',
        cIngresoI2: '',
        cTelefonoI2: ''
      },
      listTipo: [
        {value: 'Tesis', label: 'Tesis'},
        {value: 'Memoria', label: 'Memoria'}
      ],
      listProfesores:[],
      listEscuelas:[],
      listVinculacion:[],
      fullscreenLoading: false,
      modalShow: false,
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
  },
   mounted(){
    this.getListarProfesores();
    this.getListarVinculacion();
  },
  methods:{
    getListarVinculacion(){
      this.fullscreenLoading = true;
      var url = '/administracion/vinculacion/getListarVinculacion'
      axios.get(url, {
      }).then(response => {
          //this.inicializarPaginacion();
          this.listVinculacion = response.data;
          this.fullscreenLoading = false;
      })
    },
    getListarProfesores(){
      this.fullscreenLoading = true;
      var url = '/alumno/getListarProfesores'
      axios.get(url, {
      }).then(response => {
          //this.inicializarPaginacion();
          this.listProfesores = response.data;
          this.fullscreenLoading = false;
      })
    },
    /*getListarUsuarios(){
      this.fullscreenLoading = true;
      var url = '/administracion/usuario/getListarUsuarios'
      axios.get(url, {
      }).then(response => {
          //this.inicializarPaginacion();
          this.listProfesores = response.data;
          this.fullscreenLoading = false;
      })
    },*/

    limpiarCriterios(){
      this.fillCrearFIT.cNombre = '';
      this.fillCrearFIT.nIdEscuela = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarRegistrarTesis(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillCrearFIT.cTitulo){
          this.mensajeError.push("El Titulo es un campo obligatorio")
        }
        if(!this.fillCrearFIT.nIdPg){
          this.mensajeError.push("El profesor guia es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cTipo){
          this.mensajeError.push("El tipo es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cObjetivo){
          this.mensajeError.push("El objetivo es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cContribucion){
          this.mensajeError.push("La contribucion es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cNombreI1){
          this.mensajeError.push("El nombre es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cTelefonoI1){
          this.mensajeError.push("El telefono es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cRutI1){
          this.mensajeError.push("El rut es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cEmailI1){
          this.mensajeError.push("El email es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setRegistrarTesis(){
      if(this.validarRegistrarTesis()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/alumno/setRegistrarTesis'
      axios.post(url, {
        'cTitulo'            : this.fillCrearFIT.cTitulo,
        'nIdPg'              : this.fillCrearFIT.nIdPg,
        'nIdVinculacion'     : this.fillCrearFIT.nIdVinculacion,
        'cTipo'              : this.fillCrearFIT.cTipo,
        'cObjetivo'          : this.fillCrearFIT.cObjetivo,
        'cContribucion'      : this.fillCrearFIT.cContribucion,
        'cNombreI1'          : this.fillCrearFIT.cNombreI1,
        'cRutI1'             : this.fillCrearFIT.cRutI1,
        'cTelefonoI1'        : this.fillCrearFIT.cTelefonoI1,
        'cIngresoI1'         : this.fillCrearFIT.cIngresoI1,
        'cEmailI1'           : this.fillCrearFIT.cEmailI1,
        'cNombreI2'          : this.fillCrearFIT.cNombreI2,
        'cRutI2'             : this.fillCrearFIT.cRutI2,
        'cEmailI2'           : this.fillCrearFIT.cEmailI2,
        'cIngresoI2'         : this.fillCrearFIT.cIngresoI2,
        'cTelefonoI2'        : this.fillCrearFIT.cTelefonoI2
      }).then(response => {
        this.fullscreenLoading = false;
        this.$router.push('/tesis');
      })
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

  
  }// cierre methods
}
</script>

<style>

</style>