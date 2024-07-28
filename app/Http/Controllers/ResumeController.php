<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function download($filename)
    {
        // Path to the file in the local disk
        $path = storage_path('app/resumes/' . $filename);

        if (!Storage::disk('local')->exists('resumes/' . $filename)) {
            abort(404, 'File not found.');
        }

        return response()->download($path);
    }
}
