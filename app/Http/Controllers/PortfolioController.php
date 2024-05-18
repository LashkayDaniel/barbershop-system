<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userPortfolioImages = $user->portfolio()->get(['id', 'url', 'created_at']);
        $avatar = $user->avatar;
        $description = $user->description ?? '';

        return Inertia::render('Employee/Portfolio/Index', [
            'galleryImages' => $userPortfolioImages,
            'avatar' => $avatar == null ? $avatar : Storage::url($avatar),
            'description' => $description,
        ]);
    }

    private function uniqueHash(int $id, string $salt = 'employee'): string
    {
        return substr(sha1($id . $salt), -10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = $image->hashName();

        $userId = Auth::id();
        $uniqueHashFolderName = $this->uniqueHash($userId);

        $imageSrc = $image->storeAs('images/portfolio/' . $uniqueHashFolderName, $imageName, 'public');

        $portfolio = new Portfolio();
        $portfolio->user_id = $userId;
        $portfolio->url = Storage::url($imageSrc);
        $portfolio->save();

        return redirect()->route('portfolio.index')->with(
            [
                'message' => 'Зображення успішно завантажено!',
                'type' => 'success',
            ]
        );
    }

    public function avatarUpload(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        $avatar = $request->file('avatar');
        $userId = Auth::id();
        $uniqueHashFolderName = $this->uniqueHash($userId);
        $folderPath = 'images/portfolio/' . $uniqueHashFolderName;

        $avatarSrc = $avatar->storeAs($folderPath, 'avatar.' . $avatar->getClientOriginalExtension(), 'public');

        $user = Auth::user();
        $user->avatar = $avatarSrc;
        $user->save();

        return redirect()->route('portfolio.index')->with(
            [
                'message' => 'Аватарку успішно змінено!',
            ]
        );
    }

    public function storeDescription(Request $request)
    {
        $request->validate([
            'text' => 'required|min:10|max:320',
        ]);

        $user = Auth::user();
        $user->description = $request->text;
        $user->save();

        return redirect()->route('portfolio.index')->with(
            [
                'message' => 'Опис успішно змінено!',
            ]
        );
    }

    public function destroy(Portfolio $portfolio)
    {
        $imageUrl = str_replace('/storage', '', $portfolio->url);
        if (!Storage::disk('public')->exists($imageUrl)) {
            return redirect()->route('portfolio.index')->with(
                [
                    'message' => 'Не вдалося знайти зображення! Спробуйте ще раз',
                    'type' => 'error',
                ]
            );
        }

        Storage::disk('public')->delete($imageUrl);
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with(
            [
                'message' => 'Зображення успішно видалено',
                'type' => 'success',
            ]
        );
    }
}
