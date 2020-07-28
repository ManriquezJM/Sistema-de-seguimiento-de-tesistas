<template>
  
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Sistema de seguimiento de tesis </b><p>Facultad de Ingenieria UCM</p></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Registro de alumno</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" v-model="fillRegistrarAlumno.cNombre" @keyup.enter="setRegistrarAlumno" class="form-control" placeholder="Nombres" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" v-model="fillRegistrarAlumno.cApellido" @keyup.enter="setRegistrarAlumno" class="form-control" placeholder="Apellidos" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <el-select v-model="fillRegistrarAlumno.nIdEscuela" 
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
                    <div class="input-group mb-3">
                        <input type="email" v-model="fillRegistrarAlumno.cCorreo" @keyup.enter="setRegistrarAlumno" class="form-control" placeholder="Email" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" v-model="fillRegistrarAlumno.cContrasena" @keyup.enter="setRegistrarAlumno" class="form-control" placeholder="Password" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </form>
                   <div class="social-auth-links text-center mb-3">
                        <button class="btn btn-flat btn-block btn-danger" @click.prevent="setRegistrarAlumno" v-loading.fullscreen.lock="fullscreenLoading">
                        Iniciar sesion
                        </button>
                    </div>
                
                <Router-link :to="{name:'login'}"> 
                    <b>Ya tengo una cuenta</b>
                </Router-link>
            </div>
        <!-- /.form-box -->
        </div><!-- /.card -->
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
        fillRegistrarAlumno:{
            cNombre: '',
            cApellido: '',
            nIdEscuela: '',
            cCorreo: '',
            cContrasena: '',
            oFotografia: '',
            nIdRol:  2
        },
        listEscuelas:[],
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
   mounted(){
    this.getListarEscuelas();
  },
  methods:{
      abrirModal(){
      this.modalShow = !this.modalShow;
    },
      getListarEscuelas(){
      this.fullscreenLoading = true;
      var url = '/administracion/escuelas/getListarEscuelas'
      axios.get(url, {

      }).then(response => {
          this.listEscuelas = response.data;
          this.fullscreenLoading = false;
      })
    },
    setRegistrarAlumno(){
        console.log('holapepee')
      if (this.validarRegistrarAlumno()){
          this.modalShow = true;
          return;
      }
      if(!this.fillRegistrarAlumno.oFotografia || this.fillRegistrarAlumno.oFotografia == undefined){
        this.fullscreenLoading = true;
        this.setGuardarAlumno();
      } else {
        this.setRegistrarArchivo();
      }
    },
    validarRegistrarAlumno(){
      this.error = 0;
      this.mensajeError = [];

        if(!this.fillRegistrarAlumno.cNombre){
          this.mensajeError.push("el nombre es un campo obligatorio")
        }
        if(!this.fillRegistrarAlumno.cApellido){
          this.mensajeError.push("el apellido es un campo obligatorio")
        }
        if(!this.fillRegistrarAlumno.cCorreo){
          this.mensajeError.push("el correo es un campo obligatorio")
        }
        if(!this.fillRegistrarAlumno.cContrasena){
          this.mensajeError.push("la contraseña es un campo obligatorio")
        }
        if(!this.fillRegistrarAlumno.nIdEscuela){
          this.mensajeError.push("la escuela es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setGuardarAlumno(nIdFile){
      var url = 'authenticate/registro/setRegistrarAlumno'
      axios.post(url, {
        'cNombre'    : this.fillRegistrarAlumno.cNombre,
        'cApellido'  : this.fillRegistrarAlumno.cApellido,
        'nIdEscuela'   : this.fillRegistrarAlumno.nIdEscuela,
        'cCorreo'    : this.fillRegistrarAlumno.cCorreo,
        'cContrasena': this.fillRegistrarAlumno.cContrasena,
        
        'oFotografia': nIdFile
      }).then(response => {
        this.setEditarRolAlumno(response.data);
      })
    },
    setEditarRolAlumno(nIdUsuario){
        this.fullscreenLoading = false;
        //this.$router.push('/usuarios');

        var url = '/authenticate/registro/setEditarRolAlumno'
        axios.post(url, {
        'nIdUsuario'    : nIdUsuario,
        'nIdRol'  : this.fillRegistrarAlumno.nIdRol,
      }).then(response => {
        //console.log("Registro Usuario exitosamente");
        this.fullscreenLoading = false;
        this.$router.push('/');
      })
    },
  
  
  
  },

}
</script>

<style>

</style>