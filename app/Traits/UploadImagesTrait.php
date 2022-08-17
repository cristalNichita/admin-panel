<?php

namespace App\Traits;

trait UploadImagesTrait
{
    public function uploadImage($request) {
        $fileName = time().'_'.$request->image->getClientOriginalName();

        $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

        return $filePath;
    }

    public function uploadImages($request) {

    }
}
