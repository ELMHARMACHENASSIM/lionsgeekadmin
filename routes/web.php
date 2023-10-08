<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ReservationClasseController;
use App\Http\Controllers\ReservationStudioController;
use App\Http\Controllers\ReservationStudioMaterialController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
use App\Models\ReservationClasse;
use App\Models\ReservationStudio;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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

//* default view
// Route::get('/', [HomeController::class, "index"])->name("home.index");

        Route::get("/", [FrontController::class, "home"])->name("user.Home");



//*jetstream dashboard view
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'check.password.change',])->group(function () {

    Route::get("/user/reservation", [FrontController::class, "reservation"])->name("user.reservation");
    Route::get("/user/setting", [FrontController::class, "settings"])->name("user.settings");
});



//* verification email if not verified (not 2fa)
Route::get('/email/verify', [VerifyEmailController::class, "show"])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, "verifyemailview"])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [VerifyEmailController::class, "sendveriication"])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('update/password', [PasswordChangeController::class, "show"])->name('change.password');
Route::put('password/change', [PasswordChangeController::class, 'change'])->name('password.reupdate');


//!!!!!!!! Your routes for authenticated users with the "gestion studio" role

Route::group(['middleware' => ['auth', 'gestionnaire_studio', 'verified', 'check.password.change',]], function () {
    Route::get("/user/reservationStudio", [ReservationStudioController::class, "indexfront"])->name("reservationStudio.indexfront");
    Route::get("/user/studios", [FrontController::class, "studios"])->name("user.studios");
    Route::get("/user/materials", [FrontController::class, "materials"])->name("user.materials");
    Route::get("/user/studios/show/{studio}", [FrontController::class, "studioShow"])->name("user.studioShow");
    Route::get("/reservationStudio/studio/info/{studio}", [ReservationStudioController::class, "studioInfo"])->name("reservationStudio.info");
    Route::get("/user/reservationStudio/studio/info/{studio}", [ReservationStudioController::class, "studioInfoFront"])->name("reservationStudioFront.info");
    Route::get("/reservationStudio/create/{studio}", [ReservationStudioController::class, "createStudioReservation"])->name("reservationStudio.create");
    Route::get("/user/reservationStudio/create/{studio}", [ReservationStudioController::class, "createStudioReservationfront"])->name("reservationStudioFront.create");
    Route::post("/reservationStudio/store/{studio}", [ReservationStudioController::class, "store"])->name("reservationStudio.store");
    Route::put("/reservationStudio/update/cancel/{chosenReservation}", [ReservationStudioController::class, "cancel"])->name("reservationStudio.cancel");
    Route::put("/reservationStudio/update/{chosenReservation}", [ReservationStudioController::class, "update"])->name("reservationStudio.update");
    Route::get("/reservationStudio/event/{id}", [ReservationStudioController::class, "reservationStudioEvent"])->name("reservationStudio.event");
    Route::get("/reservationStudio/downloadTxtAjax", [ReservationStudioController::class, "downloadTxtAjax"])->name("reservationStudio.downloadTxtAjax");
    Route::delete("/ReservationStudio/event/material/{chosenReservation}/{material}", [ReservationStudioMaterialController::class, "destroy"])->name("ReservationStudioMat.destroy");
});

//!!!!!!!! Your routes for authenticated users with the "gestion classe" role

Route::group(['middleware' => ['auth', 'gestionnaire_classe', 'verified', 'check.password.change',]], function () {
    Route::get("/user/reservationClasse", [ReservationClasseController::class, "indexfront"])->name("reservationClasse.indexfront");
    Route::get("/user/classes", [FrontController::class, "classes"])->name("user.classes");
    Route::get("/user/classes/show/{classe}", [FrontController::class, "classShow"])->name("user.classShow");
    Route::get("/reservationClasse/classe/{classe}/info", [ReservationClasseController::class, "infoIndex"])->name("reservationClasse.info");
    Route::get("/user/reservationClasse/classe/{classe}/info", [ReservationClasseController::class, "infoIndexfront"])->name("reservationClassefront.info");
    Route::post("/reservationClasse/store/{classe}", [ReservationClasseController::class, "store"])->name("reservationClasse.store");
    Route::put("/reservationClasse/update/cancel/{id}", [ReservationClasseController::class, "cancel"])->name("reservationClasse.cancel");
    Route::put("/reservationClasse/update/{id}", [ReservationClasseController::class, "update"])->name("reservationClasse.update");
    Route::get("/reservationClasse/downloadTxtAjax", [ReservationClasseController::class, "downloadTxtAjax"])->name("reservationClasse.downloadTxtAjax");
});

//!!!!!!!! Your routes for authenticated users with the "admin" role

Route::group(['middleware' => ['auth', 'admin', 'verified', 'check.password.change',]], function () {
    Route::get('/classes', [ClasseController::class, 'index'])->name('class.index');
    Route::get('/studios', [StudioController::class, 'index'])->name('studio.index');
    Route::get('/admin/dashboard', [AdminController::class, "index"])->name('admin.dashboard');
    Route::get("/admin/admindashpage", [AdminController::class, "adminDashPage"])->name("admin.admindashpage");
    Route::get("/admin/members", [AdminController::class, "members"])->name("admin.members");
    Route::get("/admin/members/add-new-member", [AdminController::class, "adduser"])->name("admin.adduser");
    Route::post('register',  [AdminController::class, "create"]);
    Route::put('/admin/update/user/{user}',  [AdminController::class, "update"])->name("adminUser.update");
    Route::delete('/admin/users/delete/{user}', [AdminController::class, 'destroy'])->name('adminUser.destroy');
    Route::get("/admin/classes/{classe}/edit", [AdminController::class, "updateClassIndex"])->name("updateclass.index");
    Route::get("/admin/classes/show", [AdminController::class, "showClassIndex"])->name("classes.index");
    Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');
    Route::get("/admin/historique", [AdminController::class, "historiqueIndex"])->name("admin.historique");
    Route::get("/admin/update/classe/{classe}", [AdminController::class, "updateClassIndex"])->name("admin.updateClasse");
    Route::get("/admin/update/studio/{studio}", [AdminController::class, "updateStudioIndex"])->name("admin.updateStudio");
    Route::get("/admin/update/studio/{studio}", [AdminController::class, "updateStudioIndex"])->name("admin.updateStudio");

    //*classes
    Route::put('/class/update/{classe}', [ClasseController::class, 'update'])->name('class.update');
    Route::delete('/class/delete/{classe}', [ClasseController::class, 'delete'])->name('class.delete');
    // image 
    Route::post('/class/store', [ClasseController::class, 'store'])->name('class.store');
    Route::post('/class/images/store/addImage/{classe}', [ClasseController::class, 'addImages'])->name('classimage.store');

    // update images
    Route::put('/class/update/{image}/image', [ClasseController::class, 'updateImages'])->name('classImage.update');
    // delete image
    Route::delete('/class/delete/{image}/image', [ClasseController::class, 'deleteImage'])->name('classimage.delete');

    //////classimage
    // studio
    Route::put('/studio/update/{studio}', [StudioController::class, 'update'])->name('studio.update');
    Route::delete('/studio/delete/{studio}', [StudioController::class, 'delete'])->name('studio.delete');
    // image 
    Route::post('/studio/store', [StudioController::class, 'store'])->name('studio.store');
    Route::post('/studio/images/store/{studio}/addImage', [StudioController::class, 'addImages'])->name('studioimage.store');

    // update images
    Route::put('/studio/update/{image}/image', [StudioController::class, 'updateImages'])->name('studioimage.update');
    // delete image
    Route::delete('/studio/delete/{image}/image', [StudioController::class, 'deleteImage'])->name('studioimage.delete');

    //^^^^ Material
    Route::get('/material', [MaterialController::class, "index"])->name("material.index");
    Route::post('/material/create', [MaterialController::class, "store"])->name("material.store");
    Route::put('/material/{material}/update', [MaterialController::class, "update"])->name("material.update");
    Route::delete('/material/{material}/destroy', [MaterialController::class, "destroy"])->name("material.destroy");

    // classz and studio
    Route::get("/reservationStudio", [ReservationStudioController::class, "index"])->name("reservationStudio.index");
    Route::get("/reservationClasse", [ReservationClasseController::class, "index"])->name("reservationClasse.index");
});

//&&&&&&&&&&&&&&  Frontend views  &&&&&&&&&&&&&&&&
Route::get("/search", [UserController::class, 'search']);
