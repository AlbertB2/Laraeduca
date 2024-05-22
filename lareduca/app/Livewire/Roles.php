<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;



class Roles extends Component
{
    public $selectedTutor, $selectedRole, $selectedUser, $userRole;
    public function render()
    {
        $courses = Course::all();
        $usersAdmin = User::where('id_role', 1)->get();
        $users = User::all();
        $userLoged = Auth::user();

        return view('livewire.roles', ['courses' => $courses, 'roleofUser' => $this->userRole,'usersAdmin' => $usersAdmin, 'users' => $users, 'userLoged' => $userLoged]);
    }


    public function changeTutor($courseId)
    {
        if ($this->selectedTutor != "") {
            $course = Course::find($courseId);
            $course->teacher_id = $this->selectedTutor;
            $course->save();
            $this->selectedTutor = "";
        } else {
        }
    }

    public function changeRole()
    {
        if ($this->selectedUser != "") {
            if ($this->selectedRole != "") {
                $user = User::find($this->selectedUser);
                $user->id_role = $this->selectedRole;
                $user->save();
            } else {
                dd('selected role buit');
            }
        } else {
            dd('selected user buit');
        }
    }
    public function seeRole()
    {
        if ($this->selectedUser != "") {
                $user = User::find($this->selectedUser);
                if ($user->id_role == 1) {
                    $this->userRole = "Teacher";
                } else {
                    $this->userRole = "Student";
                }
                
        } else {
            dd('selected user buit');
        }
    }
}
