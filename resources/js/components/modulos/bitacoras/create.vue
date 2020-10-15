
<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Bitacora</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/bitacoras'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Registro de bitacoras</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Seleccionar alumno</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="fillCrearBitacora.id_user" 
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
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Comentario</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="80" class="form-control" v-model="fillCrearBitacora.Comentario" @keyup.enter="setRegistrarBitacora">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Acuerdo</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="80" class="form-control" v-model="fillCrearBitacora.Acuerdo" @keyup.enter="setRegistrarBitacora">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarBitacora" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillCrearBitacora:{
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
    
    this.getListarAlumnosByprofesor();
  },
  methods:{
    getListarAlumnosByprofesor(){
      //this.fullscreenLoading = true;
      var url = '/avances/getListarAlumnosByprofesor'
      axios.get(url, {
      }).then(response => {
          //this.inicializarPaginacion();
          this.listAlumnos = response.data;
          //this.fullscreenLoading = false;
      })
    },
    limpiarCriterios(){
      this.fillCrearBitacora.id_user = '';
      this.fillCrearBitacora.Comentario = '';
      this.fillCrearBitacora.Acuerdo = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarRegistrarBitacora(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillCrearBitacora.id_user){
          this.mensajeError.push("El alumno es un campo obligatorio")
        }
        if(!this.fillCrearBitacora.Acuerdo){
          this.mensajeError.push("El acuerdo es un campo obligatorio")
        }
        if(!this.fillCrearBitacora.Comentario){
          this.mensajeError.push("El comentario es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setRegistrarBitacora(){
      if(this.validarRegistrarBitacora()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/bitacoras/setRegistrarBitacora'
      axios.post(url, {
        'id_user'           : this.fillCrearBitacora.id_user,
        'Comentario'        : this.fillCrearBitacora.Comentario,
        'Acuerdo'           : this.fillCrearBitacora.Acuerdo
      }).then(response => {
        this.fullscreenLoading = false;
        this.$router.push('/bitacoras');
      })
    }
    

  
  }// cierre methods
}
</script>

<style>

</style>