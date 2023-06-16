<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ResenaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Models\Servicio;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//solo rutas del admin
Route::middleware(['auth', 'rol:admin'])->group(function () {
    //Rutas protegidas para admin
    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard', [ServicioController::class , 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    //borra un servicios
    Route::get('/servicio/{servicio}/borrar', [ServicioController::class, 'destroy']);

    //envia informacion de de un formulario para crear un servicio
    Route::get('/servicio/nuevo', [ServicioController::class, 'create']);
    //crea el servicio enviado por el formuario
    Route::post('/servicio/store', [ServicioController::class, 'store']);

    //modifica el servicio determinado
    Route::post('/servicio/{servicio}/update', [ServicioController::class, 'update']);

    //envia a ver el detalle de un servicio segun el id
    Route::get('/servicio/{servicio}/detalle', [ServicioController::class, 'show']);


    //busqueda
    Route::post('/servicio/fecha', [ServicioController::class, 'buscarFecha']);
    Route::post('/servicio/ciudad', [ServicioController::class, 'buscarCiudad']);
    Route::post('/servicio/categoria', [ServicioController::class, 'buscarCategoria']);

    //--------------------------------------------------productos---------------------------------------------------------------------------
    Route::get('/productosadmin', [ProductoController::class, 'index'])->middleware(['auth', 'verified'])->name('productos');

    //envia informacion de de un formulario para crear un producto
    Route::get('/producto/nuevo', [ProductoController::class, 'create']);
    //crea el prodcuto enviado por el formuario
    Route::post('/producto/store', [ProductoController::class, 'store']);

    //borra un producto
    Route::get('/producto/{producto}/borrar', [ProductoController::class, 'destroy']);

    //modifica el producto determinado
    Route::post('/producto/{producto}/update', [ProductoController::class, 'update']);

    //envia a ver el detalle de un producto segun el id
    Route::get('/producto/{producto}/detalle', [ProductoController::class, 'show']);

    //busqueda
    Route::post('/producto/fecha', [ProductoController::class, 'buscarFecha']);
    Route::post('/producto/nombre', [ProductoController::class, 'buscarNombre']);
    Route::post('/producto/categoria', [ProductoController::class, 'buscarCategoria']);


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //solo autenticados
    Route::get('/servicios', [ServicioController::class, 'index'])->middleware(['auth', 'verified'])->name('eventos');

    //inserta al usuario en el servicio  me gusta
    Route::post('/servicio/user/store', [ServicioController::class, 'megusta']);
    //borra un usuario del servicio segun el servicio en que dio megusta y la id del usuario
    Route::get('/servicio/{servicio}/user/{user}/borrar', [ServicioController::class, 'borrarUser']);

    //envia a ver el detalle de un servicio segun el id
    Route::get('/servicio/{servicio}/detalle', [ServicioController::class, 'show']);

    //agrega un cometario de un servicio
    Route::post('/servicio/coment', [ServicioController::class, 'comentario']);
    //borra un comentario determinado
    Route::get('/comentario/{comentario}/borrar', [ServicioController::class, 'borrarComent']);

    //buscar
    Route::post('/servicio/buscar/fecha', [ServicioController::class, 'buscarFecha']);
    Route::post('/servicio/buscar/ciudad', [ServicioController::class, 'buscarCiudad']);
    Route::post('/servicio/buscar/categoria', [ServicioController::class, 'buscarCategoria']);

    //envia un email al usuario interesado
    Route::get('/servicio/{servicio}/user/{user}/interesado', [ServicioController::class, 'envioEmail']);

    //----------------------------PRODUCTOS----------------

    Route::get('/productos', [ProductoController::class, 'index'])->middleware(['auth', 'verified'])->name('productos');

    //agrega un cometario de un producto
    Route::post('/producto/resena', [ProductoController::class, 'resena']);
    //borra un comentario determinado
    Route::get('/resena/{resena}/borrar', [ProductoController::class, 'deleteComent']);

    //envia a ver el detalle de un servicio segun el id
    Route::get('/producto/{producto}/detalle', [ProductoController::class, 'show']);

    //contacto
    Route::get('/contacto', [ResenaController::class, 'index']);

    //busqueda
    Route::post('/producto/buscar/fecha', [ProductoController::class, 'buscarFecha']);
    Route::post('/producto/buscar/nombre', [ProductoController::class, 'buscarNombre']);
    Route::post('/producto/buscar/categoria', [ProductoController::class, 'buscarCategoria']);

    //carrrito
    Route::get('/carrito', [ProductoController::class, 'productCart']);
    Route::get('/product/{id}', [ProductoController::class, 'addProducttoCart'])->name('addProduct.to.cart');
    Route::patch('/update-shopping-cart', [ProductoController::class, 'updateCart'])->name('update.sopping.cart');
    Route::delete('/delete-cart-product', [ProductoController::class, 'deleteProduct'])->name('delete.cart.product');
    Route::delete('/update-cart-product', [ProductoController::class, 'updateProduct'])->name('update.cart.product');
    Route::put('/sumar-cart-product', [ProductoController::class, 'sumaProduct'])->name('sumar.cart.product');

    Route::post('/borrar-carrito', [ProductoController::class, 'borrarcarrito']);

    //-------------CONTACTO---------------------------
    //envia un email al usuario interesado
    Route::post('/enviar/info/contacto', [ResenaController::class, 'store']);
});

//rutas solo para web sin  autenticar
Route::get('/', function () {
    return view('welcome',['servicios' => Servicio::paginate(3)]);
});
Route::get('/servicios', [ServicioController::class, 'index1']);
Route::get('/productos', [ProductoController::class, 'index1']);
Route::get('/contacto', [ResenaController::class, 'index']);


require __DIR__.'/auth.php';
