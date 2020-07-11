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
            <router-link class="btn btn-info bnt-sm" :to="'/'">
              <i class="fas fa-plus-square"></i> Nuevo Usuario
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
                            <input type="text" class="form-control" v-model="fillBsqUsuarios.cNombre">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Apellidos</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqUsuarios.cApellido">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="fillBsqUsuarios.cCorreo">
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
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getlistarUsuarios">Buscar</button>
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
                <table class = "table table-hover table-head-fixed text-nowrap projects">
                  <thead>
                    <tr>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Escuela</th>
                      <th>Correo</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>jose matias</td>
                      <td>manriquez</td>
                      <td>Ing. civil informatica</td>
                      <td>manriquez@gmail.com</td>
                      <td>
                        <span class="badge badge.succes">Activo</span>
                      </td>
                      <td>
                        <router-link class="btn btn-primary btn-sm" :to="'/'">
                          <i class="fas fa-folder"></i> Ver
                        </router-link>
                        <router-link class="btn btn-info btn-sm" :to="'/'">
                          <i class="fas fa-pencil-alt"></i> Editar
                        </router-link>
                        <router-link class="btn btn-success btn-sm" :to="'/'">
                          <i class="fas fa-key"></i> Permisos
                        </router-link>
                        <router-link class="btn btn-danger btn-sm" :to="'/'">
                          <i class="fas fa-trash"></i> Desactivar
                        </router-link>
                        <router-link class="btn btn-primary btn-sm" :to="'/'">
                          <i class="fas fa-chekck"></i> Activar
                        </router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item">
                      <a href="#" class="page-link">Ant</a>
                    </li>
                    <li class="page-item active">
                      <a href="#" class=page-link>1</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link">Post</a>
                    </li>
                  </ul>
                </div>
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
        cEstado: ''
      },
      listUsuarios:[],
      listEstados: [
        {value: 'A', label: 'Activo'},
        {value: 'I', label: 'Inactivo'}
      ]
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
    getlistarUsuarios(){
      var url = '/administracion/usuario/getlistarUsuarios'
      axios.get(url, {
        params: {
          'cNombre' : this.fillBsqUsuarios.cNombre,
          'cApellido' : this.fillBsqUsuarios.cApellido,
          'cCorreo' : this.fillBsqUsuarios.cCorreo,
          'cEstado' : this.fillBsqUsuarios.cEstado,

        }
      }).then(response => {
          console.log(response.data);
      })
    }
  }

}
</script>

<style>

</style>