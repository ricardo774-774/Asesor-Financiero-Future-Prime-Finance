<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriasgController;
use App\Http\Controllers\GeneradorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HistoricosController;
use App\Http\Controllers\MetaHistoricoController;
use App\Http\Controllers\MetasController;
use App\Http\Controllers\PrevioController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\calculoiaController;

Route::get('/test', function () {
    return view('test');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->middleware(['auth','can:admin.index'])->name('admin.index'); 

    Route::get('/admin/create', 'create')->middleware(['auth','can:admin.create'])->name('admin.create');

    Route::post('/admin', 'store')->middleware(['auth','can:admin.create'])->name('admin.store');

    Route::get('/admin/{admin}', 'show')->middleware(['auth','can:admin.show'])->name('admin.show');

    Route::get('/admin/{admin}/edit', 'edit')->middleware(['auth','can:admin.edit'])->name('admin.edit');

    Route::put('/admin/{admin}', 'update')->middleware(['auth','can:admin.edit'])->name('admin.update');

    Route::delete('/admin/{admin}', 'destroy')->middleware(['auth','can:admin.destroy'])->name('admin.destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->middleware(['auth','can:userr.index'])->name('user.index'); 


    Route::get('/user/create', 'create')->middleware(['auth','can:userr.create'])->name('user.create');

    Route::post('/user', 'store')->middleware(['auth','can:userr.create'])->name('user.store');

    Route::get('/user/{user}', 'show')->middleware(['auth','can:userr.show'])->name('user.show');

    Route::get('/user/{user}/edit', 'edit')->middleware(['auth','can:userr.edit'])->name('user.edit');

    Route::put('/user/{user}', 'update')->middleware(['auth','can:userr.edit'])->name('user.update');

    Route::delete('/user/{user}', 'destroy')->middleware(['auth','can:userr.destroy'])->name('user.destroy');
});

Route::controller(IngresoController::class)->group(function () {
    Route::get('/ingreso', 'index')->middleware(['auth','can:ingreso.index'])->name('ingreso.index'); 


    Route::get('/ingreso/create', 'create')->middleware(['auth','can:ingreso.create'])->name('ingreso.create');

    Route::post('/ingreso', 'store')->middleware(['auth','can:ingreso.create'])->name('ingreso.store');

    Route::get('/ingreso/{ingreso}', 'show')->middleware(['auth','can:ingreso.show'])->name('ingreso.show');

    Route::get('/ingreso/{ingreso}/edit', 'edit')->middleware(['auth','can:ingreso.edit'])->name('ingreso.edit');

    Route::put('/ingreso/{ingreso}', 'update')->middleware(['auth','can:ingreso.edit'])->name('ingreso.update');

    Route::delete('/ingreso/{ingreso}', 'destroy')->middleware(['auth','can:ingreso.destroy'])->name('ingreso.destroy');
});

Route::controller(GastoController::class)->group(function () {
    Route::get('/gasto', 'index')->middleware(['auth','can:gasto.index'])->name('gasto.index'); 


    Route::get('/gasto/create', 'create')->middleware(['auth','can:gasto.create'])->name('gasto.create');

    Route::post('/gasto', 'store')->middleware(['auth','can:gasto.create'])->name('gasto.store');

    Route::get('/gasto/{gasto}', 'show')->middleware(['auth','can:gasto.show'])->name('gasto.show');

    Route::get('/gasto/{gasto}/edit', 'edit')->middleware(['auth','can:gasto.edit'])->name('gasto.edit');

    Route::put('/gasto/{gasto}', 'update')->middleware(['auth','can:gasto.edit'])->name('gasto.update');

    Route::delete('/gasto/{gasto}', 'destroy')->middleware(['auth','can:gasto.destroy'])->name('gasto.destroy');
});

Route::controller(SaldoController::class)->group(function () {
    Route::get('/saldo', 'index')->middleware(['auth','can:saldo.index'])->name('saldo.index'); 


    Route::get('/saldo/create', 'create')->middleware(['auth','can:saldo.create'])->name('saldo.create');

    Route::post('/saldo', 'store')->middleware(['auth','can:saldo.create'])->name('saldo.store');

    Route::get('/saldo/{saldo}', 'show')->middleware(['auth','can:saldo.show'])->name('saldo.show');

    Route::get('/saldo/{saldo}/edit', 'edit')->middleware(['auth','can:saldo.edit'])->name('saldo.edit');

    Route::put('/saldo/{saldo}', 'update')->middleware(['auth','can:saldo.edit'])->name('saldo.update');

    Route::delete('/saldo/{saldo}', 'destroy')->middleware(['auth','can:saldo.destroy'])->name('saldo.destroy');

    Route::post('/reset', 'reset')->middleware(['auth'])->name('saldo.reset');

    Route::post('/clear', 'clear')->middleware(['auth'])->name('saldo.clear');


});

Route::controller(CategoriasgController::class)->group(function () {
    Route::get('/categoriasg', 'index')->middleware(['auth','can:categoriasg.index'])->name('categoriasg.index'); 


    Route::get('/categoriasg/create', 'create')->middleware(['auth','can:categoriasg.create'])->name('categoriasg.create');

    Route::post('/categoriasg', 'store')->middleware(['auth','can:categoriasg.create'])->name('categoriasg.store');

    Route::get('/categoriasg/{categoriasg}', 'show')->middleware(['auth','can:categoriasg.show'])->name('categoriasg.show');

    Route::get('/categoriasg/{categoriasg}/edit', 'edit')->middleware(['auth','can:categoriasg.edit'])->name('categoriasg.edit');

    Route::put('/categoriasg/{categoriasg}', 'update')->middleware(['auth','can:categoriasg.edit'])->name('categoriasg.update');

    Route::delete('/categoriasg/{categoriasg}', 'destroy')->middleware(['auth','can:categoriasg.destroy'])->name('categoriasg.destroy');

});

Route::controller(PrevioController::class)->group(function () {
    Route::get('/previo', 'index')->middleware(['auth','can:previo.index'])->name('previo.index'); 


    Route::get('/previo/create', 'create')->middleware(['auth','can:previo.create'])->name('previo.create');

    Route::post('/previo', 'store')->middleware(['auth','can:previo.create'])->name('previo.store');

    Route::get('/previo/{previo}', 'show')->middleware(['auth','can:previo.show'])->name('previo.show');

    Route::get('/previo/{previo}/edit', 'edit')->middleware(['auth','can:previo.edit'])->name('previo.edit');

    Route::put('/previo/{previo}', 'update')->middleware(['auth','can:previo.edit'])->name('previo.update');

    Route::delete('/previo/{previo}', 'destroy')->middleware(['auth','can:previo.destroy'])->name('previo.destroy');

});

Route::controller(HistoricosController::class)->group(function () {
    //Route::get('/previo', 'index')->middleware(['auth','can:previo.index'])->name('previo.index'); 


    //Route::get('/previo/create', 'create')->middleware(['auth','can:previo.create'])->name('previo.create');

    Route::post('/historicos', 'store')->middleware(['auth','can:historicos.create'])->name('historicos.store');

    //Route::get('/previo/{previo}', 'show')->middleware(['auth','can:previo.show'])->name('previo.show');

    //Route::get('/previo/{previo}/edit', 'edit')->middleware(['auth','can:previo.edit'])->name('previo.edit');

    //Route::put('/previo/{previo}', 'update')->middleware(['auth','can:previo.edit'])->name('previo.update');

    //Route::delete('/previo/{previo}', 'destroy')->middleware(['auth','can:previo.destroy'])->name('previo.destroy');

});

Route::controller(MetasController::class)->group(function () {
    Route::get('/meta', 'index')->middleware(['auth','can:meta.index'])->name('meta.index');

    Route::get('/meta/create', 'create')->middleware(['auth','can:meta.create'])->name('meta.create');

    Route::post('/meta', 'store')->middleware(['auth','can:meta.create'])->name('meta.store');

    //Route::get('/previo/{previo}', 'show')->middleware(['auth','can:previo.show'])->name('previo.show');

    Route::get('/meta/{meta}/edit', 'edit')->middleware(['auth','can:meta.edit'])->name('meta.edit');

    Route::put('/meta/{meta}', 'update')->middleware(['auth','can:meta.edit'])->name('meta.update');

    //Route::delete('/previo/{previo}', 'destroy')->middleware(['auth','can:previo.destroy'])->name('previo.destroy');

});

Route::controller(MetaHistoricoController::class)->group(function () {
    //Route::get('/previo', 'index')->middleware(['auth','can:previo.index'])->name('previo.index'); 


    //Route::get('/previo/create', 'create')->middleware(['auth','can:previo.create'])->name('previo.create');

    Route::post('/meta_historicos', 'store')->middleware(['auth','can:meta_historicos.create'])->name('meta_historicos.store');

    //Route::get('/previo/{previo}', 'show')->middleware(['auth','can:previo.show'])->name('previo.show');

    //Route::get('/previo/{previo}/edit', 'edit')->middleware(['auth','can:previo.edit'])->name('previo.edit');

    //Route::put('/previo/{previo}', 'update')->middleware(['auth','can:previo.edit'])->name('previo.update');

    //Route::delete('/previo/{previo}', 'destroy')->middleware(['auth','can:previo.destroy'])->name('previo.destroy');

});

Route::controller(calculoiaController::class)->group(function () {
    //Route::get('/previo', 'index')->middleware(['auth','can:previo.index'])->name('previo.index'); 


    //Route::get('/previo/create', 'create')->middleware(['auth','can:previo.create'])->name('previo.create');

    Route::post('/calculoia', 'store')->middleware(['auth'])->name('calculoia');

    Route::post('/meta_calculoia', 'meta')->middleware(['auth'])->name('meta.calculoia');

    Route::get('/calculoia', 'store')->middleware(['auth'])->name('calculoia.get');

    Route::get('/meta_calculoia', 'meta')->middleware(['auth'])->name('meta.calculoia.get');

    //Route::get('/previo/{previo}', 'show')->middleware(['auth','can:previo.show'])->name('previo.show');

    //Route::get('/previo/{previo}/edit', 'edit')->middleware(['auth','can:previo.edit'])->name('previo.edit');

    //Route::put('/previo/{previo}', 'update')->middleware(['auth','can:previo.edit'])->name('previo.update');

    //Route::delete('/previo/{previo}', 'destroy')->middleware(['auth','can:previo.destroy'])->name('previo.destroy');

});



Route::controller(GeneradorController::class)->group(function () {
    Route::get('/generador', 'index')->middleware(['auth'])->name('generador.index'); 


    //Route::get('/previo/create', 'create')->middleware(['auth','can:previo.create'])->name('previo.create');

    //Route::post('/calculoia', 'store')->middleware(['auth'])->name('calculoia');

    //Route::post('/meta_calculoia', 'meta')->middleware(['auth'])->name('meta.calculoia');

    //Route::get('/calculoia', 'store')->middleware(['auth'])->name('calculoia.get');

    //Route::get('/meta_calculoia', 'meta')->middleware(['auth'])->name('meta.calculoia.get');

    //Route::get('/previo/{previo}', 'show')->middleware(['auth','can:previo.show'])->name('previo.show');

    //Route::get('/previo/{previo}/edit', 'edit')->middleware(['auth','can:previo.edit'])->name('previo.edit');

    //Route::put('/previo/{previo}', 'update')->middleware(['auth','can:previo.edit'])->name('previo.update');

    //Route::delete('/previo/{previo}', 'destroy')->middleware(['auth','can:previo.destroy'])->name('previo.destroy');

    Route::post('/generador', 'sugerencia')->middleware(['auth'])->name('generador.sugerencia'); 

});


require __DIR__.'/auth.php';
