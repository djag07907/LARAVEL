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

                       <h2>Listado de Precio Historico</h2><br/>                      
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
                                      <option value="nombre_producto">Producto</option>                                     
                                    </select>
                                    <input type="text"  @keyup.enter="listarPrecioHistorico(1,buscar,criterio);" v-model="buscar" class="form-control" placeholder="Buscar texto">
                                    <button type="submit"  @click="listarPrecioHistorico(1,buscar,criterio);" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                   
                                    <th>Producto</th>
                                    <th>Precio Anterior</th>
                                    <th>Precio Nuevo</th>
                                    <th>Fecha de Cambio</th>
                                </tr>
                            </thead>
                            <tbody>                              
                                <tr v-for="precio_historico in arrayPrecioHistorico" :key="precio_historico.id">
                                    
                                    <td v-text="precio_historico.nombre_producto"></td>
                                    <td v-text="precio_historico.precio_viejo"></td>
                                    <td v-text="precio_historico.precio_nuevo"></td>
                                    <td v-text="precio_historico.fecha_cambio"></td>
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
            </div>
    </main>
</template>

<script>

    export default {
        data(){

            return {
               
                precio_historico_id:0,
                idproducto:0,
                nombre_producto:'',
                precio_viejo:0,
                precio_nuevo:0,
                pagination:{
                   
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
           
                },
                offset:3,
                criterio:'nombre_producto',
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

           listarPrecioHistorico(page,buscar,criterio){

               let me=this;

               var url= '/precio_historico?page=' + page + '&buscar='+ buscar + '&criterio='+criterio;

               axios.get(url).then(function (response) {
                    // handle success
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayPrecioHistorico=respuesta.precios_historicos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
           },

           cargarPdf(){
               
               window.open('http://127.0.0.1:8000/precio_historico/listarPdf','_blank');

            },
            cargarExcel(){
               
               window.open('http://127.0.0.1:8000/precio_historico/listarExcel','_blank');

            },

            cambiarPagina(page,buscar,criterio){
              
              let me = this;

              //Actualiza  la pagina actual

               me.pagination.current_page=page;

               me.listarPrecioHistorico(page,buscar,criterio);

            },

            },

            mounted() {
            //console.log('Component mounted.')
            this.listarPrecioHistorico(1,this.buscar,this.criterio);
            }
        }
</script>