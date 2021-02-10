<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">CERBEUS - PUNTO DE VENTA Y FACTURACIÓN</a></li>
    </ol>

    <div class="container-fluid">


        <div class="card">
            <div class="card-header">
                <h3 class="text-primary text-center">COMPRAS Y VENTAS</h3>
            </div>
            <div class="car-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Compras</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="compras">                                                
                                    </canvas>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4 class="text-center">Ventas</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ventas">                                                
                                    </canvas>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
</template>
<script>
    export default {
        data (){
            return {
               
                varCompra:null,
                charCompra:null,
                compras:[],
                varTotalCompra:[],
                varMesCompra:[],

                varVenta:null,
                charVenta:null,
                ventas:[],
                varTotalVenta:[],
                varMesVenta:[],
            }
        },
        methods : {

            getCompras(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.compras = respuesta.compras;
                    //cargamos los datos del chart
                    me.loadCompras();
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

             getVentas(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ventas = respuesta.ventas;
                    //cargamos los datos del chart
                    me.loadVentas();
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            loadCompras(){
                let me=this;
                me.compras.map(function(x){
                    me.varMesCompra.push(x.mes);
                    me.varTotalCompra.push(x.total);
                });
                me.varCompra=document.getElementById('compras').getContext('2d');

                me.charCompra = new Chart(me.varCompra, {
                    type: 'bar',
                    data: {
                        labels: me.varMesCompra,
                        datasets: [{
                            label: 'Compras',
                            data: me.varTotalCompra,
                            backgroundColor: 'rgba(110, 63, 191, 1)',
                            borderColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },

            loadVentas(){
                let me=this;
                me.ventas.map(function(x){
                    me.varMesVenta.push(x.mes);
                    me.varTotalVenta.push(x.total);
                });
                me.varVenta=document.getElementById('ventas').getContext('2d');

                me.charVenta = new Chart(me.varVenta, {
                    type: 'bar',
                    data: {
                        labels: me.varMesVenta,
                        datasets: [{
                            label: 'Ventas',
                            data: me.varTotalVenta,
                            backgroundColor: 'rgba(20, 204, 20, 1)',
                            borderColor: 'rgba(54, 162, 235, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }
           
        },
        mounted() {

            this.getCompras();
            this.getVentas();
        }
    }
</script>
