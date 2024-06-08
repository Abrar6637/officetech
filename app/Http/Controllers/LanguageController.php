<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function getLanguageFile($locale)
    {
        $filePath = resource_path("lang/$locale/translation.php");
        // return response()->json($filePath);

        if (File::exists($filePath)) {
            $content = include($filePath);
            if (is_array($content)) {
                return response()->json($content);
            } else {
                return response()->json(['error' => 'Invalid language file format'], 500);
            }
        }

        return response()->json(['error' => 'Language file not found'], 404);
    }
}
