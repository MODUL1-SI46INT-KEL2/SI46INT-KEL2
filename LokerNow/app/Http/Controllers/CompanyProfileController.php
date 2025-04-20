<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit($id)
    {
        // Fetch the company profile based on the id
        $companyProfile = CompanyProfile::findOrFail($id);

        // Pass the company profile to the edit view
        return view('company_profile.edit', compact('companyProfile'));
    }

    // You can also add a store or update method if you need to handle saving the changes
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
        ]);

        // Find the company profile and update it
        $companyProfile = CompanyProfile::findOrFail($id);
        $companyProfile->update($validatedData);

        // Redirect or show success message
        return redirect()->route('dashboard')->with('success', 'Company profile updated successfully');
    }
}
