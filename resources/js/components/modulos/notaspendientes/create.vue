
<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Solicitud de Nota pendiente</h1>
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
                            <h3 class="card-title">Formulario Registro de Nota pendiente</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                              <div class="col-md-12">
                                                <template>
                                                    <label class="col-md-3 col-form-label">Fecha Propuesta</label>
                                                        <el-date-picker
                                                            v-model="fillCrearNotaP.fecha_propuesta"
                                                            type="date"
                                                            size="large"
                                                            value-format="yyyy-MM-dd"
                                                            placeholder="Selecionar fecha de nota pendiente">
                                                        </el-date-picker>
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
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarNotaP" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillCrearNotaP:{
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
      this.alertaNotaP();
  },
  methods:{
    limpiarCriterios(){
      this.fillCrearNotaP.cNombre = '';
      this.fillCrearNotaP.cSlug = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    validarRegistrarEscuela(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillCrearNotaP.fecha_propuesta){
          this.mensajeError.push("La fecha es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setRegistrarNotaP(){
      if(this.validarRegistrarEscuela()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/notaspendientes/setRegistrarNotaP'
      axios.post(url, {
        'fecha_propuesta'            : this.fillCrearNotaP.fecha_propuesta
      }).then(response => {
        this.fullscreenLoading = false;
        var IdNotaP = response.data.id;
        this.setAsignarNotaP(IdNotaP);
        //this.$router.push('/notaspendientes');
      })
    },
    setAsignarNotaP(IdNotaP){
      var url = '/notaspendientes/setAsignarNotaP'
      axios.post(url, {
        'id_notapendiente': IdNotaP
      })
    },
    alertaNotaP(){
      Swal.fire({
        icon: 'warning',
        title: 'Importante!',
        text: 'Tengase presente que este formulario solo es para dejar constancia a nivel de facultad, por lo que aun es necesario realizar la solicitud a traves del portal del alumno.',
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