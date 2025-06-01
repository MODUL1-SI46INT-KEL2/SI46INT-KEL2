<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobInsight;

class JobInsightController extends Controller
{
    // Menampilkan semua insight, 6 per halaman
    public function index()
    {
        $insights = JobInsight::latest()->paginate(6);
        return view('jobseeker.job_insight.index', compact('insights'));
    }

    // Menampilkan detail satu insight
    public function show($id)
    {
        $insight = JobInsight::findOrFail($id);
        return view('jobseeker.job_insight.show', compact('insight'));
    }

    public function salary()
{
    return view('jobseeker.job_insight.salary');
}

public function industry()
{
    return view('jobseeker.job_insight.industry');
}

public function careerpath()
{
    return view('jobseeker.job_insight.careerpath');
}

}
