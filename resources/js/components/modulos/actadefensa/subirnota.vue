
<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ingresar Nota Final de Tesis</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/actadefensa'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Registro de Nota tesista</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nota Final Tesis</label>
                                                <div class="col-md-9">
                                                    <template>
                                                        <el-input-number v-model="fillSubirNota.Nota" size="large" :min="1" :precision="2" :step="0.1" :max="7"></el-input-number>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarNota" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillSubirNota:{
        IdTesis: this.$attrs.id,
        Nota: '',
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
      this.alertaNota();
  },
  methods:{
    limpiarCriterios(){
      this.fillSubirNota.Nota = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarRegistrarNota(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillSubirNota.Nota){
          this.mensajeError.push("La nota es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setRegistrarNota(){
      if(this.validarRegistrarNota()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/secretaria/setRegistrarNota'
      axios.post(url, {
        'id_tesis'        : this.fillSubirNota.IdTesis,  
        'nota'            : this.fillSubirNota.Nota
      }).then(response => {
        this.fullscreenLoading = false;
        this.$router.push('/actadefensa');
      })
    },
    alertaNota(){
      Swal.fire({
        icon: 'warning',
        title: 'Importante!',
        text: 'De acuerdo a la nota ingresada el sistema cambiara automaticamente el estado de la tesis a "aprobada" o "reprobada" segun corresponda',
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