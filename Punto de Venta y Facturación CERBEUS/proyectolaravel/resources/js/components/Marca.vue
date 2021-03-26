<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">CERBEUS - PUNTO DE VENTA Y FACTURACIÓN</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Marcas</h2><br/>
                      
                        <button  type="button" class="btn btn-success btn-lg" @click="abrirModal('marca','registrar')">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Marca
                        </button>
                        <button class="btn btn-primary btn-lg" type="button" @click="cargarPdf();">
                            <i class="fa fa-file-pdf-o fa-2x"></i>&nbsp;&nbsp;Reporte PDF
                        </button>
                        <button class="btn btn-primary btn-lg" type="button" @click="cargarExcel()">
                            <i class="fa fa-file-excel-o fa-2x"></i>&nbsp;&nbsp;Reporte Excel
                        </button>

                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Marca</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text"  @keyup.enter="listarMarca(1,buscar,criterio);" v-model="buscar" class="form-control" placeholder="Buscar texto">
                                    <button type="submit"  @click="listarMarca(1,buscar,criterio);" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                   
                                    <th>Marca</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Cambiar Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="marca in arrayMarca" :key="marca.id">
                                    
                                    <td v-text="marca.nombre"></td>
                                    <td v-text="marca.descripcion"></td>

                                    <td>
                                        <button type="button" class="btn btn-success btn-md" v-if="marca.condicion">
                                    
                                          <i class="fa fa-check fa-2x"></i> Activo
                                        </button>

                                        <button type="button" class="btn btn-danger btn-md" v-else>
                                    
                                          <i class="fa fa-check fa-2x"></i> Desactivado
                                        </button>
                                       
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-md" @click="abrirModal('marca','actualizar',marca)">

                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>

                                    <td>

                                        <template v-if="marca.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMarca(marca.id)">
                                                <i class="fa fa-lock fa-2x"></i> Desactivar
                                            </button>
                                        </template>

                                        <template v-else>
                                            <button type="button" class="btn btn-success btn-sm" @click="activarMarca(marca.id)">
                                                <i class="fa fa-lock fa-2x"></i> Activar
                                            </button>
                                        </template>
                                       
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-f="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Anterior</a>
                                </li>

                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                               
                               
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" @click="cerrarModal()" class="close" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">                            
                            <div v-show="errorMarca" class="form-group row div-error">                                
                                <div class="text-center text-error">                                    
                                    <div v-for="error in errorMostrarMsjMarca" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" @submit.prevent="onSubmit">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Marca</label>
                                    <div class="col-md-9">
                                        <input type="text" v-validate.initial="'required|alpha_spaces|min:2|max:50|'" maxlength="55" v-model="nombre" class="form-control" placeholder="Nombre de marca" name="Nombre">
                                        <span style="color:red">{{ errors.first('Nombre') }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" v-validate.initial="'required|alpha_spaces|min:2|max:50|'" maxlength="55" v-model="descripcion" class="form-control" placeholder="Ingrese descripcion" name="Descripcion">
                                        <span style="color:red">{{ errors.first('Descripcion') }}</span>   
                                    </div>
                                </div>
                            </form>  
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="button" :disabled="errors.any()" @click="registrarMarca()" v-if="tipoAccion==1" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" :disabled="errors.any()" @click="actualizarMarca()" v-if="tipoAccion==2" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Actualizar</button>  
                        </div>  
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
           
        
        </main>
</template>

<script>

    import { ValidationProvider } from 'vee-validate';

    export default {

        components: {
            ValidationProvider
        },

        data(){

            return {
               
                marca_id:0,
                nombre:'',
                descripcion:'',
                arrayMarca:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorMarca:0,
                errorMostrarMsjMarca:[],
                pagination:{
                   
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
           
                },
                offset:3,
                criterio:'nombre',
                buscar:''
            }

        },

        computed:{

            isActived: function(){
              
              return this.pagination.current_page;

            },

             //calcula los elementos de la paginacion
            pagesNumber: function(){

                if(!this.pagination.to){
                    
                    return[];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                   
                   from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    
                   to = this.pagination.last_page; 
                }

                var pagesArray = [];
                while(from <= to){
                   
                   pagesArray.push(from);
                   from++;
                }
                return pagesArray;


            }

        },

        methods:{

           listarMarca(page,buscar,criterio){

               let me=this;

               var url= '/marca?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayMarca=respuesta.marcas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
           },

           cambiarPagina(page,buscar,criterio){
              
              let me = this;

              //Actualiza  la pagina actual

               me.pagination.current_page=page;

               me.listarMarca(page,buscar,criterio);

           },
           cargarPdf(){
               
               window.open('http://127.0.0.1:8000/marca/listarPdf','_blank');

            },

            cargarExcel(){
               
               window.open('http://127.0.0.1:8000/marca/listarExcel','_blank');

            },

           registrarMarca(){

               if(this.validarMarca()){

                   return;
               }

               let me=this;

               axios.post('/marca/registrar',{
                 
                 'nombre':this.nombre,
                 'descripcion':this.descripcion


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarMarca(1,'','nombre');
                    Swal.fire(
                       '¡Exitoso!',
                       'La marca se ha creado con exito.',
                       'success'
                    )

                }).catch(function (error) {
                    // handle error
                    Swal.fire(
                       '¡Opss!',
                       'Parece que la marca ya existe',
                       'error'
                    );
                    console.log(error);
                });

           },

            actualizarMarca(){
                

                if(this.validarMarca()){

                   return;
               }

               let me=this;

               axios.put('/marca/actualizar',{
                 
                 'nombre':this.nombre,
                 'descripcion':this.descripcion,
                 'id':this.marca_id


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarMarca(1,'','nombre');
                    Swal.fire(
                       '¡Exitoso!',
                       'La marca se ha actualizado con exito.',
                       'success'
                    )

                }).catch(function (error) {
                    // handle error
                    Swal.fire(
                       '¡Opss!',
                       'Parece que la marca ya existe',
                       'error'
                    );
                    console.log(error);
                });

            },

            desactivarMarca(id){
                            
                const swalWithBootstrapButtons = Swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿Estas seguro de desactivar la marca?',
                //type: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-check fa-2x"></i> Aceptar',
                cancelButtonText: '<i class="fa fa-times fa-2x"></i> Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {

                  let me=this;

               axios.put('/marca/desactivar',{
                 
                 'id':id


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.listarMarca(1,'','nombre');

                     swalWithBootstrapButtons(
                    'Desactivado!',
                    'El registro ha sido desactivado con exito.',
                    'success'
                )

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });


               
                } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
                ) {
               
                }
              })

            },

             activarMarca(id){
                            
                const swalWithBootstrapButtons = Swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: 'Estas seguro de activar la marca?',
                //type: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-check fa-2x"></i> Aceptar',
                cancelButtonText: '<i class="fa fa-times fa-2x"></i> Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {

                  let me=this;

               axios.put('/marca/activar',{
                 
                 'id':id


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.listarMarca(1,'','nombre');

                     swalWithBootstrapButtons(
                    'Activado!',
                    'El registro ha sido activado con exito.',
                    'success'
                )

                }).catch(function (error) {
                    // handle error
                    console.log(error);
                });


               
                } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
                ) {
               
                }
              })

            },

            validarMarca(){

                 this.errorMarca=0;
                 this.errorMostrarMsjMarca=[];

                 if(!this.nombre)  this.errorMostrarMsjMarca.push("(*)El nombre de la marca no puede estar vacio");

                 if(this.errorMostrarMsjMarca.length) this.errorMarca=1;
             
                 return this.errorMarca;
            },

           cerrarModal(){

               this.modal=0;
               this.tituloModal="";
               this.nombre="";
               this.descripcion="";

           },

           abrirModal(modelo,accion,data=[]){
                 
                 switch(modelo){

                    case "marca":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                   this.modal=1;
                                   this.tituloModal="Registrar Marca";
                                   this.nombre="";
                                   this.descripcion="";
                                   this.tipoAccion=1;
                                   break;
                                
                                }

                                case "actualizar":

                                {
                                    //console.log(data);
                                    this.modal=1;
                                    this.tituloModal="Editar Marca";
                                    this.tipoAccion=2;
                                    this.marca_id=data["id"];
                                    this.nombre=data["nombre"];
                                    this.descripcion=data["descripcion"];
                                    break;
                                }
                        
                        }


                    }

                }

                        
           }
        
        },
        
        mounted() {
            //console.log('Component mounted.')
            this.listarMarca(1,this.buscar,this.criterio);
        }
    }
</script>

<style>
           
     .modal-content{

      width:100% !important;
      position:absolute !important;
  }

  .mostrar{

      display:list-item !important;
      opacity:1 !important;
      position:absolute !important;
      background-color:#3c29297a !important;
  }

   .div-error{

      display:flex;
      justify-content:center;
  }

  .text-error{
      
      color:red !important;
      font-weight:bold;
      font-size:20px;
  }

</style>
