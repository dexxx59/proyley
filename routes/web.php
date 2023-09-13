<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\EnvioController;
use App\Http\Controllers\admin\ImageController;
use App\Http\Controllers\admin\PedidosController;
use App\Http\Controllers\admin\PrendaController as AdminPrendaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PrendaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [TestController::class, 'welcome']);

Route::get('/search', [SearchController::class, 'show']);
Route::get('products/json',[SearchController::class, 'data']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('products/{id}', [PrendaController::class, 'show']);
Route::get('categories/{category}', [CategoriaController::class, 'show']);

Route::post('/cart', [CartDetailController::class, 'store']);
Route::delete('/cart', [CartDetailController::class, 'destroy']);

Route::post('/order', [CartController::class, 'update']);

//Pedidos
Route::get("/pedidos/ticket", [PedidoController::class, 'ticket'])->name("pedidos.ticket");
        
Route::resource('/pedidos', PedidoController::class); //

Route::post('/pedidos/{id}/delete', [PedidoController::class, 'destroy']); //eliminar


Route::middleware(['auth','admin'])->namespace('Admin')->prefix('admin')->group(function () {
	Route::get('/products', [AdminPrendaController::class, 'index']); //listar 
	Route::get('/products/create', [AdminPrendaController::class, 'create']); //formulario para crear
	Route::post('/products', [AdminPrendaController::class, 'store']); //crear
	Route::get('/products/{id}/edit', [AdminPrendaController::class, 'edit']); //form editar
	Route::post('/products/{id}/edit', [AdminPrendaController::class, 'update']); //actualizar
	Route::post('/products/{id}/delete', [AdminPrendaController::class, 'destroy']); //eliminar

	Route::get('/products/{id}/images', [ImageController::class, 'index']); //listado imagenes 
	Route::post('/products/{id}/images', [ImageController::class, 'store']); //registrar
	Route::delete('/products/{id}/images', [ImageController::class, 'destroy']); //eliminar image
	Route::get('/products/{id}/images/select/{image}', [ImageController::class, 'select']); //destacar 

	//category
	Route::get('/categories', [CategoryController::class, 'index']); //listar 
	Route::get('/categories/create', [CategoryController::class, 'create']); //formulario para crear
	Route::post('/categories', [CategoryController::class, 'store']); //crear
	Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']); //form editar
	
	Route::post('/categories/{category}/edit', [CategoryController::class, 'update']); //actualizar
	Route::delete('/categories/{category}', [CategoryController::class, 'destroy']); //eliminar

	//envios
	Route::get('/envios', [EnvioController::class, 'index']); //listar
	Route::get('/envios/create', [EnvioController::class, 'create']); //formulario para crear
	Route::post('/envios', [EnvioController::class, 'store']); //crear
	Route::get('/envios/{envio}/edit', [EnvioController::class, 'edit']); //form editar
	
	Route::post('/envios/{envio}/edit', [EnvioController::class, 'update']); //actualizar
	Route::delete('/envios/{envio}', [EnvioController::class, 'destroy']); //eliminar

	Route::post('/envios/{envio}/actEstPed', [EnvioController::class, 'ActualizarEstadoPedido']); //actualizar el estado del pedido
	Route::get('/envios/{envio}', [EnvioController::class, 'show']);

	//pédidos
	Route::get('/pedido', [PedidosController::class, 'index']); //listar
	Route::get('/pedido/{pedido}', [PedidosController::class, 'show']);
});