<?php
use App\Http\Controllers\insertController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [insertController::class, 'index'])->name('user.index');
    Route::get('/user/create', [insertController::class, 'create'])->name('user.creation');
    Route::post('/user/store', [insertController::class, 'store'])->name('user.store');
    Route::get('user/{id}/update', [insertController::class, 'update'])->name('user.update');
    Route::put('user/{id}/edit', [insertController::class, 'edit'])->name('user.edit');
    Route::delete('user/{id}/delete', [insertController::class, 'delete'])->name('user.delete');
    Route::get('/users/data', [insertController::class, 'getData'])->name('users.data');
});
?>