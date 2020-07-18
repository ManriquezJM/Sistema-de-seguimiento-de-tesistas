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
                        <label class="col-md-3 col-form-label">Escuela</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillEditarUsuarios.cEscuela" @keyup.enter="setEditarUsuario">
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

            <div class="card card-info">
             
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
      },
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
      /*
      fillBsqEscuelas:{
          cId: '',
          cEscuela: '',
      },
      listEscuelas:[],
      listNEscuelas:[
        {value: this.fillBsqEscuelas.cId, label: this.fillBsqEscuelas.cEscuela}
      ],
      */

    }
  },
  mounted(){
      this.getUsuarioById();
  },
  methods:{
    getUsuarioById(){

        var url = '/administracion/usuario/getListarUsuarios'
        axios.get(url, {
        params: {
          'nIdUsuario' : this.fillEditarUsuarios.nIdUsuario
        }
      }).then(response => {
          console.log(response.data);
          this.fillEditarUsuarios.cNombre = response.data[0].nombres;
          this.fillEditarUsuarios.cApellido = response.data[0].apellidos;
          this.fillEditarUsuarios.cCorreo = response.data[0].email;
          this.fillEditarUsuarios.cContrasena = response.data[0].password;
          this.fillEditarUsuarios.cEscuela = response.data[0].id_escuela;
      })
    },
    limpiarCriterios(){
      this.fillEditarUsuarios.cNombre = '';
      this.fillEditarUsuarios.cApellido = '';
      this.fillEditarUsuarios.cCorreo = '';
      this.fillEditarUsuarios.cContrasena = '';
      this.fillEditarUsuarios.cEscuela = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    setEditarUsuario(){
      if (this.validarRegistrarUsuario()){
          this.modalShow = true;
          return;
      }else{
      this.setGuardarUsuario();
      }
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

    setGuardarUsuario(){
      var url = '/administracion/usuario/setEditarUsuario'
      axios.post(url, {
        'nIdUsuario': this.fillEditarUsuarios.nIdUsuario, 
        'cNombre'   : this.fillEditarUsuarios.cNombre,
        'cApellido' : this.fillEditarUsuarios.cApellido,
        'cCorreo'   : this.fillEditarUsuarios.cCorreo,
        'cContrasena': this.fillEditarUsuarios.cContrasena,
        'cEscuela'  : this.fillEditarUsuarios.cEscuela
      }).then(response => {
        console.log("registro de usuario exitoso");
      })
    },

    /*
    getListarEscuelas(){
      var url = '/administracion/usuario/getListarEscuelas'
      axios.get(url, {
        params: {
          'cId' : this.fillBsqEscuelas.cId,
          'cEscuela' : this.fillBsqEscuelas.cEscuela,
        }
      }).then(response => {
          this.listEscuelas = response.data;
      })
    },*/
  
  }// cierre methods
}
</script>

<style>

</style>