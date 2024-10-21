<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function download(Request $request)
    {
        $originalFilename = $request->query('original');

        if (!Storage::exists($originalFilename)) {
            abort(404);
        }

        return Storage::download($originalFilename, 'report-' . now()->format('Y-m-d') . '.csv');
    }
}
