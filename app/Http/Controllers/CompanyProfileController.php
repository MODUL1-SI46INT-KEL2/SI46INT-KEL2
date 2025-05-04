<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('company_profiles.edit', [
            'companyProfile' => $user->companyProfile,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'tagline' => 'nullable|string|max:255',
        ]);

        $companyProfile = $user->companyProfile ?: new CompanyProfile();

        if ($request->hasFile('logo')) {
            if ($companyProfile->logo_path) {
                Storage::delete($companyProfile->logo_path);
            }
            $companyProfile->logo_path = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($companyProfile->banner_path) {
                Storage::delete($companyProfile->banner_path);
            }
            $companyProfile->banner_path = $request->file('banner')->store('banners', 'public');
        }

        $companyProfile->tagline = $request->input('tagline');
        $companyProfile->save();

        if (!$user->company_profile_id) {
            $user->company_profile_id = $companyProfile->id;
            $user->save();
        }

        return redirect()->route('company-profiles.edit')->with('status', 'Company profile updated.');
    }
}

