<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Candidates\DashboardController as CandidatesDashboardController;
use App\Http\Controllers\Candidates\SettingsController as CandidatesSettingsController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\Employer\SettingController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\EducationController;
use App\Http\Controllers\Superadmin\EmployerController;
use App\Http\Controllers\Superadmin\ExperienceController;
use App\Http\Controllers\Superadmin\IndustryTypeController;
use App\Http\Controllers\Superadmin\JobCategoryController;
use App\Http\Controllers\Superadmin\JobPostController;
use App\Http\Controllers\Superadmin\JobRoleController;
use App\Http\Controllers\Superadmin\LanguageController;
use App\Http\Controllers\Superadmin\OrganizationTypeController;
use App\Http\Controllers\Superadmin\ProfessionController;
use App\Http\Controllers\Superadmin\ProfileController;
use App\Http\Controllers\Superadmin\SalaryTypeController;
use App\Http\Controllers\Superadmin\SkillsController;
use App\Http\Controllers\Superadmin\TagController;
use App\Http\Controllers\Superadmin\TeamSizeController;
use App\Models\IndustryType;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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


// terms & conditions
Route::get('/terms-conditions', function () {
    return;
})->name('terms-conditions');

Route::get('/', function () {
    return Redirect::route('login');
});


// SUPERADMIN ROUTE
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {

        // dashboard
        Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

        // Profile Controller

        Route::get('/profile', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::post('/profile/update-password', [ProfileController::class, 'update_password'])->name('profile.update_password');

        // Company Controller Route
        Route::get('/employer', [EmployerController::class, 'employers'])->name('admin.employers');
        Route::get('/employer-add', [EmployerController::class, 'create'])->name('admin.employer.create');
        Route::post('/employer-store', [EmployerController::class, 'store'])->name('admin.employer.store');

        Route::get('/employer-edit/{employer}', [EmployerController::class, 'edit'])->name('admin.employer.edit');
        Route::post('/employer-update/{employer?}', [EmployerController::class, 'update'])->name('admin.employer.update');

        Route::get('/employer-delete/{employer}', [EmployerController::class, 'delete'])->name('admin.employer.delete');

        Route::get('/employer-account-status-update/{id}', [EmployerController::class, 'employerAccountStatusUpdate'])->name('admin.employer.employerAccountStatusUpdate');

        // JOB POST CONTROLLER ROUTE
        Route::get('/jobs', [JobPostController::class, 'jobPost'])->name('admin.jobPost');
        Route::get('/job-view/{jobPost}', [JobPostController::class, 'view'])->name('admin.jobPost.view');

        Route::get('/job-add', [JobPostController::class, 'create'])->name('admin.jobPost.create');
        Route::post('/job-store', [JobPostController::class, 'store'])->name('admin.jobPost.store');

        Route::get('/job-edit/{jobPost?}', [JobPostController::class, 'edit'])->name('admin.jobPost.edit');
        Route::post('/job-update/{jobPost?}', [JobPostController::class, 'update'])->name('admin.jobPost.update');

        Route::get('/job-delete/{jobPost?}', [JobPostController::class, 'delete'])->name('admin.jobPost.delete');

        Route::get('/job-status/{id?}', [JobPostController::class, 'jobPostStatusUpdate'])->name('admin.jobPost.status');


        // JOB CATEGORY CONTROLLER ROUTE
        Route::get('/job-category', [JobCategoryController::class, 'jobCategory'])->name('admin.jobCategory');

        Route::post('/job-category-store', [JobCategoryController::class, 'store'])->name('admin.jobCategory.store');

        Route::get('job-category-edit/{jobCategory_id}', [JobCategoryController::class, 'editJobCategory'])->name('admin.jobCategory.edit');

        Route::post('/job-category-update/{jobCategory?}', [JobCategoryController::class, 'update'])->name('admin.jobCategory.update');

        Route::get('/job-category-delete/{jobCategory}', [JobCategoryController::class, 'delete'])->name('admin.jobCategory.delete');

        Route::get('/job-category-status/{jobCategory}', [JobCategoryController::class, 'jobCategoryStatusUpdate'])->name('admin.jobCategory.status');



        // JOB ROLE CONTROLLER ROUTE
        Route::get('/job-roles', [JobRoleController::class, 'jobRole'])->name('admin.jobRole');

        Route::post('/job-role-store', [JobRoleController::class, 'store'])->name('admin.jobRole.store');

        Route::get('job-role-edit/{jobRole_id}', [JobRoleController::class, 'editJobRole'])->name('admin.editJobRole.edit');

        Route::post('/job-role-update/{jobRole?}', [JobRoleController::class, 'update'])->name('admin.jobRole.update');

        Route::get('/job-role-delete/{jobRole}', [JobRoleController::class, 'delete'])->name('admin.jobRole.delete');

        Route::get('/job-role-status/{jobRole}', [JobRoleController::class, 'jobRoleStatusUpdate'])->name('admin.jobRole.status');


        // JOB SKILLS CONTROLLER ROUTE
        Route::get('/skill', [SkillsController::class, 'skills'])->name('admin.skills');

        Route::post('/skill-store', [SkillsController::class, 'store'])->name('admin.skill.store');

        Route::get('job-skill-edit/{skill_id}', [SkillsController::class, 'editSkill'])->name('admin.skill.edit');

        Route::post('/skill-update/{skill?}', [SkillsController::class, 'update'])->name('admin.skill.update');

        Route::get('/skill-delete/{skill}', [SkillsController::class, 'delete'])->name('admin.skill.delete');

        Route::get('/skill-status/{skill}', [SkillsController::class, 'skillStatusUpdate'])->name('admin.skill.status');



        // JOB TAGS CONTROLLER ROUTE
        Route::get('/tag', [TagController::class, 'tags'])->name('admin.tags');

        Route::post('/tag-store', [TagController::class, 'store'])->name('admin.tag.store');

        Route::get('tag-edit/{tag_id}', [TagController::class, 'editTag'])->name('admin.skill.edit');

        Route::post('/tag-update/{tag?}', [TagController::class, 'update'])->name('admin.tag.update');

        Route::get('/tag-delete/{tag}', [TagController::class, 'delete'])->name('admin.tag.delete');

        Route::get('/tag-status/{tag}', [TagController::class, 'tagStatusUpdate'])->name('admin.tag.status');




        // Industry Type CONTROLLER ROUTE
        Route::get('/industry-type', [IndustryTypeController::class, 'industryType'])->name('admin.industryTypes');

        Route::post('/industry-type-store', [IndustryTypeController::class, 'store'])->name('admin.industryType.store');

        Route::get('industry-type-edit/{industryType_id}', [IndustryTypeController::class, 'editIndustryType'])->name('admin.industryType.edit');

        Route::post('/industry-type-update/{industryType?}', [IndustryTypeController::class, 'update'])->name('admin.industryType.update');

        Route::get('/industry-type-delete/{industryType}', [IndustryTypeController::class, 'delete'])->name('admin.industryType.delete');

        Route::get('/industry-type-status/{industryType}', [IndustryTypeController::class, 'industryTypesStatusUpdate'])->name('admin.industryType.status');


        // Profession CONTROLLER ROUTE
        Route::get('/profession', [ProfessionController::class, 'professions'])->name('admin.professions');

        Route::post('/profession-store', [ProfessionController::class, 'store'])->name('admin.profession.store');

        Route::get('profession-edit/{profession_id}', [ProfessionController::class, 'edit'])->name('admin.profession.edit');

        Route::post('/profession-update/{profession?}', [ProfessionController::class, 'update'])->name('admin.profession.update');

        Route::get('/profession-delete/{profession}', [ProfessionController::class, 'delete'])->name('admin.profession.delete');

        Route::get('/profession-status/{profession}', [ProfessionController::class, 'professionStatusUpdate'])->name('admin.profession.status');



        // LANGUAGE CONTROLLER ROUTE
        Route::get('/language', [LanguageController::class, 'language'])->name('admin.language');

        Route::post('/language-store', [LanguageController::class, 'store'])->name('admin.language.store');

        Route::get('language-edit/{language_id}', [LanguageController::class, 'edit'])->name('admin.language.edit');

        Route::post('/language-update/{language?}', [LanguageController::class, 'update'])->name('admin.language.update');

        Route::get('/language-delete/{language}', [LanguageController::class, 'delete'])->name('admin.language.delete');

        Route::get('/language-status/{language}', [LanguageController::class, 'statusUpdate'])->name('admin.language.status');



        // EDUCATION CONTROLLER ROUTE
        Route::get('/education', [EducationController::class, 'educations'])->name('admin.educations');

        Route::post('/education-store', [EducationController::class, 'store'])->name('admin.education.store');

        Route::get('education-edit/{education_id}', [EducationController::class, 'edit'])->name('admin.education.edit');

        Route::post('/education-update/{education?}', [EducationController::class, 'update'])->name('admin.education.update');

        Route::get('/education-delete/{education}', [EducationController::class, 'delete'])->name('admin.education.delete');

        Route::get('/education-status/{education}', [EducationController::class, 'statusUpdate'])->name('admin.education.status');



        // Experience CONTROLLER ROUTE
        Route::get('/experience', [ExperienceController::class, 'experience'])->name('admin.experiences');

        Route::post('/experience-store', [ExperienceController::class, 'store'])->name('admin.experience.store');

        Route::get('experience-edit/{experience_id}', [ExperienceController::class, 'edit'])->name('admin.experience.edit');

        Route::post('/experience-update/{experience?}', [ExperienceController::class, 'update'])->name('admin.experience.update');

        Route::get('/experience-delete/{experience}', [ExperienceController::class, 'delete'])->name('admin.experience.delete');

        Route::get('/experience-status/{experience}', [ExperienceController::class, 'statusUpdate'])->name('admin.experience.status');


        // OrganizationType CONTROLLER ROUTE
        Route::get('/organization-type', [OrganizationTypeController::class, 'organizationType'])->name('admin.organizationTypes');

        Route::post('/organization-type-store', [OrganizationTypeController::class, 'store'])->name('admin.organizationType.store');

        Route::get('organization-type-edit/{organizationType_id}', [OrganizationTypeController::class, 'edit'])->name('admin.organizationType.edit');

        Route::post('/organization-type-update/{organizationType?}', [OrganizationTypeController::class, 'update'])->name('admin.organizationType.update');

        Route::get('/organization-type-delete/{organizationType}', [OrganizationTypeController::class, 'delete'])->name('admin.organizationType.delete');

        Route::get('/organization-type-status/{organizationType}', [OrganizationTypeController::class, 'statusUpdate'])->name('admin.organizationType.status');



        // SalaryType CONTROLLER ROUTE
        Route::get('/salary-type', [SalaryTypeController::class, 'salaryType'])->name('admin.salaryTypes');

        Route::post('/salary-type-store', [SalaryTypeController::class, 'store'])->name('admin.salaryType.store');

        Route::get('salary-type-edit/{salaryType_id}', [SalaryTypeController::class, 'edit'])->name('admin.salaryType.edit');

        Route::post('/salary-type-update/{salaryType?}', [SalaryTypeController::class, 'update'])->name('admin.salaryType.update');

        Route::get('/salary-type-delete/{salaryType}', [SalaryTypeController::class, 'delete'])->name('admin.salaryType.delete');

        Route::get('/salary-type-status/{salaryType}', [SalaryTypeController::class, 'statusUpdate'])->name('admin.salaryType.status');


        // Team Size CONTROLLER ROUTE
        Route::get('/team-size', [TeamSizeController::class, 'teamSize'])->name('admin.teamSize');

        Route::post('/team-size-store', [TeamSizeController::class, 'store'])->name('admin.teamSize.store');

        Route::get('team-size-edit/{teamSize_id}', [TeamSizeController::class, 'edit'])->name('admin.teamSize.edit');

        Route::post('/team-size-update/{teamSize?}', [TeamSizeController::class, 'update'])->name('admin.teamSize.update');

        Route::get('/team-size-delete/{teamSize}', [TeamSizeController::class, 'delete'])->name('admin.teamSize.delete');

        Route::get('/team-size-status/{teamSize}', [TeamSizeController::class, 'statusUpdate'])->name('admin.teamSize.status');



        // CANDIDATE CONTROLLER ROUTE

        Route::get('/candidates', [CandidateController::class, 'candidates'])->name('admin.candidates');
        Route::get('/candidate-add', [CandidateController::class, 'create'])->name('admin.candidate.create');

        Route::post('/candidate-store', [CandidateController::class, 'store'])->name('admin.candidate.store');

        Route::get('/candidate-view/{candidate_id}', [CandidateController::class, 'view'])->name('admin.candidate.view');

        Route::get('/candidate-edit/{candidate}', [CandidateController::class, 'edit'])->name('admin.candidate.edit');

        Route::post('/candidate-update/{candidate}', [CandidateController::class, 'update'])->name('admin.candidate.update');

        Route::get('/candidate-account-status/{candidate}', [CandidateController::class, 'candidateAccountStatusUpdate'])->name('admin.candidate.accountStatus');

        Route::get('/candidate-delete/{candidate}', [CandidateController::class, 'delete'])->name('admin.candidate.delete');
    });   // CLOSUP Prefix

});


// EMPLOYER ROUTE
Route::middleware(['employer'])->group(function () {
    Route::prefix('employer')->group(function () {

        // dashboard
        Route::get('/dashboard', EmployerDashboardController::class)->name('employer.dashboard');

        // Setting Controller
        Route::get('/verification-form', [SettingController::class, 'employerverificationForm'])->name('employer.employerverificationForm');

        Route::get('/profile', [SettingController::class, 'profilePreview'])->name('employer.profilePreview');

        Route::get('/settings', [SettingController::class, 'settings'])->name('employer.settings');

        Route::post('/company-info/{id?}', [SettingController::class, 'companyInfo'])->name('employer.companyInfo');

        Route::post('/founding-info/{id?}', [SettingController::class, 'foundingInfo'])->name('employer.foundingInfo');

        Route::post('/social-media-profile/{id?}', [SettingController::class, 'socialMediaProfile'])->name('employer.socialMediaProfile');

        Route::post('/account-setting/{id?}', [SettingController::class, 'accountsetting'])->name('employer.accountsetting');

        Route::post('/update-password', [SettingController::class, 'updatePassword'])->name('employer.updatePassword');

        //



    }); // CLOSUP Prefix
});


// CANDIDATE ROUTE

Route::middleware(['candidate'])->group(function () {
    Route::prefix('candidate')->group(function () {

        // dashboard
        Route::get('/dashboard', CandidatesDashboardController::class)->name('candidate.dashboard');

        Route::get('/profile', [CandidatesSettingsController::class, 'candidateProfilePreview'])->name('candidate.profilePreview');

        // Profile Controller
        Route::get('/settings', [CandidatesSettingsController::class, 'settings'])->name('candidate.settings');

        Route::post('/basic-info/{id?}', [CandidatesSettingsController::class, 'candidateBasicDetails'])->name('candidate.basicDetails');

        Route::post('/profile-info/{id?}', [CandidatesSettingsController::class, 'candidateProfileDetails'])->name('candidate.profileInfo');

        Route::post('/social-media-profile/{id?}', [CandidatesSettingsController::class, 'candidateSocialMeadiaDetails'])->name('candidate.socialMediaProfile');

        Route::post('/account-setting/{id?}', [CandidatesSettingsController::class, 'candidateAccountsetting'])->name('candidate.accountsetting');

        Route::post('/update-password', [CandidatesSettingsController::class, 'updatePassword'])->name('candidate.updatePassword');
    });   // CLOSUP Prefix

});











require __DIR__ . '/auth.php';
