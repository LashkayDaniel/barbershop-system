<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PageDataController extends Controller
{
    public function index()
    {
        $pageData = PageData::query()->first()->get(['address', 'logo', 'schedule', 'gallery', 'socials']);
        return Inertia::render('Admin/Landing/Index', [
            'pageData' => $pageData,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'required|min:5',
            'address' => 'required|min:5',
            'schedule' => 'required|min:5',
            'socials' => 'required|min:5',
        ]);

        \Log::info($request);

        $pageData = PageData::query()->firstOrCreate();
        $pageData->logo = $request->logo;
        $pageData->address = $request->address;
        $pageData->schedule = $request->schedule;
        $pageData->socials = $request->socials;
        $pageData->save();

        return redirect()->route('landing.index')->with(
            [
                'message' => 'Landing info successfully updated!',
                'type' => 'success',
            ]
        );
    }

    private function updateImageListInDb()
    {
        $allImages = Storage::files('public/images/gallery');
        $imagesUrl = array_map(function ($image) {
            return Storage::url($image);
        }, $allImages);

        $pageData = PageData::query()->firstOrCreate();
        $pageData->gallery = json_encode($imagesUrl);
        $pageData->save();
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = $image->hashName();
        $image->storeAs('images/gallery', $imageName, 'public');

        $this->updateImageListInDb();

        return redirect()->route('landing.index')->with(
            [
                'message' => 'Image was uploaded successfully',
                'type' => 'success',
            ]
        );
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'image_name' => 'required|min:10',
        ]);

        $imagePath = 'images/gallery/' . $request->image_name;

        if (!Storage::disk('public')->exists($imagePath)) {
            return redirect()->route('landing.index')->with(
                [
                    'message' => 'Image was not founded! Try again',
                    'type' => 'error',
                ]
            );
        }

        Storage::disk('public')->delete($imagePath);
        $this->updateImageListInDb();

        return redirect()->route('landing.index')->with(
            [
                'message' => 'Image was deleted successfully',
                'type' => 'success',
            ]
        );
    }
}
