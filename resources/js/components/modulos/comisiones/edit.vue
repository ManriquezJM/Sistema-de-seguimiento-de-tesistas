<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Comision</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/comisiones'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Edicion de Comision</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Seleccionar alumno</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillEditarComision.id_user" 
                                                    disabled
                                                    placeholder="Asignar alumno tesista"
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
                                        
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Profesor Comision 1</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="fillEditarComision.Profesor1" 
                                                        placeholder="Asignar Profesor para comision"
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

                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Profesor Comision 2</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="fillEditarComision.Profesor2" 
                                                        placeholder="Asignar Profesor para comision"
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
                                            
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Profesor Externo (opcional)</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="Nombre profesor externo" class="form-control" v-model="fillEditarComision.NombrePEx" @keyup.enter="setEditarComision">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Email Profesor Externo</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="Email profesor externo" class="form-control" v-model="fillEditarComision.EmailPEx" @keyup.enter="setEditarComision">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Institucion profesor externo</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="Institucion profesor externo" class="form-control" v-model="fillEditarComision.InstitucionPEx" @keyup.enter="setEditarComision">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarComision" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillEditarComision:{
        IdComision: this.$attrs.id,
        id_user: '',
        Profesor1: '',
        Profesor2: '',
        NombrePEx: '',
        EmailPEx: '',   
        InstitucionPEx: ''    
      },
      listAlumnos:[],
      listProfesores:[],
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
      this.getComision();
      this.getListarProfesores();
      this.getListarAlumnosByprofesor();
  },
  methods:{
    getComision(){
        var url = '/comisiones/getComision'
        axios.get(url, {
        params: {
          'id' : this.fillEditarComision.IdComision

        }
      }).then(response => {
          console.log(response.data);
          this.fillEditarComision.id_user           = response.data[0].IdAlumno;
          this.fillEditarComision.Profesor1         = response.data[0].id_profesor1;
          this.fillEditarComision.Profesor2         = response.data[0].id_profesor2;
          this.fillEditarComision.NombrePEx         = response.data[0].p_externo;
          this.fillEditarComision.EmailPEx          = response.data[0].correo_p_externo;
          this.fillEditarComision.InstitucionPEx    = response.data[0].institucion_p_externo;
      })
    },
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
    limpiarCriterios(){
      this.fillEditarComision.id_user = '';
      this.fillEditarComision.Comentario = '';
      this.fillEditarComision.Acuerdo = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarEditarComision(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillEditarComision.id_user){
          this.mensajeError.push("El alumno es un campo obligatorio")
        }
        if(!this.fillEditarComision.Profesor1){
          this.mensajeError.push("El Profesor1 es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setEditarComision(){
      if(this.validarEditarComision()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/comisiones/setEditarComision'
      axios.post(url, {
        'IdComision'        : this.fillEditarComision.IdComision,
        'Profesor1'         : this.fillEditarComision.Profesor1,
        'Profesor2'         : this.fillEditarComision.Profesor2,
        'NombrePEx'         : this.fillEditarComision.NombrePEx,
        'EmailPEx'          : this.fillEditarComision.EmailPEx,
        'InstitucionPEx'    : this.fillEditarComision.InstitucionPEx
      }).then(response => {
        this.fullscreenLoading = false;
        this.$router.push('/comisiones');
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