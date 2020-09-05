<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Formulario de Inscripcion de tesis</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <template v-if="listMiTesis.length == 0">
              <router-link class="btn btn-info bnt-sm" :to="'/tesis/crear'">
                <i class="fas fa-plus-square"></i> Ingresar Formulario de inscripcion
              </router-link>
            </template>
            <template v-if="listMiTesis.length > 0">
              <router-link class="btn btn-info bnt-sm link-disabled" :to="''">
              <i class="fas fa-plus-square"></i> Usted ya ingreso un formulario
              </router-link>
            </template>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Bandeja de resultados</h3>
              </div>
              <div class="card-body table table-responsive">
                <template v-if="listTesis.length">
                  
                  <table class ="table table-hover table-head-fixed text-nowrap projects ">
                    <thead>
                      <tr>
                        <th>Alumno</th>
                        <th>Estado FIT</th>
                        <th>Estado Tesis</th>
                        <th>Acciones </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listTesis" :key="index">
                          
                       
                        <td v-text="item.nombre_int1"></td>
                        <td>
                          <template v-if="item.aprobado_pg == 'P'">
                            <span class="badge badge-warning" >Pendiente</span>
                          </template>
                          <template v-else-if="item.aprobado_pg == 'A'">
                            <span class="badge badge-success">Aprobado</span>
                          </template>
                          <template v-else>
                            <span class="badge badge-danger">Rechazado</span>
                          </template>
                        </td>
                        <td>
                          <template v-if="item.estado == 'D'">
                            <span class="badge badge-warning" >En desarrollo</span>
                          </template>
                          <template v-else-if="item.estado == 'A'">
                            <span class="badge badge-success" >Aprobada</span>
                          </template>
                          <template v-else>
                            <span class="badge badge-danger" >Reprobada</span>
                          </template>
                        </td>
                        <td>
                          <router-link class="btn btn-flat btn-primary btn-sm" :to="{name:'tesis.ver', params:{id: item.id}}">
                            <i class="fas fa-folder"></i> Ver
                          </router-link>
                          <template v-if="item.aprobado_pg == 'A'">
                            <button class="btn btn-flat btn-light btn-sm" @click.prevent="setGenerarDocumento(item.id)">
                              <i class="fas fa-pencil-alt"></i> Ver PDF
                            </button>
                          </template>
                          <template v-if="item.aprobado_pg == 'P' || item.aprobado_pg == 'R'">
                            <router-link class="btn btn-flat btn-info btn-sm" :to="{name:'tesis.editar', params:{id: item.id}}">
                              <i class="fas fa-pencil-alt"></i> Editar
                            </router-link>
                            
                            <template  v-if="listRolPermisosByUsuario.includes('tesis.aprobar')">
                                <button class="btn btn-flat btn-success btn-sm" @click.prevent="setCambiarEstadoFIT(1, item.id)">
                                  <i class="fas fa-check"></i>Aprobar
                                </button>
                                <button class="btn btn-flat btn-danger btn-sm" @click.prevent="setCambiarEstadoFIT(2, item.id)">
                                  <i class="fas fa-trash"></i>Rechazar
                                </button>
                            </template>
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
    props: ['usuario'],
  data(){
    return{
      fillBsqTesis:{
        nIdTesis: '',
        cTitulo: '',
        nIdPg: '',
        cNombreI1: '',
        cEstadoPg: '',
        cEstadoD: '',
        cEstadoTesis: ''
      },
      fillVerFIT:{
        cNombre: '',
        cSlug: ''
      },
      listRolPermisosByUsuario: JSON.parse(localStorage.getItem('listRolPermisosByUsuario')),
      listEstadosFIT: [
        {value: 'A', label: 'Aprobado'},
        {value: 'P', label: 'Pendiente'},
        {value: 'R', label: 'Rechazado'}
      ],
      listEstadosTesis: [
        {value: 'A', label: 'Aprobada'},
        {value: 'R', label: 'Reprobada'},
        {value: 'D', label: 'En Desarrollo'}
      ],
      listTesis:[],
      listMiTesis:[],
      fullscreenLoading: false,
      pageNumber: 0,
      perPage: 5,
      modalShow: false,
      modalOption: 0, 
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
    pageCount(){
      //obtener el numero de paginas 
      let a = this.listTesis.length,
          b = this.perPage;
      return Math.ceil(a / b);
    },
    listarTesisPaginated(){
      //
      let inicio = this.pageNumber * this.perPage,
        fin = inicio + this.perPage;
      return this.listTesis.slice(inicio, fin);
    },
    pagesList(){
      let a = this.listTesis.length,
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
    this.getListarTesis();
    this.getListarMiTesis();
  },
  methods:{
    setGenerarDocumento(nIdTesis){
      //this.fullscreenLoading = true;
      var config = {
        responseType: 'blob'
      }
      var url = '/administracion/tesis/setGenerarDocumento'
      axios.post(url, {
          'nIdTesis' :nIdTesis
      }, config).then(response => {
          console.log(response.data);
          var oMyBlob = new Blob([response.data], {type : 'application/pdf'});
          var url = URL.createObjectURL(oMyBlob);
          //console.log(url)
          window.open(url);
      })
    },
    getListarTesis(){
      this.fullscreenLoading = true;
      var url = '/alumno/getListarTesis'
      axios.get(url, {
      }).then(response => {
          this.inicializarPaginacion();
          this.listTesis = response.data;
          this.fullscreenLoading = false;
      })
    },
    getListarMiTesis(){
      this.fullscreenLoading = true;
      var url = '/alumno/getListarMiTesis'
      axios.get(url, {
      }).then(response => {
          this.listMiTesis = response.data;
          this.fullscreenLoading = false;
      })
    },
    limpiarCriteriosBsq(){
      this.fillBsqTesis.cNombre = '';
      this.fillBsqTesis.cSlug = '';
    },
    limpiarBandejaUsuarios(){
      this.listTesis = [];
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
    abrirModal(){
      this.modalShow = !this.modalShow;
      this.limpiarModal();
    },
    limpiarModal(){
      this.fillVerFIT.cNombre = ''
      this.fillVerFIT.cSlug = ''
      this.listPermisos = [];
      this.modalOption = 0;
    },
  setCambiarEstadoFIT(op, id){
      Swal.fire({
      title: 'Estas seguro? ' + ((op == 1) ? 'Aprobar ' : 'Rechazar ') + '  El formulario de inscripcion',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: ((op == 1) ? 'Si, Aprobar' : 'Si, Rechazar')
    }).then((result) => {
      if (result.value) {
        this.fullscreenLoading = true;
        var url = '/alumno/setCambiarEstadoFIT'
        axios.post(url, {
          'nIdTesis' : id,
          'cEstadoPg'    : (op == 1) ? 'A' : 'R'
        }).then(response => {
            Swal.fire({
            icon: 'success',
            title: 'Se ' + ((op == 1) ? 'Aprobo ' : 'Rechazo ') +' El formulario de inscripcion',
            showConfirmButton: false,
            timer: 1500
            })
            this.getListarTesis();
        })
      }
    })
    }
   
  
  }//cierre de methods
}
</script>

<style>
  .scrollTable{
    max-height: 350px !important;
    overflow: auto !important; 
  }

</style>