<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
     
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/dashboard', 'DashboardController');
      
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Comprador']], function () {
         
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/Categoria/listarPdf', 'CategoriaController@listarPdf')->name('categorias_pdf');
        Route::get('/Categoria/listarExcel', 'CategoriaController@listarExcel')->name('categorias_xls');
        
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
        Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
        Route::get('/producto/listarPdf', 'ProductoController@listarPdf')->name('productos_pdf');
        Route::get('/producto/listarExcel', 'ProductoController@listarExcel')->name('productos_xls');
        
        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/listarPdf', 'ProveedorController@listarPdf')->name('proveedores_pdf');
        Route::get('/proveedor/listarExcel', 'ProveedorController@listarExcel')->name('proveedores_xls');

        Route::get('/compra', 'CompraController@index');
        Route::post('/compra/registrar', 'CompraController@store');
        Route::put('/compra/desactivar', 'CompraController@desactivar');
        Route::get('/compra/obtenerCabecera', 'CompraController@obtenerCabecera');
        Route::get('/compra/obtenerDetalles', 'CompraController@obtenerDetalles');
        Route::get('/compra/pdf/{id}', 'CompraController@pdf')->name('compra_pdf');

        Route::get('/marca', 'MarcaController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::put('/marca/desactivar', 'MarcaController@desactivar');
        Route::put('/marca/activar', 'MarcaController@activar');
        Route::get('/marca/selectMarca', 'MarcaController@selectMarca');
        Route::get('/marca/listarPdf', 'MarcaController@listarPdf')->name('marcas_pdf');
        Route::get('/marca/listarExcel', 'MarcaController@listarExcel')->name('marcas_xls');

        Route::get('/precio_historico', 'PrecioHistoricoController@index');
        Route::get('/precio_historico/buscarPrecioHistorico', 'PrecioHistorico@buscarPrecioHistorico');
        Route::get('/precio_historico/listarPrecioHistorico', 'PrecioHistorico@listarPrecioHistorico');
        Route::get('/precio_historico/listarPdf', 'PrecioHistorico@listarPdf')->name('precioshistoricos_pdf');
         
    });

    Route::group(['middleware' => ['Vendedor']], function () {

        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/Categoria/listarPdf', 'CategoriaController@listarPdf')->name('categorias_pdf');
        Route::get('/Categoria/listarExcel', 'CategoriaController@listarExcel')->name('categorias_xls');
        
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get('/producto/buscarProductoVenta', 'ProductoController@buscarProductoVenta');
        Route::get('/producto/listarProductoVenta', 'ProductoController@listarProductoVenta');
        Route::get('/producto/listarPdf', 'ProductoController@listarPdf')->name('productos_pdf');
        Route::get('/producto/listarExcel', 'ProductoController@listarExcel')->name('productos_xls');
        
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
        Route::get('/cliente/listarPdf', 'ClienteController@listarPdf')->name('clientes_pdf');
        Route::get('/cliente/listarExcel', 'ClienteController@listarExcel')->name('clientes_xls');
       
        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles'); 
        Route::get('/venta/pdf/{id}', 'VentaController@pdf')->name('venta_pdf');
        
        Route::get('/marca', 'MarcaController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::put('/marca/desactivar', 'MarcaController@desactivar');
        Route::put('/marca/activar', 'MarcaController@activar');
        Route::get('/marca/selectMarca', 'MarcaController@selectMarca');
        Route::get('/marca/listarPdf', 'MarcaController@listarPdf')->name('marcas_pdf');
        Route::get('/marca/listarExcel', 'MarcaController@listarExcel')->name('marcas_xls');
    });

    Route::group(['middleware' => ['Administrador']], function () {

        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::get('/categoria/listarPdf', 'CategoriaController@listarPdf')->name('categorias_pdf');
        Route::get('/categoria/listarExcel', 'CategoriaController@listarExcel')->name('categorias_xls');
        
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
        Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
        Route::get('/producto/buscarProductoVenta', 'ProductoController@buscarProductoVenta');
        Route::get('/producto/listarProductoVenta', 'ProductoController@listarProductoVenta');
        Route::get('/producto/listarPdf', 'ProductoController@listarPdf')->name('productos_pdf');
        Route::get('/producto/listarExcel', 'ProductoController@listarExcel')->name('productos_xls');
        
        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/listarPdf', 'ProveedorController@listarPdf')->name('proveedores_pdf');
        Route::get('/proveedor/listarExcel', 'ProveedorController@listarExcel')->name('proveedores_xls');
        
        Route::get('/compra', 'CompraController@index');
        Route::post('/compra/registrar', 'CompraController@store');
        Route::put('/compra/desactivar', 'CompraController@desactivar');
        Route::get('/compra/obtenerCabecera', 'CompraController@obtenerCabecera');
        Route::get('/compra/obtenerDetalles', 'CompraController@obtenerDetalles');
        Route::get('/compra/pdf/{id}', 'CompraController@pdf')->name('compra_pdf');
        Route::get('/compra/listarPdf', 'CompraController@listarPdf')->name('comprareporte_pdf');
        Route::get('/compra/listarExcel', 'CompraController@listarExcel')->name('comprareporte_xls');
         
        
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
        Route::get('/cliente/listarPdf', 'ClienteController@listarPdf')->name('clientes_pdf');
        Route::get('/cliente/listarExcel', 'ClienteController@listarExcel')->name('clientes_xls');
        
        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}', 'VentaController@pdf')->name('venta_pdf');
        Route::get('/venta/listarPdf', 'VentaController@listarPdf')->name('ventareporte_pdf');
        Route::get('/venta/listarExcel', 'VentaController@listarExcel')->name('ventareporte_xls');
        
        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::get('/user/listarPdf', 'UserController@listarPdf')->name('users_pdf');
        Route::get('/user/listarExcel', 'UserController@listarExcel')->name('users_xls');

        Route::get('/marca', 'MarcaController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::put('/marca/desactivar', 'MarcaController@desactivar');
        Route::put('/marca/activar', 'MarcaController@activar');
        Route::get('/marca/selectMarca', 'MarcaController@selectMarca');
        Route::get('/marca/listarPdf', 'MarcaController@listarPdf')->name('marcas_pdf');
        Route::get('/marca/listarExcel', 'MarcaController@listarExcel')->name('marcas_xls');

        Route::get('/precio_historico', 'PrecioHistoricoController@index');
        Route::get('/precio_historico/buscarPrecioHistorico', 'PrecioHistorico@buscarPrecioHistorico');
        Route::get('/precio_historico/listarPrecioHistorico', 'PrecioHistorico@listarPrecioHistorico');
        Route::get('/precio_historico/listarPdf', 'PrecioHistoricoController@listarPdf')->name('precios_historicos_pdf');
        Route::get('/precio_historico/listarExcel', 'PrecioHistoricoController@listarExcel')->name('precios_historicos_xls');
   
    });
    
      
});




//Route::get('/home', 'HomeController@index')->name('home');
