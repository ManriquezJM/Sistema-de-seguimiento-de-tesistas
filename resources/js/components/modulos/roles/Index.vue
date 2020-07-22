<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Roles</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info bnt-sm" :to="'/roles/crear'">
              <i class="fas fa-plus-square"></i> Nuevo Rol
            </router-link>
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
                        <label class="col-md-3 col-form-label">Nombres</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqRol.cNombre" @keyup.enter="getListarRoles">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Url amigable</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqRol.cUrl" @keyup.enter="getListarRoles">
                        </div>
                      </div>
                    </div>

                  </div>
                </form>
              
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarRoles" v-loading.fullscreen.lock="fullscreenLoading"
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
              <div class="card-body table-resposive">
                <template v-if="listarRolesPaginated.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Url amigable </th>
                        <th>Acciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarRolesPaginated" :key="index">
                        <td v-text="item.name"></td>
                        <td v-text="item.slug"></td>
                      
                        <td>
                          <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'usuarios.ver', params:{id_user: item.id_user}}">
                            <i class="fas fa-folder"></i> Ver
                          </router-link>
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'usuarios.editar', params:{id_user: item.id_user}}">
                              <i class="fas fa-pencil-alt"></i> Editar
                            </router-link>   
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
      fillBsqRol:{
        cNombre: '',
        cUrl: ''
      },
      fullscreenLoading: false,
      listRoles:[],
      
      pageNumber: 0,
      perPage: 5
    }
  },
  computed: {
    pageCount(){
      //obtener el numero de paginas 
      let a = this.listRoles.length,
          b = this.perPage;
      return Math.ceil(a / b);
    },
    listarRolesPaginated(){
      //
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listRoles.slice(inicio, fin);
    },
    pagesList(){
      let a = this.listRoles.length,
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
  methods:{
    limpiarCriteriosBsq(){
      this.fillBsqRol.cNombre = '';
      this.fillBsqRol.cUrl = '';
    },
    limpiarBandejaUsuarios(){
      this.listRoles = [];
    },
    getListarRoles(){
      this.fullscreenLoading = true;
      var url = '/administracion/roles/getListarRoles'
      axios.get(url, {
        params: {
          'cNombre' : this.fillBsqRol.cNombre,
          'cUrl' : this.fillBsqRol.cUrl,

        }
      }).then(response => {
          this.inicializarPaginacion();
          this.listRoles = response.data;
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
   

  }//cierre de methods
}
</script>

<style>

</style>