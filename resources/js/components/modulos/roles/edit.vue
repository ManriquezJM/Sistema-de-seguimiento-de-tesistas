<template>
  <div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Rol</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/roles'">
              <i class="fas fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulario Registrar Rol</h3>
                        </div>
                            <div class="card-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Nombres</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillEditarRol.cNombre" @keyup.enter="setEditarRolPermisos">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Url amigable</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" v-model="fillEditarRol.cSlug" @keyup.enter="setEditarRolPermisos">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarRolPermisos" v-loading.fullscreen.lock="fullscreenLoading"
                                    >Editar</button>
                                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriterios">Limpiar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Listar Permisos</h3>
                            </div>
                            <div class="card-body table-resposive">
                                  <template v-if="listPermisosFilter.length">
                                    <div class="scrollTable">
                                      <table class ="table table-hover table-head-fixed text-nowrap projects">
                                        <thead>
                                          <tr>
                                            <th>Accion</th>
                                            <th>Nombre</th>
                                            <th>Url Amigable</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr v-for="(item, index) in listPermisosFilter" :key="index" @click.prevent="marcarFila(index)">

                                            <td>
                                              <!-- cheeekboh-->
                                              <el-checkbox v-model="item.checked">Opción</el-checkbox>
                                            </td>
                                            <td v-text="item.name"></td>
                                            <td v-text="item.slug"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </template>
                                  <template v-else>
                                    <div class="callout callout-info">
                                      <h5> No se han encontrado resultados...</h5>
                                    </div>
                                  </template>
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
      fillEditarRol:{
        nIdRol: this.$attrs.id,
        cNombre: '',
        cSlug: '',
      },
      listPermisos: [],
      listPermisosFilter:[],
      listRolPermisosByUsuario: [],
      listRolPermisosByUsuarioFilter: [],
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
      this.getListarRoles();
      this.getListarPermisosByRol();
  },
  methods:{
    limpiarCriterios(){
      this.fillEditarRol.cNombre = '';
      this.fillEditarRol.cSlug = '';
    },
    abrirModal(){
      this.modalShow = !this.modalShow;
    },
    getListarRoles(){
      this.fullscreenLoading = true;
      var url = '/administracion/roles/getListarRoles'
      axios.get(url, {
        params: {
          'nIdRol' : this.fillEditarRol.nIdRol
        }
      }).then(response => {
          this.fillEditarRol.cNombre = response.data[0].name;
          this.fillEditarRol.cSlug   = response.data[0].slug;
          this.fullscreenLoading = false;
      })
    },
    getListarPermisosByRol(){
        var ruta = '/administracion/roles/getListarPermisosByRol'
        axios.get(ruta, {
            params: {
                'nIdRol' : this.fillEditarRol.nIdRol
            }
        }).then( response => {
            this.listPermisos = response.data;
            this.filterPermisosByRol();
        })
    },
    validarEditarRolPermiso(){
      this.error = 0;
      this.mensajeError = [];
        if(!this.fillEditarRol.cNombre){
          this.mensajeError.push("El nombre es un campo obligatorio")
        }
        if(!this.fillEditarRol.cSlug){
          this.mensajeError.push("La Url amigable es un campo obligatorio")
        }

        let contador = 0;
        this.listPermisosFilter.map(function(x,y){
          if(x.checked == true){
            contador++;
          }
        })
        if(contador == 0){
          this.mensajeError.push("Debe seleccionar almenos un permiso");
        }

        if(this.mensajeError.length){
          this.error = 1;
        }
        return this.error;
    },
    setEditarRolPermisos(){
      if(this.validarEditarRolPermiso()){
        this.modalShow = true;
        return;
      }
      this.fullscreenLoading = true;
      var url = '/administracion/roles/setEditarRolPermisos'
      axios.post(url, {
        'nIdRol'             : this.fillEditarRol.nIdRol,
        'cNombre'            : this.fillEditarRol.cNombre,
        'cSlug'              : this.fillEditarRol.cSlug,
        'listPermisosFilter' : this.listPermisosFilter
      }).then(response => {
        this.getListarRolPermisosByUsuario();
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
    filterPermisosByRol(){
      let me = this;
      me.listPermisos.map(function(x,y){
        me.listPermisosFilter.push({
          'id'     : x.id,
          'name'   : x.name,
          'slug'   : x.slug,
          'checked': (x.checked == 1) ? true : false
        })
      })
    },
    marcarFila(index){
      this.listPermisosFilter[index].checked = !this.listPermisosFilter[index].checked;
    },
    getListarRolPermisosByUsuario(){
      var ruta = '/administracion/usuario/getListarRolPermisosByUsuario'
      axios.get(ruta).then( response => {
          this.listRolPermisosByUsuario = response.data;
          this.filterListarRolPermisosByUsuario();
      })
    },
    filterListarRolPermisosByUsuario(){
      let me = this;
      me.listRolPermisosByUsuarioFilter = [];
      me.listRolPermisosByUsuario.map(function(x,y){
          me.listRolPermisosByUsuarioFilter.push(x.slug)
      })
      localStorage.setItem('listRolPermisosByUsuario', JSON.stringify(me.listRolPermisosByUsuarioFilter));
      EventBus.$emit('notifyRolPermisosByUsuario', me.listRolPermisosByUsuarioFilter);
      this.fullscreenLoading = false;
        Swal.fire({
        icon: 'success',
        title: 'Rol Editado Correctamente',
        showConfirmButton: false,
        timer: 1500
      })
    },
  
  }// cierre methods
}
</script>

<style>

</style>