<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">CERBEUS - Inicio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Clientes</h2><br/>
                      
                        <button type="button" class="btn btn-success btn-lg" @click="abrirModal('cliente','registrar')">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Cliente
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
                                      <option value="nombre">Nombre</option>
                                      <option value="num_documento">Documento</option>
                                      <option value="email">Email</option>
                                      <option value="telefono">Teléfono</option>
                                    </select>
                                    <input type="text"  @keyup.enter="listarCliente(1,buscar,criterio);" v-model="buscar" class="form-control" placeholder="Buscar texto">
                                    <button type="submit"  @click="listarCliente(1,buscar,criterio);" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                   
                                    <th>Cliente</th>
                                    <th>Tipo de Documento</th>
                                    <th>Número Documento</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                    
                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.tipo_documento"></td>
                                    <td v-text="cliente.num_documento"></td>
                                    <td v-text="cliente.telefono"></td>
                                    <td v-text="cliente.email"></td>
                                    <td v-text="cliente.direccion"></td>

                                
                                    <td>
                                        <button type="button" class="btn btn-info btn-md" @click="abrirModal('cliente','actualizar',cliente)">

                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
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
                            
                            <div v-show="errorCliente" class="form-group row div-error">
                                
                                <div class="text-center text-error">
                                    
                                    <div v-for="error in errorMostrarMsjCliente" :key="error" v-text="error"></div>

                                </div>
                            
                            </div>
                             

                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cliente (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-validate.initial="'required|alpha_spaces|min:2|max:50'" maxlength="52" v-model="nombre" class="form-control" placeholder="Nombre del cliente" name="Nombre del Cliente">                                        
                                        <span style="color:red">{{ errors.first('Nombre del Cliente')}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Documento</label>
                                    <div class="col-md-9">
                                        <select ref="documento" v-model="tipo_documento" class="form-control" v-validate.initial="'required|excluded:0'" name="Tipo de Documento">
                                            <option value="0" disabled>Seleccione un Tipo de Documento</option>
                                            <option value="RTN">RTN</option>
                                            <option value="IDENTIDAD">IDENTIDAD</option>
                                            <option value="PASAPORTE">PASAPORTE</option>
                                        </select>
                                        <span style="color:red">{{ errors.first('Tipo de Documento') }}</span>                                    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Número</label>
                                    <div class="col-md-9">
                                        <input type="text" v-if="tipo_documento === 0" v-validate.initial="'required|numeric'" v-model="num_documento" maxlength="13" class="form-control" placeholder="Número de documento" name="Número de documento">
                                        <input type="text" v-if="tipo_documento === 'RTN'" v-validate.initial="{ required: true, regex:/[0|1]{1}[\d]{13}/}" v-model="num_documento" maxlength="14" class="form-control" placeholder="Número de documento" name="Número de documento">
                                        <input type="text" v-if="tipo_documento === 'IDENTIDAD'" v-validate.initial="{ required: true, regex:/[0|1]{1}[\d]{12}/}" v-model="num_documento" maxlength="13" class="form-control" placeholder="Número de documento" name="Número de documento">
                                        <input type="text" v-if="tipo_documento === 'PASAPORTE'" v-validate.initial="'required|alpha_num'" v-model="num_documento" maxlength="20" class="form-control" placeholder="Número de documento" name="Número de documento">                                        
                                        <span style="color:red">{{ errors.first('Número de documento')}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                                    <div class="col-md-9">
                                        <input type="text" v-validate.initial="'required|'" v-model="direccion" class="form-control" placeholder="Dirección" name="Dirección">
                                        <span style="color:red">{{ errors.first('Dirección')}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-validate.initial="{ required: true, regex:/[2|3|7|8|9]{1}[\d]{7}/}" v-model="telefono" class="form-control" placeholder="Teléfono" name="Teléfono">
                                        <span style="color:red">{{ errors.first('Teléfono')}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-validate.initial="'required|email'" v-model="email" class="form-control" placeholder="Email" name="Correo">
                                        <span style="color:red">{{ errors.first('Correo')}}</span>
                                    </div>
                                </div>
                               

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="cerrarModal()" class="btn btn-danger"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            <button type="button" @click="registrarCliente()" v-if="tipoAccion==1" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" @click="actualizarCliente()" v-if="tipoAccion==2" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Actualizar</button>
                           
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
   
    export default {
        data(){

            return {
               
                cliente_id:0,
                nombre : '',
                tipo_documento :0,
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '', 
                arrayCliente:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorCliente:0,
                errorMostrarMsjCliente:[],
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

           listarCliente(page,buscar,criterio){

               let me=this;

               var url= '/cliente?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayCliente=respuesta.clientes.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
           },
            cargarPdf(){
               
               window.open('http://127.0.0.1:8000/cliente/listarPdf','_blank');

            },

            cargarExcel(){
               
               window.open('http://127.0.0.1:8000/cliente/listarExcel','_blank');

            },

           cambiarPagina(page,buscar,criterio){
              
              let me = this;

              //Actualiza  la pagina actual

               me.pagination.current_page=page;

               me.listarCliente(page,buscar,criterio);

           },

           registrarCliente(){

               if(this.validarCliente()){

                   return;
               }

               let me=this;

               axios.post('/cliente/registrar',{
                 
                    'nombre': this.nombre,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarCliente(1,'','nombre');

                    Swal.fire(
                       '¡Exitoso!',
                       'El cliente se ha creado con exito.',
                       'success'
                    )

                }).catch(function (error) {
                    // handle error
                    Swal.fire(
                       '¡Opss!',
                       'Parece que el cliente ya existe',
                       'error'
                    );
                    console.log(error);
                });

           },

            actualizarCliente(){

                if(this.validarCliente()){

                   return;
               }

               let me=this;

               axios.put('/cliente/actualizar',{
                 
                    'nombre': this.nombre,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion,
                    'id':this.cliente_id


               }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.cerrarModal();
                    me.listarCliente(1,'','nombre');

                    Swal.fire(
                       '¡Exitoso!',
                       'El cliente se ha actualizado con exito.',
                       'success'
                    )

                }).catch(function (error) {
                     Swal.fire(
                       '¡Opss!',
                       'Parece que el cliente ya existe',
                       'error'
                    );
                    // handle error
                    console.log(error);
                });

            },

            validarCliente(){

                this.errorCliente=0;
                this.errorMostrarMsjCliente =[];

                if (!this.nombre) this.errorMostrarMsjCliente.push("(*)El nombre del cliente no puede estar vacío.");
                if (!this.tipo_documento) this.errorMostrarMsjCliente.push("(*)El tipo del documento del cliente no puede estar vacío.");
                if (!this.num_documento) this.errorMostrarMsjCliente.push("(*)El numero del documento del cliente no puede estar vacío.");
                if (!this.telefono) this.errorMostrarMsjCliente.push("(*)El telefono del cliente no puede estar vacío.");
                if (!this.direccion) this.errorMostrarMsjCliente.push("(*)La direcciones del cliente no puede estar vacío.");
                if (this.errorMostrarMsjCliente.length) this.errorCliente = 1;

                return this.errorCliente;
            },
            'num_documento' : this.num_documento,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion,

           cerrarModal(){

                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.tipo_documento=0;
                this.num_documento='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.errorCliente=0;

           },

           abrirModal(modelo,accion,data=[]){
                 
                 switch(modelo){

                    case "cliente":
                    
                    {

                        switch(accion){

                            case "registrar":

                                {
                                   
                                    this.modal = 1;
                                    this.tituloModal = 'Agregar Cliente';
                                    this.nombre= '';
                                    this.tipo_documento=0;
                                    this.num_documento='';
                                    this.direccion='';
                                    this.telefono='';
                                    this.email='';
                                    this.tipoAccion = 1;
                                    break;
                                
                                }

                                case "actualizar":

                                {
                                    //console.log(data);
                                    this.modal=1;
                                    this.tituloModal='Editar Cliente';
                                    this.tipoAccion=2;
                                    this.cliente_id=data['id'];
                                    this.nombre = data['nombre'];
                                    this.tipo_documento = data['tipo_documento'];
                                    this.num_documento = data['num_documento'];
                                    this.telefono = data['telefono'];
                                    this.email = data['email'];
                                    this.direccion = data['direccion'];
                                    break;
                                }
                        
                        }


                    }

                }

                        
           }
        
        },
        
        mounted() {
            //console.log('Component mounted.')
            this.listarCliente(1,this.buscar,this.criterio);
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
