<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class File extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_files';

    protected $fillable = [
        'file_folder_id',
        'original_filename',
        'storage_filename',
        'mime_type',
        'file_extension',
        'size',
        'disk',
        'path',
        'is_pre_upload',
        'user_id',
        'token',
        'updated_at',
        'created_at',
        'download_url',
        'file_icon',
        'format_size_units',
        'original_filename_with_file_extension',
        'type',
    ];
}