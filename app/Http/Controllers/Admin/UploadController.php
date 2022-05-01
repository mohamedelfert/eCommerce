<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload($data = [])
    {
        if (in_array('new_name', $data)) {
            $new_name = $data['new_name'] === null ? time() : $data['new_name'];
        }

        if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {
//            Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
            !empty($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
            return request()->file($data['file'])->store($data['path']);
        } elseif (request()->hasFile($data['file']) && $data['upload_type'] == 'files') {
            $file = request()->file($data['file']);

            $name = $file->getClientOriginalName();
            $size = $file->getSize();
            $hashName = $file->hashName();
            $mimeType = $file->getMimeType();

            $file->store($data['path']);
            $add = File::create([
                'name' => $name,
                'size' => $size,
                'file' => $hashName,
                'path' => $data['path'],
                'full_path' => $data['path'] . '/' . $hashName,
                'mime_type' => $mimeType,
                'file_type' => $data['file_type'],
                'relation_id' => $data['relation_id'],
            ]);

            return $add->id;
        }
    }

    public function delete($id)
    {
        $file = File::find($id);
        if (!empty($file)) {
            Storage::delete($file->full_path);
            $file->delete();
        }
    }

    public function deleteFiles($product_id)
    {
        $files = File::where('file_type', 'product')->where('relation_id', $product_id)->get();
        if (count($files) > 0) {
            foreach ($files as $file) {
                $file = File::find($file->id);
                Storage::delete($file->full_path);
                Storage::deleteDirectory($file->path);
                $file->delete();
            }
        }
    }
}
