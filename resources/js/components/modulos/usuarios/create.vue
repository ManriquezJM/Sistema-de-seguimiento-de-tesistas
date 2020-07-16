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
                        <label class="col-md-3 col-form-label">Escuela</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillCrearUsuarios.cEscuela" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>
                    
                   

                  </div>
                </form>
              
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarUsuario">Registrar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
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
      fillCrearUsuarios:{
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
  computed: {
    
  },
  
  methods:{
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    setRegistrarUsuario(){
      //if (this.validarRegistrarUsuario()){
      //  this.modalShow = true;
      //  return;
      this.setGuardarUsuario();
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
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },

    setGuardarUsuario(){
      var url = '/administracion/usuario/setRegistrarUsuario'
      axios.post(url, {
        'cNombre'   : this.fillCrearUsuarios.cNombre,
        'cApellido' : this.fillCrearUsuarios.cApellido,
        'cCorreo'   : this.fillCrearUsuarios.cCorreo,
        'cContrasena': this.fillCrearUsuarios.cContrasena,
        'cEscuela'  : this.fillCrearUsuarios.cEscuela
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