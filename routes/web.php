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
use App\Livewire\Backend\Report\ReportPateintComponent;
use App\Livewire\Backend\Report\ReportAppointmentCompont;
use App\Livewire\Backend\Report\MedicineComponrt;
use App\Livewire\Backend\Report\ReportUserComponrt;

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


Route::get('/', App\Livewire\Backend\LoginComponent::class)->name('backend.login');

Route::group(['middleware' => 'adminLogin'], function () {
    Route::get('/dashboard', App\Livewire\Backend\DashboardComponent::class)->name('backend.dashboard');
    // settings
    Route::get('/roles', RoleComponent::class)->name('backend.role');
    Route::get('/users', App\Livewire\Backend\Settings\UserComponent::class)->name('backend.user');
    Route::get('/departments', App\Livewire\Backend\Settings\DepartmentsComponent::class)->name('backend.departments');
    Route::get('/logout', [App\Livewire\Backend\DashboardComponent::class, 'logout'])->name('backend.logout');
    Route::get('/profile', App\Livewire\Backend\ProfileComponent::class)->name('backend.profile');
    Route::get('/abouts', AboutContent::class)->name('backend.about');
    Route::get('/blogs', BlogContent::class)->name('backend.blog');
    Route::get('/blog_types', BlogTypeContent::class)->name('backend.blog_type');
    Route::get('/slides', SlidesContent::class)->name('backend.slide');
   
   
    Route::get('/report-pateint', ReportPateintComponent::class)->name('backend.report_pateint');
    Route::get('/report-appointments', ReportAppointmentCompont::class)->name('backend.report_appointments');
    Route::get('/report-medicine', MedicineComponrt::class)->name('backend.report_medicine');
    Route::get('/report-user', ReportUserComponrt::class)->name('backend.report_user');
    // 
    Route::get('/province', App\Livewire\Backend\Settings\ProvinceComponent::class)->name('backend.province');
    Route::get('/district', App\Livewire\Backend\Settings\DistrictComponent::class)->name('backend.district');
    // patients
    Route::get('/patients', App\Livewire\Backend\Patient\PatientComponent::class)->name('backend.patients');
    Route::get('/patients-detial-lists/{id}', App\Livewire\Backend\Patient\PatientDetailListComponent::class)->name('backend_patient_list');
    Route::get('/patients-detial/{id}', App\Livewire\Backend\Patient\DetailsComponent::class)->name('backend_patient_detail');


    // treatment
    Route::get('/treatment', App\Livewire\Backend\Treatment\TreatmentComponent::class)->name('backend.treatment');
    Route::get('/create', App\Livewire\Backend\Treatment\CreateTreatmentComponent::class)->name('create_treatment');
    Route::get('/detials/{id}', App\Livewire\Backend\Treatment\DetialsComponent::class)->name('treatment_detail');


    // appointment

    Route::get('/appointment', App\Livewire\Backend\Appointments\AppointmentConponent::class)->name('backend.appointment');


    //medicine
    Route::get('/medicine', App\Livewire\Backend\Medicine\MedicinesComponent::class)->name('backend.medicine');
    Route::get('/medicine-type', App\Livewire\Backend\Medicine\MedicineTypesComponent::class)->name('backend.medicine_types');


    
});
// fontend//
//Route::get('/', App\Livewire\Fontend\HomeComponent::class)->name('/');
Route::get('/about', App\Livewire\Fontend\AboutComponent::class)->name('fontend.about');
Route::get('/services', App\Livewire\Fontend\ServicesComponent::class)->name('fontend.services');
Route::get('/services/service_detail/{id}', App\Livewire\Fontend\ServiceDetailComponent::class)->name('fontend.service_detail');
Route::get('/news', App\Livewire\Fontend\NewsComponent::class)->name('fontend.news');
Route::get('/news/news_detail/{id}', App\Livewire\Fontend\NewDetailComponent::class)->name('fontend.news_detail');
Route::get('/contact', App\Livewire\Fontend\ContactComponent::class)->name('fontend.contact');
