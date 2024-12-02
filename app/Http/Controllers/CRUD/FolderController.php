<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    //
    public function AddFolder(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'folder_name' => 'required|string|max:255',
            'folder_type' => 'required|string|max:255',
            'folder_municipality' => 'nullable|string|max:255',
            'parent_folder_id' => 'nullable|exists:folders,id', // Ensure parent folder exists
            'is_archive' => 'nullable|boolean',
        ]);

        // Create a new folder
        $folder = new Folder();
        $folder->folder_name = $request->folder_name;
        $folder->folder_type = $request->folder_type;
        $folder->municipality = $request->folder_municipality ?? null;

        // If no parent folder ID, explicitly set it to null
        $folder->parent_folder_id = $request->parent_folder_id ? $request->parent_folder_id : null;

        $folder->is_archive = $request->is_archive ?? false;
        $folder->save();

        // Return success response
        return response()->json([
            'message' => 'Folder created successfully',
            'folder' => $folder
        ], 201);
    }



    public function GetFolders(Request $request)
    {
        try {
            $folders = Folder::where('folder_type', $request->query('folderType'))
                ->where('municipality', $request->query('municipality'))
                ->where('parent_folder_id', $request->query('folderId')) // Fetch subfolders of the clicked folder
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Folders fetched successfully.',
                'folders' => $folders,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
