<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AuditionImageController extends Controller
{
    //
    public function audition(Request $request)
    {
        if (!auth()->check()) {
            abort(403);
        }
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,bmp|max:5120',
        ]);

        $file = $request->file('file');

        $fileName = now()->format('ymd') . '_' . Str::random(20) . '.' . $file->extension();

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->scaleDown(width: 800);

        $directory = storage_path('app/public/tmp');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $savePath = $directory . '/' . $fileName;
        $image->save($savePath);

        return response()->json([
            'link' => asset('storage/tmp/' . $fileName),
        ]);
    }
    public function promotion(Request $request)
    {
        if (!auth()->check()) {
            abort(403);
        }
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,bmp|max:5120',
        ]);

        $file = $request->file('file');

        $fileName = now()->format('ymd') . '_' . Str::random(20) . '.' . $file->extension();

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->scaleDown(width: 800);

        $directory = storage_path('app/public/tmp');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $savePath = $directory . '/' . $fileName;
        $image->save($savePath);

        return response()->json([
            'link' => asset('storage/tmp/' . $fileName),
        ]);
    }
}
