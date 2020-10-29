<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de tesis aprobadas</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
           
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario registro rapido de tesis finalizadas</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
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
                                                <label class="col-md-3 col-form-label">Alumno</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillCrearFIT.nIdEst" 
                                                    placeholder="Asignar Alumno"
                                                    clearable>
                                                    <el-option
                                                        v-for="item in listAlumnos"
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
                                                    <el-select v-model="fillCrearFIT.cTipo" 
                                                    placeholder="Seleccione un Tipo de trabajo"
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
                                                      placeholder="Titulo de la tesis"
                                                      show-word-limit
                                                      v-model="fillCrearFIT.cTitulo">
                                                    </el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nota Final Tesis</label>
                                                <div class="col-md-9">
                                                    <template>
                                                        <el-input-number v-model="fillCrearFIT.Nota" size="large" :min="1" :precision="2" :step="0.1" :max="7"></el-input-number>
                                                    </template>
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
                                                      placeholder="Contribucion esperada"
                                                      show-word-limit
                                                      v-model="fillCrearFIT.cContribucion">
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
                                                      placeholder="Objetivo de la tesis"
                                                      show-word-limit
                                                      v-model="fillCrearFIT.cObjetivo">
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
                                                      placeholder="Descripcion del tema"
                                                      show-word-limit
                                                      v-model="fillCrearFIT.cDescripcion">
                                                    </el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Vinculacion</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillCrearFIT.nIdVinculacion" 
                                                    placeholder="Asignar Vinculacion (opcional)"
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
                                                    <input type="text" class="form-control" maxlength="40" v-model="fillCrearFIT.cNombreI1" @keyup.enter="setRegistrarTesisfinalizada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Rut Integrante 1</label>
                                                <div class="col-md-9">   
                                               <input type="text" class="form-control" maxlength="10" placeholder="sin puntos 19866976-1" v-model="fillCrearFIT.cRutI1" @keyup.enter="setRegistrarTesisfinalizada"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Telefono Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="tel" maxlength="9" placeholder="944455566" class="form-control" v-model="fillCrearFIT.cTelefonoI1" @keyup.enter="setRegistrarTesisfinalizada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Año ingreso Integrante 1</label>
                                                <div class="col-md-9">
                                                      <el-date-picker
                                                        v-model="fillCrearFIT.cIngresoI1"
                                                        type="year"
                                                        size="large"
                                                        placeholder="Elige año">
                                                      </el-date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">email Integrante 1</label>
                                                <div class="col-md-9">
                                                    <input type="email" maxlength="40"  class="form-control" v-model="fillCrearFIT.cEmailI1" @keyup.enter="setRegistrarTesisfinalizada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nombre Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" maxlength="50" v-model="fillCrearFIT.cNombreI2" @keyup.enter="setRegistrarTesisfinalizada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Rut Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" maxlength="12" placeholder="sin puntos 19866976-1" v-model="fillCrearFIT.cRutI2" @keyup.enter="setRegistrarTesisfinalizada">
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Email Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" maxlength="40"  v-model="fillCrearFIT.cEmailI2" @keyup.enter="setRegistrarTesisfinalizada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Año ingreso Integrante 2</label>
                                                <div class="col-md-9">
                                                      <el-date-picker
                                                        v-model="fillCrearFIT.cIngresoI2"
                                                        type="year"
                                                        placeholder="Elige año">
                                                      </el-date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Telefono Integrante 2</label>
                                                <div class="col-md-9">
                                                    <input type="tel" maxlength="9" placeholder="944455566" class="form-control" v-model="fillCrearFIT.cTelefonoI2" @keyup.enter="setRegistrarTesisfinalizada">
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Fecha que curso su ultimo ramo</label>
                                                <div class="col-md-9">
                                                      <el-date-picker
                                                        v-model="fillCrearFIT.dFechaUR"
                                                        type="month"
                                                        placeholder="Elige mes y año">
                                                      </el-date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Archivo asociado</label>
                                                <div class="col-md-9">
                                                    <input type="file" accept="application/pdf"  class="form-control" @change="getFile">
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarTesisfinalizada" v-loading.fullscreen.lock="fullscreenLoading"
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
        Nota: '',
        cTitulo: '',
        oArchivo: '',
        nIdPg: '',
        nIdEst:'',
        nIdVinculacion: '',
        cTipo: '',
        dFechaUR: '',
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
      form : new FormData,
      listTipo: [
        {value: 'Tesis', label: 'Tesis'},
        {value: 'Memoria', label: 'Memoria'},
        {value: 'Proyecto de titulo', label: 'Proyecto de titulo'}
      ],
      listProfesores:[],
      listEscuelas:[],
      listVinculacion:[],
      listAlumnos:[],
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
    this.getListarAlumnos();
  },
  methods:{
      getFile(e){
      this.fillCrearFIT.oArchivo = e.target.files[0];
    },
      getListarAlumnos(){
      this.fullscreenLoading = true;
      var url = '/alumno/getListarEstudiantes'
      axios.get(url, {
        
      }).then(response => {
          this.inicializarPaginacion();
          this.listAlumnos = response.data;
          this.fullscreenLoading = false;
      })
    },
    getListarVinculacion(){
      this.fullscreenLoading = true;
      var url = '/administracion/vinculacion/getListarVinculacion'
      axios.get(url, {
      }).then(response => {
          this.listVinculacion = response.data;
          this.fullscreenLoading = false;
      })
    },
    getListarProfesores(){
      this.fullscreenLoading = true;
      var url = '/alumno/getListarProfesores'
      axios.get(url, {
      }).then(response => {
          this.listProfesores = response.data;
          this.fullscreenLoading = false;
      })
    },
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
        if(!this.fillCrearFIT.nIdEst){
          this.mensajeError.push("El Alumno es un campo obligatorio")
        }
        if(!this.fillCrearFIT.cTipo){
          this.mensajeError.push("El tipo es un campo obligatorio")
        }
        if(!this.fillCrearFIT.Nota){
          this.mensajeError.push("La Nota es un campo obligatorio")
        }
        if(!this.fillCrearFIT.oArchivo){
          this.mensajeError.push("El archivo de tesis un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setRegistrarTesisfinalizada(){
      if (this.validarRegistrarTesis()){
          this.modalShow = true;
          return;
      }
      if(!this.fillCrearFIT.oArchivo || this.fillCrearFIT.oArchivo == undefined){
        this.fullscreenLoading = true;
        this.setGuardarTesisfinalizada();
      } else {
        this.setRegistrarArchivoPDF();
      }
    },
    setRegistrarArchivoPDF(){
      this.form.append('file', this.fillCrearFIT.oArchivo)
      const config = { headers: {'Content-Type': 'multipart/form-data'}}
      var url = '/archivo/setRegistrarArchivoPDF'
      axios.post(url, this.form, config).then(response =>{
        console.log(response)
        var nIdFile = response.data.id;
        this.setGuardarTesisfinalizada(nIdFile);
      }) 
    },
    setGuardarTesisfinalizada(nIdFile){
      if(this.validarRegistrarTesis()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/alumno/setRegistrarTesisfinalizada'
      axios.post(url, {
        'cTitulo'            : this.fillCrearFIT.cTitulo,
        'Nota'               : this.fillCrearFIT.Nota,
        'nIdPg'              : this.fillCrearFIT.nIdPg,
        'nIdEst'             : this.fillCrearFIT.nIdEst,
        'nIdFile'            : nIdFile,
        'nIdVinculacion'     : this.fillCrearFIT.nIdVinculacion,
        'cTipo'              : this.fillCrearFIT.cTipo,
        'dFechaUR'           : this.fillCrearFIT.dFechaUR,
        'cObjetivo'          : this.fillCrearFIT.cObjetivo,
        'cDescripcion'       : this.fillCrearFIT.cDescripcion,
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
        this.$router.push('/registrodetesis');
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