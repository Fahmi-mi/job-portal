<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $jobId = null)
    {
        $query = Application::with('user', 'job');
        
        if ($jobId) {
            // Show applications for a specific job
            $query->where('job_id', $jobId);
        } else {
            // If user is not admin, only show their own applications
            if (auth()->user()->role !== 'admin') {
                $query->where('user_id', auth()->id());
            }
        }
        
        $applications = $query->get();
        
        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        Application::create([
            'user_id' => auth()->id(),
            'job_id'  => $jobId,
            'cv'      => $cvPath,
        ]);

        return back()->with('success', 'Lamaran berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        // Check if user is admin or if the application belongs to the current user
        if (auth()->user()->role !== 'admin' && $application->user_id !== auth()->id()) {
            abort(403, 'Unauthorized to view this application');
        }
        
        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        // Only admin can update application status
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized to update this application');
        }
        
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected'
        ]);
        
        $application->update([
            'status' => $request->status
        ]);
        
        return back()->with('success', 'Status lamaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    /**
     * Export applications to Excel.
     */
    public function export()
    {
        return Excel::download(new ApplicationsExport, 'applications.xlsx');
    }
}
