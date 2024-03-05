<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CPBController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FabricInformationBoardController;
use App\Http\Controllers\GreyDashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QCController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TrimsAccessoriesStoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YarnDashboardController;
use App\Models\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cpbs/dashboard', [CPBController::class, 'dashboard'])->name('cpbs.dashboard');

Route::get('/get-cpbs', [CPBController::class, 'getCPBs'])->name('get_cpbs');

Route::get('/get-total', [CPBController::class, 'getCPBs_total'])->name('getCPBs_total');

//qcs
Route::get('/qcs/dashboard', [QCController::class, 'dashboard'])->name('qcs.dashboard');

Route::get('/get-qcs', [QCController::class, 'getQCs'])->name('get_qcs');

Route::get('/get-qcs-total', [QCController::class, 'getQCs_total'])->name('getQCs_total');


//New registration ajax route

Route::get('/get-company-designation/{divisionId}', [CompanyController::class, 'getCompanyDesignations'])->name('get_company_designation');


Route::get('/get-department/{company_id}', [CompanyController::class, 'getdepartments'])->name('get_departments');



Route::middleware('auth')->group(function () {


    Route::get('/home', function () {
        return view('backend.home');
    })->name('home');

    //role

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


    //user

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get(
        '/users/{user}/edit',
        [UserController::class, 'edit']
    )->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/online-user', [UserController::class, 'onlineuserlist'])->name('online_user');

    Route::post('/users/{user}/users_active', [UserController::class, 'user_active'])->name('users.active');

    //divisions

    Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions.index');
    Route::get('/divisions/create', [DivisionController::class, 'create'])->name('divisions.create');
    Route::post('/divisions', [DivisionController::class, 'store'])->name('divisions.store');
    Route::get('/divisions/{division}', [DivisionController::class, 'show'])->name('divisions.show');
    Route::get('/divisions/{division}/edit', [DivisionController::class, 'edit'])->name('divisions.edit');
    Route::put('/divisions/{division}', [DivisionController::class, 'update'])->name('divisions.update');
    Route::delete('/divisions/{division}', [DivisionController::class, 'destroy'])->name('divisions.destroy');

    // companies
    Route::resource('companies', CompanyController::class);

    //departments
    Route::resource('departments', DepartmentController::class);

    // designations
    Route::resource('designations', DesignationController::class);

    //cpbs 
    Route::resource('cpbs', CPBController::class);

    //
    Route::resource('qcs', QCController::class);

    //grey_fabrics
    Route::resource('grey_fabrics', GreyDashboardController::class);

    //yarns
    Route::resource('yarns', YarnDashboardController::class);
    Route::get('/yarns-download', [YarnDashboardController::class, 'download'])->name('yarns.download'); //download excel file


    //trims
    Route::resource('trims', TrimsAccessoriesStoreController::class);
    Route::get('/data', [TrimsAccessoriesStoreController::class, 'data'])->name('trims.data');
 //download excel file

    //fabrics
    Route::resource('fabrics', FabricInformationBoardController::class);

    
});


//trims_Dashboard
Route::get('/trims_dashboard', [TrimsAccessoriesStoreController::class, 'dashboard'])->name('trims_dashboard');
Route::get('/get_trims_dashboard', [TrimsAccessoriesStoreController::class, 'getTrimsDashboard'])->name('get_trims_dashboard');

//fabrics_Dashboard
Route::get('/fabrics_dashboard', [FabricInformationBoardController::class, 'dashboard'])->name('fabrics_dashboard');
Route::get('/get_fabrics_dashboard', [FabricInformationBoardController::class, 'getFabricsDashboard'])->name('get_fabrics_dashboard');

//grey_Dashboard
Route::get('/grey_dashboard', [GreyDashboardController::class, 'dashboard'])->name('grey_dashboard');
Route::get('/get_grey_dashboard', [GreyDashboardController::class, 'getGreyDashboard'])->name('get_grey_dashboard');

//yarn_Dashboard
Route::get('/yarn_dashboard', [YarnDashboardController::class, 'dashboard'])->name('yarn_dashboard');
Route::get('/get_yarn_dashboard', [YarnDashboardController::class, 'getYarnDashboard'])->name('get_yarn_dashboard');

//commonDashboard
Route::get('/common_dashboard', [YarnDashboardController::class, 'commonDashboard'])->name('common_dashboard');
Route::get('/get_common_dashboard', [YarnDashboardController::class, 'getcommonDashboard'])->name('getcommonDashboard');


























Route::get('/read/{notification}', [NotificationController::class, 'read'])->name('notification.read');


require __DIR__ . '/auth.php';

//php artisan command

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/cleareverything', function () {
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";
});

Route::get('/key =', function () {
    $key =  Artisan::call('key:generate');
    echo "key:generate<br>";
});

Route::get('/migrate', function () {
    $migrate = Artisan::call('migrate');
    echo "migration create<br>";
});

Route::get('/migrate-fresh', function () {
    $fresh = Artisan::call('migrate:fresh --seed');
    echo "migrate:fresh --seed create<br>";
});

Route::get('/optimize', function () {
    $optimize = Artisan::call('optimize:clear');
    echo "optimize cleared<br>";
});
Route::get('/route-clear', function () {
    $route_clear = Artisan::call('route:clear');
    echo "route cleared<br>";
});

Route::get('/route-cache', function () {
    $route_cache = Artisan::call('route:cache');
    echo "route cache<br>";
});

Route::get('/updateapp', function () {
    $dump_autoload = Artisan::call('dump-autoload');
    echo 'dump-autoload complete';
});
