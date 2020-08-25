<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Nota Pendiente</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/notaspendientes'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Editar Nota Pendiente</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="form-group row">
                                              <div class="col-md-12">
                                                <template>
                                                    <label class="col-md-3 col-form-label">Fecha Propuesta</label>
                                                        <el-date-picker
                                                            v-model="fillEditarNotaP.fecha_propuesta"
                                                            type="date"
                                                            size="large"
                                                            value-format="yyyy-MM-dd"
                                                            placeholder="Selecionar fecha de nota pendiente">
        
                                                        </el-date-picker>
                                                </template>
                                                </div>
                                            </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarNotaP" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillEditarNotaP:{
        nIdNotaP: this.$attrs.id,
        fecha_propuesta: ''
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
      this.getListarNotasPendientes();
  },
  methods:{
    limpiarCriterios(){
      this.fillEditarNotaP.fecha_propuesta = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarEditarNotaP(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillEditarNotaP.fecha_propuesta){
          this.mensajeError.push("La fecha es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setEditarNotaP(){
      if(this.validarEditarNotaP()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/notaspendientes/setEditarNotaP'
      axios.post(url, {
        'nIdNotaP'                  :this.fillEditarNotaP.nIdNotaP,
        'fecha_propuesta'           : this.fillEditarNotaP.fecha_propuesta

      }).then(response => {
        this.fullscreenLoading = false;
        Swal.fire({
        icon: 'success',
        title: 'Nota Pendiente Editado Correctamente',
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
    getListarNotasPendientes(){
      this.fullscreenLoading = true;
      var url = '/notaspendientes/getListarNotasPendientes'
      axios.get(url, {
        params: {
          'nIdNotaP' : this.fillEditarNotaP.nIdNotaP,
        }
      }).then(response => {
          //this.inicializarPaginacion();
          this.fillEditarNotaP.fecha_propuesta = response.data[0].fecha_propuesta;
          this.fullscreenLoading = false;
      })
    },

  }// cierre methods
}
</script>

<style>

</style>