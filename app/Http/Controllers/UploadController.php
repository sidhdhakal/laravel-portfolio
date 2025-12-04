<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate input
        $request->validate([
            'image' => 'required|image'
        ]);

        // Upload file to S3
        $path = $request->file('image')->store('uploads', 's3');

        // Make it public
        Storage::disk('s3')->setVisibility($path, 'public');

        // Get the URL
        $url = Storage::disk('s3')->url($path);

        return response()->json(['url' => $url]);
    }
}
