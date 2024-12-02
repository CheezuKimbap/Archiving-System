<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'folder_path',
        'folder_type',
        'municipality',
        'is_archive',
        'parent_folder_id', // Include this field in the fillable array
    ];

    // Relationship: A folder belongs to a parent folder
    public function parentFolder()
    {
        return $this->belongsTo(Folder::class, 'parent_folder_id');
    }

    // Relationship: A folder has many child folders
    public function childFolders()
    {
        return $this->hasMany(Folder::class, 'parent_folder_id');
    }
}
