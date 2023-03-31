<?php

namespace App\Jobs;

use App\Models\Settings;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $required_hours=Settings::value('required_hours');
        $students=Student::where('total_completed_hours','=',$required_hours)->get();
        foreach ($students as $student) {
            Student::where('id','=',$student->id)
            ->update(['status' => 'grad']);
        }
    }
}
