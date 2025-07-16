<?php

use App\Http\Controllers\Api\Applicant\ApplicantController;
use Illuminate\Support\Facades\Auth;



use App\Http\Controllers\Front\Portal\AcceptanceController;
use App\Http\Controllers\Front\Portal\ApplicantPdfGenerationController;
use App\Http\Controllers\Front\Portal\BiodataController;
use App\Http\Controllers\Front\Portal\EducationController;
use App\Http\Controllers\Front\Portal\PersonnelPortalInfoController;
use App\Http\Controllers\Front\Portal\ProfessionController;


use App\Http\Controllers\PortalLogin;


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

Route::get('/Portal', [PortalLogin::class, 'showPortalForm'])->name('portal.login');
Route::get('/Verify-Otp', [PortalLogin::class, 'verify'])->name('verify-otp');
Route::post('/otp', [PortalLogin::class, 'verifyOtp'])->name('otp-for-initial-login');
Route::post('/Portal', [PortalLogin::class, 'apply'])->name('portal.apply');

Route::get('/Reprint-Verify-Otp', [PortalLogin::class, 'verify_reprint_summary_report_otp'])->name('report-verify-otp');
Route::post('/otp-for-summary-sheet-reprint', [PortalLogin::class, 'verifyOtpreprint'])->name('otp-for-reprint');
Route::get('/Print/Summary/Sheet', [PortalLogin::class, 'PrintSummarySheet'])->name('print-summary-sheet');
Route::post('/summary-sheet', [PortalLogin::class, 'print_summary_sheet'])->name('print-summary');

Route::get('/confirm-contact-change', [PortalLogin::class, 'showConfirmForm'])->name('confirm.contact.change');
Route::post('/confirm-contact-change', [ApplicantController::class, 'confirmContactChange'])->name('confirm.contact.change.post');

// Portal landing page after login
Route::middleware(['portal'])->group(function () {

    Route::get('/apply/{step?}', [PersonnelPortalInfoController::class, 'index'])->name('portal-apply');
    Route::prefix('applicant')->group(function () {
        Route::get('/bio-data', [BiodataController::class, 'biodata'])->name('bio-data');
        Route::post('save-biodata', [BiodataController::class, 'saveBioData'])->name('saveBioData');
        Route::get('/get-districts/{region_id}', [BiodataController::class, 'getDistricts'])->name('get-districts');
        Route::get('/get-sub-branches/{branch_id}', [BiodataController::class, 'getSubBranches']);
        Route::get('/get-sub-sub-branches/{sub_branch_id}', [BiodataController::class, 'getSubSubBranches']);
       
    });

    Route::prefix('education')->group(function () {
        Route::get('/details', [EducationController::class, 'education_details'])->name('education-details');
        Route::post('save-education-data', [EducationController::class, 'saveEducationData'])->name('saveEducationData');
        Route::get('/get-wassce-subjects', [EducationController::class, 'getSubjectsByCourse'])->name('get-wassce-subjects');
    });

    Route::prefix('declaration-and-acceptance')->group(function () {
        Route::get('/preview-data', [AcceptanceController::class, 'preview'])->name('preview');
        Route::post('Declaration-and-Acceptance', [AcceptanceController::class, 'Declaration_and_Acceptance'])->name('declaration-and-acceptance');
    });
    Route::post('/apply-logout', [PortalLogin::class, 'apply_logout'])->name('apply_logout');
    Route::get('/applicant-pdf', [ApplicantPdfGenerationController::class, 'generatePdf'])->name('applicant-pdf');

    Route::get('/applicant/already-exists', function () {
        return view('portal.pdf.already_exist');
    })->name('applicant.already-exists');
});
// Default route redirects to Portal login
Route::get('/', function () {
    return redirect()->route('portal.login');
});
Auth::routes();
