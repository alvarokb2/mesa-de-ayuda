<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

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

Route::get('/api/tickets', [TicketController::class, 'ver_tickets']);
Route::get('/api/{proyecto}/tickets', [TicketController::class, 'ver_tickets_proyecto']);
Route::get('/api/{proyecto}/usuario/{usuario}/tickets', [TicketController::class, 'ver_tickets_usuario_proyecto']);
Route::get('/api/{proyecto}/usuario/{usuario}/tickets/{ticket}', [TicketController::class, 'ver_un_ticket_usuario_proyecto']);


Route::post('/api/tickets', [TicketController::class, 'crear_tickets']);
Route::post('/api/mis-tickets', [TicketController::class, 'ver_mis_tickets']);


require __DIR__ . '/auth.php';
