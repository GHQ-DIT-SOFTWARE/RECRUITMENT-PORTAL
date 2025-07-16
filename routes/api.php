<?php

use App\Http\Controllers\Api\ApplicantPreview\PreviewApplicantController;
use App\Http\Controllers\Api\LogActivities\UserAuditTrailActivitiesController;
use App\Http\Controllers\Api\LogActivities\UserLogActivitiesController;
use App\Http\Controllers\Api\Phases\ApiAptitudeController;
use App\Http\Controllers\Api\Phases\ApiBasicFitnessController;
use App\Http\Controllers\Api\Phases\ApiBodySelectionController;
use App\Http\Controllers\Api\Phases\ApiDocumentationController;
use App\Http\Controllers\Api\Phases\ApiInterviewController;
use App\Http\Controllers\Api\Phases\ApiMedicalsController;
use App\Http\Controllers\Api\Phases\ApiOutDoorLeaderlessController;
use App\Http\Controllers\Api\Phases\ApiVettingController;
use App\Http\Controllers\Api\Report\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Academics
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminSubjectController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminCoursePackagingController;
use App\Http\Controllers\Admin\AdminScoresController;
use App\Http\Controllers\Admin\AdminAssignmentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('phases')->group(function () {
    Route::post('/documentation', [ApiDocumentationController::class, 'applicant_documentation_table'])->name('api-applicant-documentation');
    Route::post('/bodyselection', [ApiBodySelectionController::class, 'applicant_body_selection_table'])->name('api-applicant-body-selection');
    Route::post('/aptitude-test', [ApiAptitudeController::class, 'applicant_aptitude_test'])->name('api-applicant-aptitude-test');
    Route::post('/fitness-test', [ApiBasicFitnessController::class, 'applicant_basicfit_table'])->name('api-applicant-basicfitness');

    // Route::post('/outdoor-leaderless-test', [ApiOutDoorLeaderlessController::class, 'applicant_outdoorleaderless'])->name('api-applicant-poutdoorleaderless');
    // Route::post('/medical-test', [ApiMedicalsController::class, 'applicant_medicals'])->name('api-applicant-medicals');
    // Route::post('/vetting-test', [ApiVettingController::class, 'applicant_vettings'])->name('api-applicant-vettings');
    Route::post('/interview-test', [ApiInterviewController::class, 'applicant_interview'])->name('api-applicant-interview');

    Route::post('/master-documentation-applicant', [ApiDocumentationController::class, 'master_documentation_applicant'])->name('api-master-documentation');
    Route::post('/master-bodyselection-applicant', [ApiBodySelectionController::class, 'master_bodyselection_applicant'])->name('api-master-bodyselection');
    Route::post('/master-aptitude-applicant', [ApiAptitudeController::class, 'master_aptitude_applicant'])->name('api-master-aptitude');
    Route::post('/master-basicfitness-applicant', [ApiBasicFitnessController::class, 'master_basicfitness_applicant'])->name('api-master-basicfitness');
    // Route::post('/master-outdoorleader-applicant', [ApiOutDoorLeaderlessController::class, 'master_outdoorleader_applicant'])->name('api-master-outdoorleaderless');
    // Route::post('/master-medicals-applicant', [ApiMedicalsController::class, 'master_medicals_applicant'])->name('api-master-medicals');
    // Route::post('/master-vetting-applicant', [ApiVettingController::class, 'master_vetting_applicant'])->name('api-master-vettings');
    Route::post('/master-interview-applicant', [ApiInterviewController::class, 'master_interview_applicant'])->name('api-master-interview');
});
Route::prefix('api')->group(function () {
    Route::post('/api-main-report', [ReportController::class, 'applicant_reports_table'])->name('generate-applicant-report');
    Route::post('/api-applicant-correction', [PreviewApplicantController::class, 'applicant_master_preview_data'])->name('generate-applicant-correction');
});
Route::prefix('user-logs-activities')->group(function () {
    Route::post('/api-user-logs-activities', [UserLogActivitiesController::class, 'index'])->name('api-user-logs-activities');
    Route::post('/api-audit-logs', [UserAuditTrailActivitiesController::class, 'index'])->name('api-audit-logs');
});
