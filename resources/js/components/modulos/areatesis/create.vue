<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Area de Tesis</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/areatesis'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Registrar Area de tesis</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nombre</label>
                                                <div class="col-md-9">
                                                    <input type="text" maxlength="40"  class="form-control" v-model="fillCrearAreaTesis.cNombre" @keyup.enter="setRegistrarAreaTesis">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-group row">
                                          <label class="col-md-3 col-form-label">Escuela</label>
                                          <div class="col-md-9">
                                              <el-select v-model="fillCrearAreaTesis.nIdEscuela" 
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
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4 offset-4">
                                        <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarAreaTesis" v-loading.fullscreen.lock="fullscreenLoading"
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
      fillCrearAreaTesis:{
        cNombre: '',
        nIdEscuela: '',
      },
      listEscuelas:[],
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
    this.getListarEscuelas();
  },

  methods:{
    limpiarCriterios(){
      this.fillCrearAreaTesis.cNombre = '';
      this.fillCrearAreaTesis.nIdEscuela = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    getListarEscuelas(){
      this.fullscreenLoading = true;
      var url = '/administracion/escuelas/getListarEscuelas'
      axios.get(url, {

      }).then(response => {
          this.listEscuelas = response.data;
          this.fullscreenLoading = false;
      })
    },
    validarRegistrarAreaTesis(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillCrearAreaTesis.cNombre){
          this.mensajeError.push("El nombre es un campo obligatorio")
        }
        if(!this.fillCrearAreaTesis.nIdEscuela){
          this.mensajeError.push("La escuela es un campo obligatorio")
        }
        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setRegistrarAreaTesis(){
      if(this.validarRegistrarAreaTesis()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/administracion/areatesis/setRegistrarAreaTesis'
      axios.post(url, {
        'cNombre'            : this.fillCrearAreaTesis.cNombre,
        'nIdEscuela'              : this.fillCrearAreaTesis.nIdEscuela
      }).then(response => {
        this.fullscreenLoading = false;
        this.$router.push('/areatesis');
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