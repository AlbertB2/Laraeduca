<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;


class Home extends Component
{
    public $selectedRole = 1, $users, $courses, $usersAdmin, $departments;
    public $newCourseDepartment, $newCourseTutor, $newCourseTitle, $newCourseDescription;

    public function render()
    {
        $this->users = User::all();
        $this->courses = Course::all();
        $this->usersAdmin = User::where('id_role', 1)->get();
        $this->departments = Department::all();
        $userLoged = Auth::user();
        return view('livewire.home', ['selectedRole' => $this->selectedRole, 'userLoged' => $userLoged]);
    }

    public function changeInfo()
    {
        // Implement your logic here based on the selected role
        if ($this->selectedRole == 1) {
            $this->selectedRole = 1;
            // $this->courses = "";
        } elseif ($this->selectedRole == 0) {
            $this->selectedRole = 0;
            // $this->users = "";
        }
    }

    public function addCourse()
    {
        if ($this->newCourseTitle != null) {
            $existingCourse = Course::where('title', $this->newCourseTitle)->first();
            if ($existingCourse) {
                toastr()->error('El título del curso ya está en uso.');
            } else {
                if ($this->newCourseTutor != null) {
                    if ($this->newCourseDepartment != null) {
                        if ($this->newCourseDescription != null) {
                            $course = new Course();
                            $course->title = $this->newCourseTitle;
                            $course->description = $this->newCourseDescription;
                            $course->teacher_id = $this->newCourseTutor;
                            $course->department_id = $this->newCourseDepartment;
                            $course->save();
        
                            // Limpiar los campos después de la creación del curso
                            $this->newCourseTitle = "";
                            $this->newCourseDescription = "";
                            $this->newCourseTutor = "";
                            $this->newCourseDepartment = "";
                        } else {
                            toastr()->error('No has redactado una descripción.');}
                    } else {
                        toastr()->error('No has escogido un Departamento.');}
                } else {
                    toastr()->error('No has escogido un Tutor.');}
            }
        } else {
            toastr()->error('No has redactado un Título.');
        }
        
    }

    public function deleteCourse($courseId){
        $selectedCourse = Course::where('id', $courseId)->delete();
        
        $this->newCourseTitle = "";
        $this->newCourseDescription = "";
        $this->newCourseTutor = "";
        $this->newCourseDepartment = "";
    }
}
