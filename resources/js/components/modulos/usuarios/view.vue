<template>
  <div>
      <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuarios</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
        </div>
        
        <div class="content container-fluid"> 
            <div class="row">
                <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  
                  <template v-if="!fillVerUsuarios.cRutaArchivo">
                              <img class="profile-user-img img-fluid img-circle img-max-heigth" src="/img/avatar.png" alt="User profile picture">  
                          </template>
                  <template v-else> 
                              <img :src="fillVerUsuarios.cRutaArchivo" :alt="fillVerUsuarios.cNombre" class="profile-user-img img-fluid img-circle img-max-heigth"> 
                  </template>
                </div>

                <h3 class="profile-username text-center">{{fillVerUsuarios.cNombre + ' ' + fillEditarUsuarios.cApellido}}</h3>

                <p class="text-muted text-center">{{fillVerUsuarios.cNombreRol}}</p>

      
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Acerca de mi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-envelope-open-text"></i> Correo</strong>

                <p class="text-muted" v-text="fillVerUsuarios.cCorreo">
                </p>

                
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

              <div class="col-md-8">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills position-reverse">
                      <router-link class="nav-link active" :to="'/usuarios'">
                        <i class="fas fa-arrow-left"></i>Regresar
                      </router-link>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane active" id="settings">
                        <form class="form-horizontal">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Nombres</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="fillEditarUsuarios.cNombre" @keyup.enter="setEditarUsuario">
                            </div>
                          </div>
                           <div class="form-group row">
                            <label class="col-md-3 col-form-label">Apellidos</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="fillEditarUsuarios.cApellido" @keyup.enter="setEditarUsuario">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Correo</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="fillEditarUsuarios.cCorreo" @keyup.enter="setEditarUsuario">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Contraseña</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="fillEditarUsuarios.cContrasena" @keyup.enter="setEditarUsuario">
                            </div>
                          </div>
                        
                          
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Fotografia</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control"  @change="getFile">
                            </div>
                          </div>
                        
                    
                          <div class="form-group row">
                            <div class=" col-sm-12">
                              <button class="btn btn-flat btn-info btnFull" @click.prevent="setEditarUsuario">Editar</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
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
      fillEditarUsuarios:{
        nIdUsuario: this.$attrs.id_user,
        cNombre: '',
        cApellido: '',
        cCorreo: '',
        cContrasena: '',
        cEscuela: '',
        oFotografia: '',
        cRutaArchivo: ''
      },
      fillVerUsuarios:{
        nIdUsuario: this.$attrs.id_user,
        cNombre: '',
        cApellido: '',
        cCorreo: '',
        cContrasena: '',
        cEscuela: '',
        oFotografia: '',
        cRutaArchivo: '',
        cNombreRol: ''
      },
      form: new FormData,
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
      this.getUsuarioById();
      this.getRolByUsuario();
  },
  methods:{
    getFile(e){
      this.fillEditarUsuarios.oFotografia = e.target.files[0];
    },
    getRolByUsuario(){
      var url = '/administracion/usuario/getRolByUsuario'
      axios.get(url, {
        params:{
          'nIdUsuario' : this.fillVerUsuarios.nIdUsuario
        }
      }).then(response => {
          this.fillVerUsuarios.cNombreRol = (response.data.length == 0) ? '' : response.data[0].name;
          this.fullscreenLoading = false;
      })
    },
  getUsuarioById(){
        this.fullscreenLoading = true;
        var url = '/administracion/usuario/getListarUsuarios'
        axios.get(url, {
        params: {
          'nIdUsuario' : this.fillEditarUsuarios.nIdUsuario
        }
      }).then(response => {
          this.getUsuarioEditar(response.data[0])
          this.getUsuarioVer(response.data[0])

          this.fullscreenLoading = false;
      })
    },
    getUsuarioEditar(data){
          this.fillEditarUsuarios.cNombre = data.nombres;
          this.fillEditarUsuarios.cApellido = data.apellidos;
          this.fillEditarUsuarios.cCorreo = data.email;
          this.fillEditarUsuarios.cContrasena = data.password;
          this.fillEditarUsuarios.cEscuela = data.id_escuela;
    },
    getUsuarioVer(data){
          this.fillVerUsuarios.cNombre = data.nombres;
          this.fillVerUsuarios.cApellido = data.apellidos;
          this.fillVerUsuarios.cCorreo = data.email;
          this.fillVerUsuarios.cContrasena = data.password;
          this.fillVerUsuarios.cEscuela = data.id_escuela;
          this.fillVerUsuarios.cRutaArchivo = data.profile_image;
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    setEditarUsuario(){
      if (this.validarRegistrarUsuario()){
          this.modalShow = true;
          return;
      }
      this.fullscreenLoading = true;
      if(!this.fillEditarUsuarios.oFotografia || this.fillEditarUsuarios.oFotografia == undefined){
        
        this.setGuardarUsuario(0);
      } else {
        this.setRegistrarArchivo();
      }
    },
    setRegistrarArchivo(){
      this.form.append('file', this.fillEditarUsuarios.oFotografia)
      const config = { headers: {'Content-Type': 'multipart/form-data'}}
      var url = '/archivo/setRegistrarArchivo'
      axios.post(url, this.form, config).then(response =>{
        console.log(response)
        var nIdFile = response.data[0].nIdFile;
        this.setGuardarUsuario(nIdFile);
      }) 
    },
    setGuardarUsuario(nIdFile){
      var url = '/administracion/usuario/setEditarUsuario'
      axios.post(url, {
        'nIdUsuario' : this.fillEditarUsuarios.nIdUsuario, 
        'cNombre'    : this.fillEditarUsuarios.cNombre,
        'cApellido'  : this.fillEditarUsuarios.cApellido,
        'cCorreo'    : this.fillEditarUsuarios.cCorreo,
        'cContrasena': this.fillEditarUsuarios.cContrasena,
        'cEscuela'   : this.fillEditarUsuarios.cEscuela,
        'oFotografia': nIdFile
      }).then(response => {
        this.getRefrescarUsuarioAutenticado();
        this.fullscreenLoading = false;
        this.getUsuarioById();
        Swal.fire({
        icon: 'success',
        title: 'Editado Correctamente',
        showConfirmButton: false,
        timer: 1500
      })
      })
    },
    getRefrescarUsuarioAutenticado(){
      var url = '/authenticate/getRefrescarUsuarioAutenticado'
      axios.get(url).then(response => {
        console.log(response.data);
        EventBus.$emit('verifyAuthenticatedUser', response.data);
        this. fullscreenLoading = false;
        this.getUsuarioById();
        Swal.fire({
        icon: 'success',
        title: 'Se actualizo correctamente',
        showConfirmButton: false,
        timer: 1500
      })
      }) 
    },
    validarRegistrarUsuario(){
      this.error = 0;
      this.mensajeError = [];

        if(!this.fillEditarUsuarios.cNombre){
          this.mensajeError.push("el nombre es un campo obligatorio")
        }
        if(!this.fillEditarUsuarios.cApellido){
          this.mensajeError.push("el apellido es un campo obligatorio")
        }
        if(!this.fillEditarUsuarios.cCorreo){
          this.mensajeError.push("el correo es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    
  }
}
</script>

<style>
  .position-reverse{
    flex-direction: row-reverse !important;
  }
  .img-mac-height{
    max-height: 100px !important;
  }
</style>