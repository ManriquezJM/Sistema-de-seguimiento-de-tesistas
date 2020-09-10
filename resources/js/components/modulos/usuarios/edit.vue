<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Usuario</h1>
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
                <h3 class="card-title">Formulario Editar Usuario</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombres</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillEditarUsuarios.cNombre" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Apellidos</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillEditarUsuarios.cApellido" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillEditarUsuarios.cCorreo" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Contraseña</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillEditarUsuarios.cContrasena" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                          <div class="form-group row">
                              <label class="col-md-3 col-form-label">Asignar Escuela</label>
                              <div class="col-md-9">
                                  <el-select v-model="fillEditarUsuarios.cEscuela" 
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
                            <el-select v-model="fillEditarUsuarios.nIdRol" 
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
                            <input type="file" class="form-control"  @change="getFile">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>     
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarUsuario">Editar</button>
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
      fillEditarUsuarios:{
        nIdUsuario: this.$attrs.id_user,
        cNombre: '',
        cApellido: '',
        cCorreo: '',
        cContrasena: '',
        cEscuela: '',
        oFotografia: '',
        nIdRol: ''
      },
      listRoles: [],
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
          this.getRolByUsuario();
      })
    },
    getRolByUsuario(){
      var url = '/administracion/usuario/getRolByUsuario'
      axios.get(url, {
        params:{
          'nIdUsuario' : this.fillEditarUsuarios.nIdUsuario
        }
      }).then(response => {
          this.fillEditarUsuarios.nIdRol = (response.data.length == 0) ? '' : response.data[0].nIdRol;
          this.fullscreenLoading = false;
      })
    },
    limpiarCriterios(){
      this.fillEditarUsuarios.cNombre = '';
      this.fillEditarUsuarios.cApellido = '';
      this.fillEditarUsuarios.cCorreo = '';
      this.fillEditarUsuarios.cContrasena = '';
      this.fillEditarUsuarios.cEscuela = '';
      this.fillEditarUsuarios.oFotografia = '';
    },
    getUsuarioById(){
        var url = '/administracion/usuario/getListarUsuarios'
        axios.get(url, {
        params: {
          'nIdUsuario' : this.fillEditarUsuarios.nIdUsuario
        }
      }).then(response => {
          console.log(response.data);
          this.fillEditarUsuarios.cNombre     = response.data[0].nombres;
          this.fillEditarUsuarios.cApellido   = response.data[0].apellidos;
          this.fillEditarUsuarios.cCorreo     = response.data[0].email;
          this.fillEditarUsuarios.cContrasena = response.data[0].password;
          this.fillEditarUsuarios.cEscuela    = response.data[0].id_escuela;
      })
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    getFile(e){
      this.fillEditarUsuarios.oFotografia = e.target.files[0];
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
        this.setEditarRolByUsuario();
      })
    },
    setEditarRolByUsuario(){
        this.fullscreenLoading = false;
        //this.$router.push('/usuarios');
        var url = '/administracion/usuario/setEditarRolByUsuario'
        axios.post(url, {
        'nIdUsuario'    : this.fillEditarUsuarios.nIdUsuario,
        'nIdRol'        : this.fillEditarUsuarios.nIdRol
        }).then(response => {
          this.fullscreenLoading = false;
          Swal.fire({
          icon: 'success',
          title: 'Editado Correctamente',
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
        if(!this.fillEditarUsuarios.nIdRol){
          this.mensajeError.push("el Rol es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    
    
  
  }// cierre methods
}
</script>

<style>

</style>