<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar formulario de inscripcion de tesis</h1>
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
                            <h3 class="card-title">Formulario de edicion  FIT</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                      <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Profesor Guia</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillEditarFIT.nIdPg" 
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
                                                <label class="col-md-3 col-form-label">Tipo de trabajo</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillEditarFIT.cTipo" 
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
                                                <label class="col-md-3 col-form-label">Titulo</label>
                                                <div class="col-md-9">
                                                    <el-input
                                                      type="textarea"
                                                      :autosize="{ minRows: 2, maxRows: 5}"
                                                      maxlength="130"
                                                      placeholder="Objetivo"
                                                      show-word-limit
                                                      v-model="fillEditarFIT.cTitulo">
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
                                                      show-word-limit
                                                      v-model="fillEditarFIT.cContribucion">
                                                    </el-input>
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
                                                      show-word-limit
                                                      v-model="fillEditarFIT.cObjetivo">
                                                    </el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Descripcion
                                                </label>
                                                <div class="col-md-9">
                                                    <el-input
                                                      type="textarea"
                                                      :autosize="{ minRows: 2, maxRows: 5}"
                                                      maxlength="500"
                                                      placeholder="Objetivo"
                                                      show-word-limit
                                                      v-model="fillEditarFIT.cDescripcion">
                                                    </el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Vinculacion</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillEditarFIT.nIdVinculacion" 
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
                                                <label class="col-md-3 col-form-label">Nombre integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="40" class="form-control" v-model="fillEditarFIT.cNombreI1" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Rut Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="10" placeholder="sin puntos 19866976-1" class="form-control" v-model="fillEditarFIT.cRutI1" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Telefono Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="tel" maxlength="9" class="form-control" v-model="fillEditarFIT.cTelefonoI1" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Año ingreso Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="4" class="form-control" v-model="fillEditarFIT.cIngresoI1" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">email Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="email" maxlength="40" class="form-control" v-model="fillEditarFIT.cEmailI1" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nombre Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="40" class="form-control" v-model="fillEditarFIT.cNombreI2" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Rut Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="10" placeholder="sin puntos 19866976-1" class="form-control" v-model="fillEditarFIT.cRutI2" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Email Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="email" maxlength="40" class="form-control" v-model="fillEditarFIT.cEmailI2" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Año ingreso Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="4" class="form-control" v-model="fillEditarFIT.cIngresoI2" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Telefono Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="tel" maxlength="9" class="form-control" v-model="fillEditarFIT.cTelefonoI2" @keyup.enter="setEditarTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Fecha que curso su ultimo ramo</label>
                                                <div class="col-md-9">
                                                      <el-date-picker
                                                        v-model="fillEditarFIT.dFechaUR"
                                                        type="month"
                                                        placeholder="Elige mes y año">
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
                                  <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarTesis">Editar</button>
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
      fillEditarFIT:{
        nIdTesis: this.$attrs.id,
        cTitulo: '',
        nIdPg: '',
        nIdVinculacion: '',
        dFechaUR:'',
        cTipo: '',
        cObjetivo: '',
        cDescripcion: '',
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
    this.getTesisById();
    this.getListarVinculacion();
  },
  methods:{
    getListarProfesores(){
      this.fullscreenLoading = true;
      var url = '/alumno/getListarProfesores'
      axios.get(url, {
      }).then(response => {
          this.listProfesores = response.data;
          this.fullscreenLoading = false;
      })
    },
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
    limpiarCriterios(){
      this.fillEditarFIT.cNombre = '';
      this.fillEditarFIT.nIdEscuela = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarRegistrarTesis(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillEditarFIT.cTitulo){
          this.mensajeError.push("El Titulo es un campo obligatorio")
        }
        if(!this.fillEditarFIT.nIdPg){
          this.mensajeError.push("El profesor guia es un campo obligatorio")
        }
        if(!this.fillEditarFIT.cTipo){
          this.mensajeError.push("El tipo es un campo obligatorio")
        }
        if(!this.fillEditarFIT.cObjetivo){
          this.mensajeError.push("El objetivo es un campo obligatorio")
        }
        if(!this.fillEditarFIT.dFechaUR){
          this.mensajeError.push("La fecha el ultimo ramo es un campo obligatorio")
        }
        if(!this.fillEditarFIT.cContribucion){
          this.mensajeError.push("La contribucion es un campo obligatorio")
        }
        if(!this.fillEditarFIT.cNombreI1){
          this.mensajeError.push("El nombre es un campo obligatorio")
        }
        if(!this.fillEditarFIT.cTelefonoI1){
          this.mensajeError.push("El telefono es un campo obligatorio")
        }
        if(!this.fillEditarFIT.cRutI1){
          this.mensajeError.push("El rut es un campo obligatorio")
        }
        if(!this.fillEditarFIT.cEmailI1){
          this.mensajeError.push("El email es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setEditarTesis(){
      if(this.validarRegistrarTesis()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/alumno/setEditarTesis'
      axios.post(url, {
        'id'                   : this.fillEditarFIT.nIdTesis,
        'titulo'               : this.fillEditarFIT.cTitulo,
        'id_profesorguia'      : this.fillEditarFIT.nIdPg,
        'id_vinculacion'       : this.fillEditarFIT.nIdVinculacion,
        'fecha_ultimoramo'     : this.fillEditarFIT.dFechaUR,
        'tipo'                 : this.fillEditarFIT.cTipo,
        'objetivo'             : this.fillEditarFIT.cObjetivo,
        'descripcion'          : this.fillEditarFIT.cDescripcion,
        'contribucion'         : this.fillEditarFIT.cContribucion,
        'nombre_int1'          : this.fillEditarFIT.cNombreI1,
        'rut_int1'             : this.fillEditarFIT.cRutI1,
        'telefono_int1'        : this.fillEditarFIT.cTelefonoI1,
        'ingreso_int1'         : this.fillEditarFIT.cIngresoI1,
        'email_int1'           : this.fillEditarFIT.cEmailI1,
        'nombre_int2'          : this.fillEditarFIT.cNombreI2,
        'rut_int2'             : this.fillEditarFIT.cRutI2,
        'email_int2'           : this.fillEditarFIT.cEmailI2,
        'ingreso_int2'         : this.fillEditarFIT.cIngresoI2,
        'telefono_int2'        : this.fillEditarFIT.cTelefonoI2,
        'aprobado_pg'          : 'P'
      }).then(response => {
        this.fullscreenLoading = false;
        Swal.fire({
          icon: 'success',
          title: 'Editado Correctamente',
          showConfirmButton: false,
          timer: 1500
        })
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
    getTesisById(){
        this.fullscreenLoading = true;
        var url = '/alumno/getListarTesisView'
        axios.get(url, {
        params: {
          'nIdTesis' : this.fillEditarFIT.nIdTesis
        }
      }).then(response => {
          //this.getUsuarioEditar(response.data[0])
          this.getUsuarioVer(response.data[0])

          this.fullscreenLoading = false;
      })
    },
    getUsuarioVer(data){
          this.fillEditarFIT.nIdPg = data.id_profesorguia;
          this.fillEditarFIT.cTitulo = data.titulo;
          this.fillEditarFIT.nIdPg = data.id_profesorguia;
          this.fillEditarFIT.nIdVinculacion = data.id_vinculacion;
          this.fillEditarFIT.cTipo = data.tipo;
          this.fillEditarFIT.dFechaUR = data.fecha_ultimoramo;
          this.fillEditarFIT.cObjetivo = data.objetivo;
          this.fillEditarFIT.cDescripcion = data.descripcion;
          this.fillEditarFIT.cContribucion = data.contribucion;
          this.fillEditarFIT.cNombreI1 = data.nombre_int1;
          this.fillEditarFIT.cRutI1 = data.rut_int1;
          this.fillEditarFIT.cTelefonoI1 = data.telefono_int1;
          this.fillEditarFIT.cIngresoI1 = data.ingreso_int1;
          this.fillEditarFIT.cEmailI1 = data.email_int1;
          this.fillEditarFIT.cNombreI2 = data.nombre_int2;
          this.fillEditarFIT.cRutI2 = data.rut_int2;
          this.fillEditarFIT.cEmailI2 = data.email_int2;
          this.fillEditarFIT.cIngresoI2 = data.ingreso_int2;
          this.fillEditarFIT.cTelefonoI2 = data.telefono_int2;
    },
  
  }// cierre methods
}
</script>

<style>

</style>