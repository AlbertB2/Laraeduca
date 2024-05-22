<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Flasher\Toastr\Prime\ToastrInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Admin extends Component
{
    public $selectedRole = 1, $users, $courses, $usersAlumn, $selectedCourse, $enrollments, $finalUsers, $addUsers, $newAlumnId, $newAlumnStatus;
    public function render()
    {
        $this->users = User::all();
        $this->courses = Course::all();
        $this->usersAlumn = User::where('id_role', 0)->get();
        $this->enrollments = CourseEnrollment::all();
        // $this->selectedCourse = Course::get()->first();
        $userLoged = Auth::user();
        return view('livewire.admin', ['selectedRole' => $this->selectedRole, 'userLoged' => $userLoged]);
    }

    public function changeCourse()
    {
        $i = 0;
        $e = 0;
        $this->addUsers = [];
        $this->finalUsers = [];

        $enrolledUserIds = $this->enrollments
            ->where('course_id', $this->selectedCourse)
            ->pluck('user_id')
            ->toArray();

        foreach ($this->users as $user) {
            if (in_array($user->id, $enrolledUserIds)) {
                $this->finalUsers[] = $user;
            } else {
                if ($user->id_role == 0) {
                    $this->addUsers[] = $user;
                } else {
                }
                // Usuarios no inscritos
            }
        }
    }

    public function addAlumn()
    {
        if ($this->newAlumnId != null) {
            if ($this->newAlumnStatus != null) {
                $enrollment = new CourseEnrollment();
                $enrollment->user_id = $this->newAlumnId;
                $enrollment->course_id = $this->selectedCourse;
                $enrollment->enrollment_date = Carbon::now();
                $enrollment->status = $this->newAlumnStatus;
                $enrollment->save();
                
                $this->newAlumnId = "";
                $this->selectedCourse = "";
                $this->newAlumnStatus = "";
            }
            else{
                toastr()->error('No has redactado un status.');
            }
        }
        else{
            toastr()->error('No has escojido un Alumno.');

        }

        $this->changeCourse();
    }

    public function deleteFromClass($alumnId){
        $selectedEnrollment = CourseEnrollment::where('course_id', $this->selectedCourse)
        ->where('user_id', $alumnId)
        ->delete();

        $this->newAlumnId = "";
        $this->selectedCourse = "";
        $this->newAlumnStatus = "";
    }
}
