<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load('workExperiences', 'documents');
        return view('profile.show', compact('user'));
    }

    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'company_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('photos', 'public');
        }
        unset($data['photo']);

        $user->update($data);
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    public function storeExperience(Request $request)
    {
        $data = $request->validate([
            'position' => 'required|string|max:255',
            'workplace' => 'required|string|max:255',
            'period' => 'nullable|string|max:100',
        ]);
        $request->user()->workExperiences()->create($data);
        return back()->with('success', 'Pengalaman kerja ditambahkan.');
    }

    public function destroyExperience(Request $request, $id)
    {
        $request->user()->workExperiences()->findOrFail($id)->delete();
        return back()->with('success', 'Pengalaman kerja dihapus.');
    }

    public function storeDocument(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);
        $path = $request->file('file')->store('documents', 'public');
        $request->user()->documents()->create([
            'name' => $request->name,
            'file_path' => $path,
        ]);
        return back()->with('success', 'Dokumen ditambahkan.');
    }

    public function destroyDocument(Request $request, $id)
    {
        $doc = $request->user()->documents()->findOrFail($id);
        Storage::disk('public')->delete($doc->file_path);
        $doc->delete();
        return back()->with('success', 'Dokumen dihapus.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}