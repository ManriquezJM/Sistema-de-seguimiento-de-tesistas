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
                  <img class="profile-user-img img-fluid img-circle" src="/img/user4-128x128.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Nina Mcintire</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

              <div class="col-md-8">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">

                      <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
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
                            <div class="offset-sm-2 col-sm-10">
                              <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarUsuario">Editar</button>
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
        oFotografia: ''
      },
      fillVerUsuarios:{
        nIdUsuario: this.$attrs.id_user,
        cNombre: '',
        cApellido: '',
        cCorreo: '',
        cContrasena: '',
        cEscuela: '',
        oFotografia: ''
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
  },
  methods:{
    getFile(e){
      this.fillEditarUsuarios.oFotografia = e.target.files[0];
    },
    getDataUsuario(){

    },
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
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
  }
}
</script>

<style>

</style>