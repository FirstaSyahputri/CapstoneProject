<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StatusLamaranController extends Controller
{
    public function update(Request $request, Application $application)
    {
        $data = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'viewed',
                    'review',
                    'interview',
                ]),
            ],

            'interview_date' => [
                'nullable',
                'required_if:status,interview',
                'date',
            ],
            'interview_time' => [
                'nullable',
                'required_if:status,interview',
                'date_format:H:i',
            ],
            'interview_location' => [
                'nullable',
                'required_if:status,interview',
                'string',
                'max:255',
            ],
        ]);

        $application->status = $data['status'];

        if ($data['status'] === 'interview') {
            $application->interview_date = $data['interview_date'];
            $application->interview_time = $data['interview_time'];
            $application->interview_location = $data['interview_location'];
        } else {
            $application->interview_date = null;
            $application->interview_time = null;
            $application->interview_location = null;
        }

        $application->save();

        return redirect()
            ->route('recruiter.pelamar.show', $application)
            ->with('success', 'Status lamaran berhasil diperbarui.');
    }
}