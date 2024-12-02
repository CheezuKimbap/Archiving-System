<?php
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
Route::get('/forgot-password', function () {
    return view('auth.forgot-password.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'SendPassResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'ShowResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'Reset'])->name('password.update');
Route::get('/register', [AuthController::class, 'ShowRegistrationForm'])->name('register.show');
Route::post('/store-account', [AuthController::class, 'StoreAccount'])->name('user.post');
Route::get('/login', [AuthController::class, 'ShowLogin'])->name('login.show');
Route::post('/login/auth', [AuthController::class, 'Authenticate'])->name('login.post');
Route::get('/verify', [AuthController::class, 'ShowVerification'])->name('verification.show');
Route::post('/verify/account', [AuthController::class, 'VerifyEmail'])->name('verify.email.post');
Route::get('/logout', [AuthController::class, 'Logout'])->name('logout.post');

Route::get('/', [AdminController::class, 'ShowHome'])->name('admin.home.show');

Route::middleware([VerifiedUser::class])->group(function () {
    Route::get('/storage-usage', [StorageController::class, 'GetStorageUsage'])->name('admin.storage.usage');

    Route::get('/scan/qrcode', [AdminController::class, 'ShowQR'])->name('show.qr');

    Route::prefix('file-manager')->name('file-manager.')->middleware([CheckQueryParameter::class])->group(function () {
        Route::get('/', [AdminController::class, 'ShowFileManager'])->name('show');
        Route::get('/municipality', [AdminController::class, 'ShowMunicipality'])->name('municipality.show');
        Route::get('/categories', [AdminController::class, 'ShowLandTitlesOrPatentedLots'])->name('land-title.show');
        Route::get('/repository', [AdminController::class, 'ShowTable'])->name('table.show');
        Route::get('repository/folder/{folderId}', [AdminController::class, 'ShowFolder'])->name('folder.show');
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

    //Store File
    Route::get("/api/files", [FileManagerController::class, 'GetFiles'])->name('file.getAll');
    Route::post('/api/files/update/{id}', [FileManagerController::class, 'UpdateFileById'])->name('file.update');
    Route::get("/api/files/{id}", [FileManagerController::class, "GetFileById"])->name("file.get");
    Route::get('/api/files/download/{id}', [FileController::class, 'DownloadFileById'])->name('file.download');
    Route::get('/api/files/view/{id}', [FileController::class, 'ViewFileById']);
    Route::post('/api/files/archived/{id}', [ArchiveController::class, 'ArchivedById'])->name('file.archived');
    //edit delete detail function
    Route::delete('/api/delete/details/{id}', [FileManagerController::class, "DeletePermitSpecification"])->name('delete.permit.detail');

    Route::get('/api/municipalities', [MunicipalityController::class, 'GetMunicipalities']);//currently not use!
    Route::get('/api/file-types', [FileManagerController::class, 'GetFileTypeByClassification']);

    Route::post('/api/files/move/{id}', [UploadController::class, "MoveFileById"]);


    Route::get('/superuser/test', function () {
        return view("superuser.test");
    });


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



    Route::post('/api/config', [SettingController::class, 'UpdateConfig']);
    Route::get('api/getconfig/', [SettingController::class, 'GetConfig']);


    Route::get('/setting', [AdminController::class, 'ShowSetting'])->name("show.setting");

    Route::get('/api/notifications', [NotificationController::class, 'getNotifications']); // Get all notifications for a user

    Route::get('/api/folders', [FolderController::class, 'GetFolders']);
    Route::post('/api/folders/add', [FolderController::class, 'AddFolder']);

    Route::get('/qr-validation/{id}', [AdminController::class, 'ShowQrRedirect'])->name('show.qr-validation');
    Route::get('/qr-validation-invalid', function () {
        return view('admin.qr-redirect-invalid');
    });
});

