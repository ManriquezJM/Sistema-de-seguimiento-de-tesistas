<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Bitacora</h1>
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
                            <h3 class="card-title">Formulario Editar Bitacora</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Comentario</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="80" class="form-control" v-model="fillEditarBitacora.Comentario" @keyup.enter="setEditarBitacora">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Acuerdo</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="80" class="form-control" v-model="fillEditarBitacora.Acuerdo" @keyup.enter="setEditarBitacora">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarBitacora" v-loading.fullscreen.lock="fullscreenLoading"
                                    >Editar</button>
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
      fillEditarBitacora:{
        nIdBitacora: this.$attrs.id,
        Comentario: '',
        Acuerdo: ''
      },
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
      this.getListarBitacorasByAlumno();
  },
  methods:{
    limpiarCriterios(){
      this.fillEditarBitacora.Comentario = '';
      this.fillEditarBitacora.Acuerdo = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarEditarBitacora(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillEditarBitacora.Comentario){
          this.mensajeError.push("El comentario es un campo obligatorio")
        }
        if(!this.fillEditarBitacora.Acuerdo){
          this.mensajeError.push("El acuerdo es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    getListarBitacorasByAlumno(){
      this.fullscreenLoading = true;
      var url = '/bitacoras/getListarBitacorasByAlumno'
      axios.get(url, {
        params: {
          'nIdBitacora' : this.fillEditarBitacora.nIdBitacora,
        }
      }).then(response => {
          //this.inicializarPaginacion();
          this.fillEditarBitacora.Comentario = response.data[0].comentario;
          this.fillEditarBitacora.Acuerdo = response.data[0].acuerdo;
          this.fullscreenLoading = false;
      })
    },
    setEditarBitacora(){
      if(this.validarEditarBitacora()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/bitacoras/setEditarBitacora'
      axios.post(url, {
        'nIdBitacora'        :this.fillEditarBitacora.nIdBitacora,
        'comentario'         :this.fillEditarBitacora.Comentario,
        'acuerdo'            :this.fillEditarBitacora.Acuerdo
      }).then(response => {
        this.fullscreenLoading = false;
        Swal.fire({
        icon: 'success',
        title: 'Bitacora Editada Correctamente',
        showConfirmButton: false,
        timer: 1500
      })
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