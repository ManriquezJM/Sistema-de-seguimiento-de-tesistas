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

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <template v-if="listRolPermisosByUsuario.includes('usuarios.crear')">
               <router-link class="btn btn-info bnt-sm" :to="{name: 'usuarios.crear'}">
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
                        <label class="col-md-3 col-form-label">Nombres</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqUsuarios.cNombre" @keyup.enter="getListarUsuarios">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Apellidos</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqUsuarios.cApellido" @keyup.enter="getListarUsuarios">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqUsuarios.cCorreo" @keyup.enter="getListarUsuarios">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Estado</label>
                        <div class="col-md-9">
                            <el-select v-model="fillBsqUsuarios.cEstado" 
                            placeholder="Seleccione un estado"
                            clearable>
                              <el-option
                                v-for="item in listEstados"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
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
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListarUsuarios" v-loading.fullscreen.lock="fullscreenLoading"
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
                <template v-if="listarUsuariosPaginated.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects">
                    <thead>
                      <tr>
                        <th>Foto</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listarUsuariosPaginated" :key="index">
                        <td>
                          <template v-if="!item.profile_image">
                            <li class="user-block">
                              <img src="/img/avatar.png" :alt="item.username" class="profile-avatar-img img-fluid img-circle">
                            </li>
                          </template>
                          <template v-else>
                            <li class="user-block">
                              <img :src="item.profile_image" :alt="item.username" class="profile-avatar-img img-fluid img-circle">
                            </li>
                          </template>
                        </td>
                        <td v-text="item.nombres"></td>
                        <td v-text="item.apellidos"></td>
                        <td v-text="item.email"></td>
                        <td>
                          <template v-if="item.state == 'A'">
                            <span class="badge badge-success" v-text="item.state_alias"></span>
                          </template>
                          <template v-else>
                            <span class="badge badge-danger" v-text="item.state_alias"></span>
                          </template>
                        </td>
                        <td>
                          <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'usuarios.ver', params:{id_user: item.id_user}}">
                            <i class="fas fa-folder"></i> Ver
                          </router-link>
                          <template v-if="item.state == 'A'">
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'usuarios.editar', params:{id_user: item.id_user}}">
                              <i class="fas fa-pencil-alt"></i> Editar
                            </router-link>
                            <router-link class="btn btn-flat btn-success btn-sm" :to="{name:'usuarios.permisos', params:{id_user: item.id_user}}">
                              <i class="fas fa-key"></i> Permisos
                            </router-link>
                            <button class="btn btn-flat btn-danger btn-sm" @click.prevent="setCambiarEstadoUsuario(1, item.id_user)">
                              <i class="fas fa-trash"></i>Desactivar
                            </button>

                          </template>
                          <template v-else>
                            <button class="btn btn-flat btn-success btn-sm" @click.prevent="setCambiarEstadoUsuario(2, item.id_user)">
                              <i class="fas fa-trash"></i>Activar
                            </button>
                          </template>
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
      fillBsqUsuarios:{
        cNombre: '',
        cApellido: '',
        cCorreo: '',
        cEstado: '',
        cEscuela: '',
      },
      fullscreenLoading: false,
      listUsuarios:[],
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
      let a = this.listUsuarios.length,
          b = this.perPage;
      return Math.ceil(a / b);
    },
    listarUsuariosPaginated(){
      //
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listUsuarios.slice(inicio, fin);
    },
    pagesList(){
      let a = this.listUsuarios.length,
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
      this.fillBsqUsuarios.cNombre = '';
      this.fillBsqUsuarios.cApellido = '';
      this.fillBsqUsuarios.cCorreo = '';
      this.fillBsqUsuarios.cEstado = '';
    },
    limpiarBandejaUsuarios(){
      this.listUsuarios = [];
    },
    getListarUsuarios(){
      this.fullscreenLoading = true;
      var url = '/administracion/usuario/getListarUsuarios'
      axios.get(url, {
        params: {
          'cNombre' : this.fillBsqUsuarios.cNombre,
          'cApellido' : this.fillBsqUsuarios.cApellido,
          'cCorreo' : this.fillBsqUsuarios.cCorreo,
          'cEstado' : this.fillBsqUsuarios.cEstado,
          'cEscuela' : this.fillBsqUsuarios.cEscuela,
        }
      }).then(response => {
          this.inicializarPaginacion();
          this.listUsuarios = response.data;
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
        var url = '/administracion/usuario/setCambiarEstadoUsuario'
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
            this.getListarUsuarios();
        })
      }
    })
    }

  }//cierre de methods
}
</script>

<style>

</style>