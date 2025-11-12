<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Application::with('user', 'job')->get()->map(function ($application) {
            return [
                'user_name' => $application->user->name,
                'job_title' => $application->job->title,
                'cv' => $application->cv,
                'status' => $application->status,
                'created_at' => $application->created_at,
            ];
        });
    }
    
    public function headings(): array
    {
        return [
            'Nama Pelamar',
            'Lowongan',
            'CV',
            'Status',
            'Tanggal Daftar',
        ];
    }
}