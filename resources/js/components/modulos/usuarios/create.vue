<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Usuario</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/usuarios'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registrar Usuario</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombres</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillCrearUsuarios.cNombre" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Apellidos</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillCrearUsuarios.cApellido" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillCrearUsuarios.cCorreo" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Contraseña</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillCrearUsuarios.cContrasena" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                              <label class="col-md-3 col-form-label">Asignar Escuela</label>
                              <div class="col-md-9">
                                  <el-select v-model="fillCrearUsuarios.cEscuela" 
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
                        <label class="col-md-3 col-form-label">Rol</label>
                        <div class="col-md-9">
                            <el-select v-model="fillCrearUsuarios.nIdRol" 
                            placeholder="Asignar un Rol"
                            clearable>
                              <el-option
                                v-for="item in listRoles"
                                :key="item.id"
                                :label="item.name"
                                :value="item.id">
                              </el-option>
                            </el-select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Fotografia</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control" @change="getFile">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarUsuario" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillCrearUsuarios:{
        cNombre: '',
        cApellido: '',
        cCorreo: '',
        cContrasena: '',
        cEscuela: '',
        oFotografia: '',
        nIdRol: ''
      },
      listRoles: [],
      listEscuelas:[],
      form : new FormData,
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
    this.getListarRoles();
    this.getListarEscuelas();
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
      getListarRoles(){
      this.fullscreenLoading = true;
      var url = '/administracion/roles/getListarRoles'
      axios.get(url, {

      }).then(response => {
          //this.inicializarPaginacion();
          this.listRoles = response.data;
          this.fullscreenLoading = false;
      })
    },
    getFile(e){
      this.fillCrearUsuarios.oFotografia = e.target.files[0];
    },
    limpiarCriterios(){
      this.fillCrearUsuarios.cNombre = '';
      this.fillCrearUsuarios.cApellido = '';
      this.fillCrearUsuarios.cCorreo = '';
      this.fillCrearUsuarios.cContrasena = '';
      this.fillCrearUsuarios.cEscuela = '';
      this.fillCrearUsuarios.oFotografia = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    setRegistrarUsuario(){
      if (this.validarRegistrarUsuario()){
          this.modalShow = true;
          return;
      }
      if(!this.fillCrearUsuarios.oFotografia || this.fillCrearUsuarios.oFotografia == undefined){
        this.fullscreenLoading = true;
        this.setGuardarUsuario();
      } else {
        this.setRegistrarArchivo();
      }
    },
    setRegistrarArchivo(){
      this.form.append('file', this.fillCrearUsuarios.oFotografia)
      const config = { headers: {'Content-Type': 'multipart/form-data'}}
      var url = '/archivo/setRegistrarArchivo'
      axios.post(url, this.form, config).then(response =>{
        console.log(response)
        var nIdFile = response.data[0].nIdFile;
        this.setGuardarUsuario(nIdFile);
      }) 
    },
    validarRegistrarUsuario(){
      this.error = 0;
      this.mensajeError = [];

        if(!this.fillCrearUsuarios.cNombre){
          this.mensajeError.push("el nombre es un campo obligatorio")
        }
        if(!this.fillCrearUsuarios.cApellido){
          this.mensajeError.push("el apellido es un campo obligatorio")
        }
        if(!this.fillCrearUsuarios.cCorreo){
          this.mensajeError.push("el correo es un campo obligatorio")
        }
        if(!this.fillCrearUsuarios.cContrasena){
          this.mensajeError.push("la contraseña es un campo obligatorio")
        }
        if(!this.fillCrearUsuarios.cEscuela){
          this.mensajeError.push("la escuela es un campo obligatorio")
        }
        if(!this.fillCrearUsuarios.nIdRol){
          this.mensajeError.push("el Rol es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setGuardarUsuario(nIdFile){
      var url = '/administracion/usuario/setRegistrarUsuario'
      axios.post(url, {
        'cNombre'    : this.fillCrearUsuarios.cNombre,
        'cApellido'  : this.fillCrearUsuarios.cApellido,
        'cCorreo'    : this.fillCrearUsuarios.cCorreo,
        'cContrasena': this.fillCrearUsuarios.cContrasena,
        'cEscuela'   : this.fillCrearUsuarios.cEscuela,
        'oFotografia': nIdFile
      }).then(response => {
        this.setEditarRolByUsuario(response.data);
      })
    },
    setEditarRolByUsuario(nIdUsuario){
        this.fullscreenLoading = false;
        //this.$router.push('/usuarios');

        var url = '/administracion/usuario/setEditarRolByUsuario'
        axios.post(url, {
        'nIdUsuario'    : nIdUsuario,
        'nIdRol'  : this.fillCrearUsuarios.nIdRol,
      }).then(response => {
        //console.log("Registro Usuario exitosamente");
        this.fullscreenLoading = false;
        this.$router.push('/usuarios');
      })
    }
  
  }// cierre methods
}
</script>

<style>

</style>