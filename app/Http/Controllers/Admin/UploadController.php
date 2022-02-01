<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload($data = [])
    {
        if (in_array('new_name', $data)) {
            $new_name = $data['new_name'] === null ? time() : $data['new_name'];
        }

        if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {
            !empty($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
            return request()->file($data['file'])->store($data['path']);
        }
    }
}
