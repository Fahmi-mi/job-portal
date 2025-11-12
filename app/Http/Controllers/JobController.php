<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobVacancy::latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        JobVacancy::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'logo' => $logoPath
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function edit(JobVacancy $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, JobVacancy $job)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = $job->logo;
        if ($request->hasFile('logo')) {
            if ($job->logo) {
                Storage::disk('public')->delete($job->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'logo' => $logoPath
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil diupdate');
    }

    public function destroy(JobVacancy $job)
    {
        if ($job->logo) {
            Storage::disk('public')->delete($job->logo);
        }
        
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil dihapus');
    }
}
