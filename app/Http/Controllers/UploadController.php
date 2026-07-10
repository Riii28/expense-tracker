<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $req)
    {
        $file = $req->file('picture');
        $file->storePubliclyAs('pictures', $file->getClientOriginalName(), 'public');
        return 'OK: ' . 'storage/pictures/' . $file->getClientOriginalName();
    }
}
