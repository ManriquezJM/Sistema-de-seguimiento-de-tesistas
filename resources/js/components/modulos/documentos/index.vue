<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ingresar nota y Acta de defensa </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <template v-if="listRolPermisosByUsuario.includes('actadefensa.crear')">
               <router-link class="btn btn-info bnt-sm" :to="{name: 'actadefensa.crear'}">
                  <i class="fas fa-plus-square"></i> Nuevo Usuario
              </router-link>
            </template>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de busqueda</h3>
              </div>
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombres o apellido</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqAlumno.cNombre" @keyup.enter="getListarAlumnos">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Rut</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqAlumno.nRut" @keyup.enter="getListarAlumnos">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Escuelas</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqAlumno.nIdEscuela"
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
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarAlumnos" v-loading.fullscreen.lock="fullscreenLoading"
                      >Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de resultados</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listarAlumnosPaginated.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Rut</th>
                        <th>Estado Tesis</th>
                        <th>Descargar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarAlumnosPaginated" :key="index">
                        <td v-text="item.full_name"></td>
                        <td v-text="item.rut_int1"></td>
                        <td>
                          <template v-if="item.estado_tesis == 'D'">
                            <span class="badge badge-warning" >En desarrollo</span>
                          </template>
                          <template v-else-if="item.estado_tesis == 'A'">
                            <span class="badge badge-success" >Aprobada</span>
                          </template>
                          <template v-else>
                            <span class="badge badge-danger" >Reprobada</span>
                          </template>
                        </td>
                        <td >
                          <button class="btn btn-flat btn-primary btn-sm" @click.prevent="setGenerarDocumento(item.id_tesis)">
                              <i class="fas fa-file-download"></i> Fit
                            </button>
                            <button class="btn btn-flat btn-success btn-sm" @click.prevent="setGenerarMemoRevision(item.id_tesis)">
                              <i class="fas fa-file-download"></i> Memo Revision
                            </button>
                          <a class="btn btn-flat btn-warning btn-sm" :href="item.path"><i class="fas fa-file-download"> </i> Acta Defensa </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item" v-if="pageNumber > 0">
                        <a href="#" class="page-link" @click.prevent="prevPage">Ant</a>
                      </li>
                      <li class="page-item" v-for="(page, index) in pagesList" :key="index"
                        :class="[page == pageNumber ? 'active' : '']">
                        <a href="#" class=page-link @click.prevent="selectPage(page)"> {{page+1}}</a>
                      </li>
                      <li class="page-item" v-if="pageNumber < pageCount -1">
                        <a href="#" class="page-link" @click.prevent="nextPage">Post</a>
                      </li>
                    </ul>
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

</template>

<script>
export default {
  data(){
    return{
      fillBsqAlumno:{
        cNombre: '',
        nRut: '',
        nIdEscuela:''
      },
      fullscreenLoading: false,
      listEscuelas:[],
      listAlumnos:[],
      listEstados: [
        {value: 'A', label: 'Activo'},
        {value: 'I', label: 'Inactivo'}
      ],
      listRolPermisosByUsuario: JSON.parse(localStorage.getItem('listRolPermisosByUsuario')),
      pageNumber: 0,
      perPage: 5
    }
  },
  computed: {
    pageCount(){
      //obtener el numero de paginas 
      let a = this.listAlumnos.length,
          b = this.perPage;
      return Math.ceil(a / b);
    },
    listarAlumnosPaginated(){
      //
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listAlumnos.slice(inicio, fin);
    },
    pagesList(){
      let a = this.listAlumnos.length,
          b = this.perPage;
      let pageCount = Math.ceil(a / b);
      let count = 0,
        pagesArray = [];
      while (count < pageCount){
        pagesArray.push(count);
        count++;
      }
      return pagesArray;
    }
  },
   mounted(){
      this.getListarEscuelas();
    },
  methods:{
    getListarEscuelas(){
        this.fullscreenLoading = true;
        var url = '/administracion/escuelas/getListarEscuelas'
        axios.get(url, {
        }).then(response => {
            this.listEscuelas = response.data;
            this.fullscreenLoading = false;
        })
      },
    setGenerarDocumento(id_tesis){
      //this.fullscreenLoading = true;

      var config = {
        responseType: 'blob'
      }

      var url = '/administracion/tesis/setGenerarDocumento'
      axios.post(url, {
          'nIdTesis' :id_tesis
      }, config).then(response => {
          console.log(response.data);
          var oMyBlob = new Blob([response.data], {type : 'application/pdf'});
          var url = URL.createObjectURL(oMyBlob);
          //console.log(url)
          window.open(url);
          //this.listTesis = response.data;
          //this.fullscreenLoading = false;
      })
    },
    setGenerarMemoRevision(id_tesis){
      var config = {
        responseType: 'blob'
      }
      var url = '/secretaria/setGenerarMemoRevision'
      axios.post(url, {
          'nIdTesis' :id_tesis
      }, config).then(response => {
          console.log(response.data);
          var oMyBlob = new Blob([response.data], {type : 'application/pdf'});
          var url = URL.createObjectURL(oMyBlob);
          //console.log(url)
          window.open(url);
          //this.listTesis = response.data;
          //this.fullscreenLoading = false;
      })
    },
    limpiarCriteriosBsq(){
      this.fillBsqAlumno.cNombre = '';
      this.fillBsqAlumno.nRut = '';
      this.fillBsqAlumno.nIdEscuela = '';
    },
    limpiarBandejaUsuarios(){
      this.listAlumnos = [];
    },
    getListarAlumnos(){
      this.fullscreenLoading = true;
      var url = '/secretaria/getListarAlumnos'
      axios.get(url, {
        params: {
          'cNombre' : this.fillBsqAlumno.cNombre,
          'nRut' : this.fillBsqAlumno.nRut,
          'nIdEscuela' : this.fillBsqAlumno.nIdEscuela,
        }
      }).then(response => {
          this.inicializarPaginacion();
          this.listAlumnos = response.data;
          this.fullscreenLoading = false;
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
    setCambiarEstadoUsuario(op, id_user){
      Swal.fire({
      title: 'Estas seguro? ' + ((op == 1) ? 'desactivar ' : 'activar ') + ' el usuario',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: ((op == 1) ? 'Si, desactivar ' : 'Si, activar ')
    }).then((result) => {
      if (result.value) {
        this.fullscreenLoading = true;
        var url = '/secretaria/setCambiarEstadoUsuario'
        axios.post(url, {
          'nIdUsuario' : id_user,
          'cEstado'    : (op == 1) ? 'I' : 'A'
        }).then(response => {
            Swal.fire({
            icon: 'success',
            title: 'Se ' + ((op == 1) ? 'desactivo ' : 'activo ') +'el usuario',
            showConfirmButton: false,
            timer: 1500
            })
            this.getListarAlumnos();
        })
      }
    })
    }

  }//cierre de methods
}
</script>

<style>

</style>