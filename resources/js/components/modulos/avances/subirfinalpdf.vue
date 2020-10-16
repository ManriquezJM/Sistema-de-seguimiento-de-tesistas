<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Subir PDF final de tesis</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/avances'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">PDF final de tesis</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Archivo PDF</label>
                        <div class="col-md-9">
                            <input type="file" accept="application/pdf"  class="form-control" @change="getFile">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarFinalPdf" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillCrearFinalPdf:{
        cDescripcion: '',
        oArchivo: '',
        
      },
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

  },
  
  methods:{
    getFile(e){
      this.fillCrearFinalPdf.oArchivo = e.target.files[0];
    },
    limpiarCriterios(){
      this.fillCrearFinalPdf.oArchivo = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    setRegistrarFinalPdf(){
      if (this.validarRegistrarFinalPdf()){
          this.modalShow = true;
          return;
      }
      if(!this.fillCrearFinalPdf.oArchivo || this.fillCrearFinalPdf.oArchivo == undefined){
        this.fullscreenLoading = true;
        this.setGuardarAvance();
      } else {
        this.setRegistrarArchivoPDF();
      }
    },
    setRegistrarArchivoPDF(){
      this.form.append('file', this.fillCrearFinalPdf.oArchivo)
      const config = { headers: {'Content-Type': 'multipart/form-data'}}
      var url = '/archivo/setRegistrarArchivoPDF'
      axios.post(url, this.form, config).then(response =>{
        console.log(response)
        var nIdFile = response.data.id;
        this.setGuardarAvance(nIdFile);
      }) 
    },
    validarRegistrarFinalPdf(){
      this.error = 0;
      this.mensajeError = [];

        
        if(!this.fillCrearFinalPdf.oArchivo){
          this.mensajeError.push("el archivo es un campo obligatorio")
        }
      
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setGuardarAvance(nIdFile){
      var url = '/avances/setRegistrarFinalPdf'
      axios.post(url, {
        'id_archivo'      : nIdFile
      }).then(response => {
        this.fullscreenLoading = false;
        this.$router.push('/avances');
      })
      
    }
  }// cierre methods
}
</script>

<style>

</style>
