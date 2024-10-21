<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function download(Request $request)
    {
        $originalFilename = $request->query('original');

        $remove_storage_prefix = str_replace('private/', '', $originalFilename);

        if (!Storage::exists($remove_storage_prefix)) {
            abort(404);
        }

        return Storage::download($remove_storage_prefix, 'report-' . now()->format('Y-m-d') . '.csv');
    }
}
