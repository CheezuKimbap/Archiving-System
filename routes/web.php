<?php
use App\Http\Controllers\Admin\PermitTypeController;
use App\Http\Controllers\ChartingController;
use App\Http\Controllers\CRUD\ButterflyController;
use App\Http\Middleware\VerifiedUser;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CRUD\ArchiveController;
use App\Http\Controllers\CRUD\FileManagerController;
use App\Http\Controllers\CRUD\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MunicipalityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FileSharing\FileShareController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\API\StaffController;
use App\Http\Controllers\Backup\BackupController;
use App\Http\Controllers\CRUD\SettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CRUD\FolderController;
use App\Http\Middleware\CheckQueryParameter;
use App\Http\Controllers\CRUD\TreeController;
Route::get('/forgot-password', function () {
    return view('auth.forgot-password.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'SendPassResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'ShowResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'ResetPassword'])->name('password.update');
Route::get('/register', [AuthController::class, 'ShowRegistrationForm'])->name('register.show');
Route::post('/store-account', [AuthController::class, 'StoreAccount'])->name('user.post');
Route::get('/login', [AuthController::class, 'ShowLogin'])->name('login.show');
Route::post('/login/auth', [AuthController::class, 'Authenticate'])->name('login.post');
Route::get('/verify', [AuthController::class, 'ShowVerification'])->name('verification.show');
Route::post('/verify/account', [AuthController::class, 'VerifyEmail'])->name('verify.email.post');
Route::get('/logout', [AuthController::class, 'Logout'])->name('logout.post');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');

Route::get('/', [AdminController::class, 'ShowHome'])->name('admin.home.show');

Route::middleware([VerifiedUser::class])->group(function () {


    Route::get('/storage-usage', [StorageController::class, 'GetStorageUsage'])->name('admin.storage.usage');

    Route::get('/scan/qrcode', [AdminController::class, 'ShowQR'])->name('show.qr');

    Route::prefix('file-manager')->name('file-manager.')->middleware([CheckQueryParameter::class])->group(function () {
        Route::get('/', [AdminController::class, 'ShowFileManager'])->name('show');
        Route::get('/municipality', [AdminController::class, 'ShowMunicipality'])->name('municipality.show');
        Route::get('/categories', [AdminController::class, 'ShowLandTitlesOrPatentedLots'])->name('land-title.show');
        Route::get('/repository', [AdminController::class, 'ShowTable'])->name('table.show');
        Route::get('/chainsaw-categories', [AdminController::class, 'ShowChainsawCategories'])->name('chainsaw-categories.show');
    });

    Route::prefix('administrative-document')->name('administrative.')->middleware([CheckQueryParameter::class])->group(function () {
        Route::get('/', [AdminController::class, "ShowAdministrativeDocuments"])->name('show');
        Route::get('/repository', [AdminController::class, 'ShowRecord'])->name('record.show');
    });

    Route::prefix('archive-file')->name('archived-file.')->middleware([CheckQueryParameter::class])->group(function () {
        Route::get('/', [AdminController::class, 'ShowArchivedFiles'])->name('show');

        Route::prefix('file-manager')->name('file-manager.')->group(function () {
            Route::get('/', [AdminController::class, 'ShowArchivedFileManager'])->name('show');
            Route::get('/municipality', [AdminController::class, 'ShowArchivedMunicipality'])->name('municipality.show');
            Route::get('/categories', [AdminController::class, 'ShowArchivedandTitlesOrPatentedLots'])->name('land-title.show');
            Route::get('/repository', [AdminController::class, 'ShowArchivedFileManagerTable'])->name('table.show');
            Route::get('/chainsaw-categories', [AdminController::class, 'ShowArchivedChainsawCategories'])->name('chainsaw-categories.show');
        });

        Route::prefix('administrative-document')->name('administrative.')->group(function () {
            Route::get('/', [AdminController::class, "ShowArchivedAdministrativeDocument"])->name('show');
            Route::get('/repository', [AdminController::class, 'ShowArchivedAdministrativeDocumentRecord'])->name('record.show');
        });
    });
    //API HANDLER 
    Route::post('/file-upload', [UploadController::class, 'StoreFile'])->name('file.post');
    Route::post('/permit-upload', [FileManagerController::class, 'StorePermit'])->name('permit.post');
    // Route::post('/api/file-upload', [FileController::class, 'StoreFileNoRelation']);
    Route::get('/api/butterflies/search', [ButterflyController::class, 'search']);
    //Store File
    Route::get("/api/files", [FileManagerController::class, 'GetFiles'])->name('file.getAll');
    Route::post('/api/files/update/{id}', [FileManagerController::class, 'UpdateFileById'])->name('file.update');
    Route::get("/api/files/{id}", [FileManagerController::class, "GetFileById"])->name("file.get");
    Route::get('/api/files/download/{id}', [FileController::class, 'DownloadFileById'])->name('file.download');
    Route::get('/api/files/view/{id}', [FileController::class, 'ViewFileById']);
    Route::post('/api/files/archived/{id}', [ArchiveController::class, 'ArchivedById'])->name('file.archived');
    Route::post('/api/files/unarchived/{id}', [ArchiveController::class, 'UnarchivedById'])->name('file.unarchived');
    
    //edit delete detail function
    Route::delete('/api/delete/details/{id}', [FileManagerController::class, "DeletePermitSpecification"])->name('delete.permit.detail');

    Route::get('/api/municipalities', [MunicipalityController::class, 'GetMunicipalities']);//currently not use!
    Route::get('/api/file-types', [FileManagerController::class, 'GetFileTypeByClassification']);

    Route::post('/api/files/move/{id}', [UploadController::class, "MoveFileById"]);
    Route::post('/api/files/rename/{id}', [UploadController::class, 'RenameFileById'])->name('file.rename');
    Route::get('/superuser/test', function () {
        return view("superuser.test");
    });
    Route::get("/client/records", function () {
        return view('admin.client.client-records');
    })->name('client.records.show');

    Route::get('/api/getAreaChart', [StorageController::class, 'GetAreaChartData']);
    //Home Page
    Route::get('/recent-uploads', [StorageController::class, 'getRecentUploads']);
    Route::get('/files/count', [StorageController::class, 'countFilesByExtension']);
    //
    Route::post('/api/files/share', [FileShareController::class, 'ShareFile']);

    Route::post('/api/files/request/{id}', [FileShareController::class, 'StoreRequest']);
    Route::get('/api/files/GET/request-access', [FileShareController::class, 'GetFileAccessRequests']);

    //Left behind
    Route::patch('/api/files/request-access/{id}', [FileShareController::class, 'UpdateRequestStatus']);

    Route::get('/api/users/', [StaffController::class, 'GetEmployees']);

    Route::get('/file-request', function () {
        return view('admin.file-request.table');
    })->name(("ShowFileRequest"));

    //backup

    Route::get("/backup-and-recovery", [AdminController::class, 'ShowBackupAndRecover'])->name('ShowBackupAndRecovery');

    //Api for backup and recovery

    Route::post('/api/files/backup', [BackupController::class, "Backup"]);
    Route::post('/api/files/restore', [BackupController::class, "Restore"]);
    Route::get('/api/list-backups', [BackupController::class, "listBackups"]);

    Route::get('/api/sharewithme', [FileShareController::class, 'GetSharedFilesById']);

    Route::post('/api/config', [SettingController::class, 'UpdateConfig']);
    Route::get('api/getconfig/', [SettingController::class, 'GetConfig']);


    Route::get('/setting', [AdminController::class, 'ShowSetting'])->name("show.setting");

    Route::get('/api/notifications', [NotificationController::class, 'getNotifications']); // Get all notifications for a user



    Route::get('/qr-validation/{id}', [AdminController::class, 'ShowQrRedirect'])->name('show.qr-validation');
    Route::get('/qr-validation-invalid', function () {
        return view('admin.qr-redirect-invalid');
    });

    Route::get('/file-history/{fileId}', [AdminController::class, 'ShowFileHistory'])->name('file-history.show');
    Route::get('/api/history', [FileManagerController::class, "GetFileHistoryById"]);

    Route::get('/file-shared-with-me', function () {
        return view('admin.file-shared');
    })->name('shared-with-me');

    Route::get('/qr-validation/file-summary/{file_id}', [AdminController::class, 'ShowFileSummary'])->name('qr.file-summary');

    Route::get('/api/ltp/destination', [ChartingController::class, 'getDistinctLocalTransportDestinations']);
    Route::get('/api/permit/type', [PermitTypeController::class, 'GetPermitTypes']);
    Route::get('/files/filter', [FileManagerController::class, 'GetFileAndPermits']);


    Route::get('/butterfly', [AdminController::class, 'ShowButterflyList'])->name('butterfly.show');
    Route::post('/butterfly/add', [ButterflyController::class, 'AddSpecies']);

    Route::get('show/edit/maintenance/{speciesType}/{id}', [AdminController::class, 'ShowMaintenanceEdit'])->name('maintenance.edit');
    Route::get('/species/edit/{id}', [ButterflyController::class, 'GetSpeciesById'])->name('butterfly.edit');

    Route::delete('/delete/butterfly/species/{id}', [ButterflyController::class, 'DeleteSpeciesById']);
    //   Route::put('/butterfly/edit/{$id}', [AdminController::clas, 'Show'])
    Route::post('/api/files/{fileId}/butterfly-details', [ButterflyController::class, 'AddButterflyDetails']);
    Route::get('/api/files/{fileId}/butterflies', [ButterflyController::class, 'GetButterflyDetails']);
    Route::post('/api/file/sync-butterflies/{fileId}', [ButterflyController::class, 'syncButterflyDetails'])->name('butterflies.sync');
    Route::get('/maintenance/ltp', [AdminController::class, 'ShowMaintenance'])->name('show.maintenance');
    Route::post('/update/species/{id}', [ButterflyController::class, 'UpdateSpeciesById'])->name('update.species');

    Route::get('/maintenance/{speciesType}/table', [AdminController::class, 'ShowMaintenanceTable'])->name('show.maintenance.table');
    Route::get('/show/species/ltp', [ButterflyController::class, 'GetAllSpecies'])->name('getAllSpecies');
    Route::post('/api/tree-species/add', [TreeController::class, 'AddTreeSpecies'])->name('tree.species.add');
    Route::get('/api/tree-species', [TreeController::class, 'getAllTreeSpecies'])->name('tree.species.show');
    Route::get('/api/tree-species/{id}', [TreeController::class, 'getTreeSpeciesById'])->name('tree.species.get');
    Route::post('/api/tree-species/update/{id}', [TreeController::class, 'updateTreeSpecies'])->name('tree.species.update');
    Route::delete('/api/tree-species/{id}', [TreeController::class, 'deleteTreeSpecies'])->name('tree.species.delete');
    //Charting 
    Route::get('/api/permit-statistics', [ChartingController::class, 'permitStatistics']);

    //TCS
    Route::get('/api/tree-cutting-statistics', [ChartingController::class, 'GetTreeCuttingStatistics']);
    Route::get('/api/tree-cutting-species-statistics', [ChartingController::class, 'GetTreeCuttingSpeciesChartData']);
    Route::get('/api/tree-cutting-category-statistics', [ChartingController::class, 'GetTreeCuttingByCategory']);

    //Chainsaw
    Route::get('/api/chainsaw-registration-statistics', [ChartingController::class, 'GetChainsawRegistrationStatistics']);
    Route::get('/api/chainsaw-registration-statistics-by-category', [ChartingController::class, 'getChainsawRegistrationStatisticsByCategory']);

    Route::get('/api/tree-plantation-statistics', [ChartingController::class, 'GetTreePlantationStatistics']);

    Route::get('/api/tree-transport-permit-statistics', [ChartingController::class, 'GetTreeTransportStatistics']);
    // Route::get('/api/tree-transport-permit-statistics', [ChartingController::class, 'GetTreeTransportPermitStatistics']);
    Route::get('/api/tree-species-transported-statistics', [ChartingController::class, 'GetTreeSpeciesTransportedStatistics']);
    // Route::get('/api/tree-transport-species-statistics', [ChartingController::class, 'GetTreeTransportSpeciesChartData']);
    Route::get('/api/tree-transport-species-statistics', [ChartingController::class, 'GetTreeTransportSpeciesStatistics']);

    Route::get('/api/land-statistics', [ChartingController::class, 'GetLandTitleChartData']);

    Route::get('/api/local-transport-statistics', [ChartingController::class, 'GetLocalTransportPermitChartData']);

    // Charting routes for Local Transport Permits
    Route::get('/api/transport-permits-by-municipality', [ChartingController::class, 'getTransportPermitsByMunicipality']);
    Route::get('/api/species-transported-by-municipality', [ChartingController::class, 'getSpeciesTransportedByMunicipality']);
    Route::get('/api/business-owners-by-municipality', [ChartingController::class, 'getBusinessOwnersByMunicipality']);
    Route::get('/api/species-transported-download', [ChartingController::class, 'downloadSpeciesTransportedReport']);

    // Charting route for Land Title Statistics
    Route::get('/api/land-title-statistics', [ChartingController::class, 'GetLandTitleStatistics']);

    Route::get('/reports', [AdminController::class, 'ShowReports'])->name('report.show');

    Route::get('/report/tree-cutting-permit', [AdminController::class, 'ShowTreeCuttingReport'])->name('report-tcp.show');
    Route::get('/report/tree-plantation-permit', [AdminController::class, 'ShowTreePlantationReport'])->name('report-tpp.show');
    Route::get('/report/transport-permit', [AdminController::class, 'ShowTransportPermitReport'])->name('report-tp.show');
    Route::get('/report/chainsaw-registration', [AdminController::class, 'ShowChainsawRegistrationReport'])->name('report-cr.show');
    Route::get('/report/land-titles', [AdminController::class, 'ShowLandTitlesReport'])->name('report-tcp.lt');
    Route::get('/report/local-transport-permit', [AdminController::class, 'ShowLocalTransportPermitReport'])->name('report-ltp.show');

    Route::get('/report/local-transport-permits/chart', [ChartingController::class, 'getTransportPermitChartData']);

    Route::get('/api/butterfly-species', [ButterflyController::class, 'GetAllSpecies']);

    Route::get('/api/tree-transport-species', [ChartingController::class, 'getDistinctTreeSpecies']);
    Route::get('/api/distinct-tree-species', [ChartingController::class, 'getDistinctTreePlantationSpecies']);
});

