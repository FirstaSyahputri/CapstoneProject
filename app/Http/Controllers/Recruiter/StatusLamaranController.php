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
        // Aturan dasar untuk perubahan status.
        $rules = [
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'viewed',
                    'review',
                    'interview',
                ]),
            ],
        ];

        // Jadwal hanya divalidasi jika form interview mengirimkan
        // data jadwal.
        $hasInterviewSchedule = $request->has('interview_date')
            || $request->has('interview_start_time')
            || $request->has('interview_end_time')
            || $request->has('interview_location')
            || $request->has('meeting_type');

        if ($request->status === 'interview' && $hasInterviewSchedule) {
            $rules = array_merge($rules, [
                'interview_date' => [
                    'required',
                    'date',
                    'after_or_equal:today',
                ],

                'interview_start_time' => [
                    'required',
                    'date_format:H:i',
                ],

                'interview_end_time' => [
                    'required',
                    'date_format:H:i',
                    'after:interview_start_time',
                ],

                'meeting_type' => [
                    'required',
                    Rule::in(['offline', 'online']),
                ],

                'interview_location' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'interview_notes' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],
            ]);
        }

        $data = $request->validate($rules);

        // Simpan status.
        $application->status = $data['status'];

        if ($data['status'] === 'interview') {

            if ($hasInterviewSchedule) {
                // Simpan jadwal interview.
                $application->interview_date = $data['interview_date'];
                $application->interview_start_time = $data['interview_start_time'];
                $application->interview_end_time = $data['interview_end_time'];

                // Kolom lama tetap disinkronkan dengan waktu mulai.
                $application->interview_time = $data['interview_start_time'];

                $application->meeting_type = $data['meeting_type'];
                $application->interview_location = $data['interview_location'];
                $application->interview_notes = $data['interview_notes'] ?? null;

                $application->save();

                return redirect()
                    ->route('recruiter.pelamar.show', $application)
                    ->with('success', 'Status dan jadwal wawancara berhasil disimpan.');
            }

            $application->save();

            return redirect()
                ->route('recruiter.pelamar.show', $application)
                ->with('success', 'Status berhasil diubah. Silakan lengkapi jadwal wawancara.')
                ->with('open_interview_modal', true);
        }

        $application->interview_date = null;
        $application->interview_time = null;
        $application->interview_start_time = null;
        $application->interview_end_time = null;
        $application->meeting_type = null;
        $application->interview_location = null;
        $application->interview_notes = null;

        $application->save();

        return redirect()
            ->route('recruiter.pelamar.show', $application)
            ->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
