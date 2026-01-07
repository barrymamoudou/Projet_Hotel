<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, ProfileController, UserController};
use App\Http\Controllers\Backend\{RoomController, RoomTypeController, TeamController};

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', action: [UserController::class, 'Index']);
Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashbord');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile',  [UserController::class, 'UserProfil'])->name('user.profil');
    Route::post('/profile/store',  [UserController::class, 'UserProfilStore'])->name('user.profile.store');
    Route::get('/logout',  [UserController::class, 'UserLogout'])->name('user.logout');
});
require __DIR__ . '/auth.php';
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashbord'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    // Route::post('/admin/profile/store', action: [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});  //middleware pour les pages d'admin

//login admin

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware(['auth', 'roles:admin'])->group(function () {

    Route::controller(TeamController::class)->group(function () {
        Route::get('/admin/team/all', 'AllTeam')->name('all.team');
        Route::get('/team/add', 'AddTeam')->name('add.team');
        Route::post('/admin/team/store', action: 'AddStore')->name('add.store');
        Route::get('team/edit/{id}', 'EditTeam')->name('team.edit');
        Route::post('/edit/update/{id}', 'UpdateTeam')->name('edit.update');
        Route::get('/delete/{id}', 'deleteTeam')->name('team.delete');
    });
     /// Book Area All Route 

    Route::controller(TeamController::class)->group(function(){
        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/book/area/update/{id}', 'BookAreaUpdate')->name('book.area.update');
    });

    /// Room Type All Route 

    Route::controller(RoomTypeController::class)->group(function(){
        Route::get('/room/listroom', 'ListRoomType')->name('room.type.list');
        Route::get('/add/room', 'AddRoomType')->name('add.room.type');
        Route::post('/add/room/store', 'StoreRoomType')->name('store.room.type');
    });
    
    /// Room All Route 

    Route::controller(RoomController::class)->group(function(){
        Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
        
        Route::post('/mutlimage/room/{id}', 'UpdateRoom')->name('update.room');

        Route::get('/mutlimage/mutlimage/{id}', 'MultiImageDelete')->name('delete.mutil.room');

        Route::post('/store/room/no/{id}', 'StoreRoomNumber')->name('store.room.no');
    });


});  //middleware pour les pages d'admin
