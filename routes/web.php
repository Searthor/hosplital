<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Livewire\Backend\Settings\JobContent;
use App\Livewire\Backend\Website\BlogContent;
use App\Livewire\Backend\Website\AboutContent;
use App\Livewire\Backend\Website\SlidesContent;
use App\Livewire\Backend\Settings\RoleComponent;
use App\Livewire\Backend\Settings\SectorContent;
use App\Livewire\Backend\Settings\TargetContent;
use App\Livewire\Backend\Website\BlogTypeContent;
use App\Livewire\Backend\Report\AllCustomerContent;
use App\Livewire\Backend\Settings\ServiceUnitContent;
use App\Livewire\Backend\Report\CustomerArrearContent;
use App\Livewire\Backend\ExpendIncome\ExpendIncomeContent;

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
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('localization/{local}', function ($local) {
    Session::put('local', $local);
    return back();
});


Route::get('/login', App\Livewire\Backend\LoginComponent::class)->name('backend.login');

Route::group(['middleware' => 'adminLogin'], function () {
    Route::get('/dashboard', App\Livewire\Backend\DashboardComponent::class)->name('backend.dashboard');
    Route::get('/roles', RoleComponent::class)->name('backend.role');
   
   
   
    Route::get('/users', App\Livewire\Backend\Settings\UserComponent::class)->name('backend.user');
    Route::get('/logout', [App\Livewire\Backend\DashboardComponent::class, 'logout'])->name('backend.logout');
    Route::get('/profile', App\Livewire\Backend\ProfileComponent::class)->name('backend.profile');
   
    ///////////////////////////////////// khamdev /////////////////////////////
    
    
    Route::get('/income-expends', ExpendIncomeContent::class)->name('backend.expend_income');
    Route::get('/abouts', AboutContent::class)->name('backend.about');
    Route::get('/blogs', BlogContent::class)->name('backend.blog');
    Route::get('/blog_types', BlogTypeContent::class)->name('backend.blog_type');
    Route::get('/slides', SlidesContent::class)->name('backend.slide');
   
    Route::get('/report-all-customer', AllCustomerContent::class)->name('backend.report_all_customer');
    Route::get('/report-customer-arrear', CustomerArrearContent::class)->name('backend.report_customer_arrear');


    
    ////////////////////// Customers //////////////////////////
    Route::get('/customers', App\Livewire\Backend\Customers\CustomerComponent::class)->name('backend.customers');
    Route::get('/customers/download/{id}', [App\Livewire\Backend\Customers\CustomerComponent::class, 'download'])->name('customers_download');
    /////////////////////////////////////ເງິນກູ້/////////////////////////////
});

// fontend//
Route::get('/', App\Livewire\Fontend\HomeComponent::class)->name('/');
Route::get('/about', App\Livewire\Fontend\AboutComponent::class)->name('fontend.about');
Route::get('/services', App\Livewire\Fontend\ServicesComponent::class)->name('fontend.services');
Route::get('/services/service_detail/{id}', App\Livewire\Fontend\ServiceDetailComponent::class)->name('fontend.service_detail');
Route::get('/news', App\Livewire\Fontend\NewsComponent::class)->name('fontend.news');
Route::get('/news/news_detail/{id}', App\Livewire\Fontend\NewDetailComponent::class)->name('fontend.news_detail');
Route::get('/contact', App\Livewire\Fontend\ContactComponent::class)->name('fontend.contact');
