<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function ShowHome()
    {
        if (auth()->check()) {
            return view('admin.home');
        }
        return view('welcome');
    }

    function ShowFileManager()
    {

        return view('admin.file-manager.file-manager');
    }

    function ShowMunicipality(Request $request)
    {
        $type = $request->query('type');
        $category = $request->query('category') ?? null;
        if (!$type) {
            abort(404);
        }
        return view('admin.file-manager.municipality', compact('type', 'category'));
    }

    function ShowLandTitlesOrPatentedLots(Request $request)
    {

        $type = $request->query('type');
        if (!$type) {
            abort(404);
        }
        return view('admin.file-manager.land-title-categories', compact('type'));
    }

    function ShowTable(Request $request)
    {
        $type = $request->query('type');
        $municipality = $request->query('municipality') ?? null;
        $category = $request->query('category') ?? null;
        if (!$type || !$municipality) {
            abort(404);
        }
        return view('admin.file-manager.table', compact('type', 'municipality', 'category'));
    }
    function ShowFolder(Request $request)
    {
        $type = $request->query('type');
        $municipality = $request->query('municipality') ?? null;
        $category = $request->query('category') ?? null;
        $folderId = $request->query('folderId') ?? null;
        if (!$type || !$municipality) {
            abort(404);
        }
        return view('admin.file-manager.folders', compact('type', 'municipality', 'category', 'folderId'));
    }
    function ShowAdministrativeDocuments()
    {

        return view('admin.administrative.administrative-documents');
    }

    function ShowRecord(Request $request)
    {
        $record = $request->query('record');
        // if (!$record) {
        //     abort(404);
        // }
        return view('admin.administrative.records', compact('record'));
    }

    function ShowArchivedFiles()
    {
        return view('admin.archived-file.archive-type');
    }

    function ShowArchivedFileManager()
    {
        $archivedType = "File Manager";
        return view('admin.archived-file.file-manager', compact('archivedType'));
    }
    function ShowArchivedMunicipality(Request $request)
    {
        $archivedType = "File Manager";
        $type = $request->query('type');
        $category = $request->query('category') ?? null;
        if (!$type) {
            abort(404);
        }
        return view('admin.archived-file.municipality', compact('archivedType', 'type', 'category'));
    }

    function ShowArchivedandTitlesOrPatentedLots(Request $request)
    {
        $archivedType = "File Manager";
        $type = $request->query('type');
        if (!$type) {
            abort(404);
        }
        return view('admin.archived-file.land-title-categories', compact('archivedType', 'type'));
    }

    function ShowArchivedFileManagerTable(Request $request)
    {
        $type = $request->query('type');
        $municipality = $request->query('municipality');
        $archivedType = "File Manager";
        return view('admin.archived-file.table', compact('archivedType', 'type', 'municipality'));
    }


    function ShowArchivedAdministrativeDocument(Request $request)
    {
        $archivedType = "Administrative Document";
        return view('admin.archived-file.administrative-documents', compact('archivedType'));
    }

    function ShowArchivedAdministrativeDocumentRecord(Request $request)
    {
        $archivedType = "Administrative Document";
        $record = $request->query('record');
        return view('admin.archived-file.records', compact('archivedType', 'record'));
    }

    function ShowBackupAndRecover()
    {
        return view('backup.backup');
    }

    function ShowSetting()
    {
        return view("settings");
    }

    function ShowQR()
    {
        return view('admin.scanQr');
    }

    function ShowQrRedirect()
    {
        return view('admin.qr-redirect');
    }
}
