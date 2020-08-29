
<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Comision</h1>
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
                            <h3 class="card-title">Formulario Registro de Comision</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Seleccionar alumno</label>
                                                <div class="col-md-9">
                                                    <el-select v-model="fillCrearComision.id_user" 
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
                                                        <el-select v-model="fillCrearComision.Profesor1" 
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
                                                        <el-select v-model="fillCrearComision.Profesor2" 
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
                                                    <input type="text" placeholder="Nombre profesor externo" class="form-control" v-model="fillCrearComision.NombrePEx" @keyup.enter="setRegistrarComision">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Email Profesor Externo</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="Email profesor externo" class="form-control" v-model="fillCrearComision.EmailPEx" @keyup.enter="setRegistrarComision">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Institucion profesor externo</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="Institucion profesor externo" class="form-control" v-model="fillCrearComision.InstitucionPEx" @keyup.enter="setRegistrarComision">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarComision" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillCrearComision:{
        id_user: '',
        Comentario: '',
        Acuerdo: ''
      },
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
      this.fillCrearComision.id_user = '';
      this.fillCrearComision.Comentario = '';
      this.fillCrearComision.Acuerdo = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarRegistrarComision(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillCrearComision.id_user){
          this.mensajeError.push("El alumno es un campo obligatorio")
        }
        if(!this.fillCrearComision.Profesor1){
          this.mensajeError.push("El acuerdo es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setRegistrarComision(){
      if(this.validarRegistrarComision()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/comisiones/setRegistrarComision'
      axios.post(url, {
        'id_user'           : this.fillCrearComision.id_user,
        'Profesor1'         : this.fillCrearComision.Profesor1,
        'Profesor2'         : this.fillCrearComision.Profesor2,
        'NombrePEx'         : this.fillCrearComision.NombrePEx,
        'EmailPEx'          : this.fillCrearComision.EmailPEx,
        'InstitucionPEx'    : this.fillCrearComision.InstitucionPEx
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