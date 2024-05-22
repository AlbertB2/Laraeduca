<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Users;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $user, $alumnsCourse=[];

    public function render()
    {
        $userLoged = Auth::user();
        $courses = "";
        // dd($userLoged->currentTeam);
        if ($userLoged->id_role == 1) {
            $courses = Course::where('teacher_id', $userLoged->id)->get();
            // dd($courses);
        } else {
            $courses = Course::where('teacher_id', 21)->get();
        }
        
        // dd($user->id);

        return view('livewire.dashboard', ['userLoged' => $userLoged, 'courses' => $courses]);    
    }   

    public function showAlumns($courseId)
    {
        // Retrieve enrollments for the clicked course
        $enrollments = CourseEnrollment::where('course_id', $courseId)->get();

        // Extract user IDs from enrollments
        $userIds = $enrollments->pluck('user_id')->toArray();

        // Fetch users corresponding to these IDs
        $this->alumnsCourse = User::whereIn('id', $userIds)->get();

        // Pass the list of users to the view
        // $this->emit('alumnsFetched', $alumns);
        // dd($alumns);
    }

}
