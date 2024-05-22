<div class="mainContentDashboard">
    @livewire('navbar')
    <div class="divSelect">
        <select class="selectType" wire:model="selectedRole" wire:change="changeInfo">
            <option value="1">Users</option>
            <option value="0">Courses</option>
        </select>
    </div>
    <div class="fullDashboard">
        <div class="personalInfo">
            @if ($selectedRole == 1)
                <div class="alumnsList">
                    @foreach ($users as $alumn)
                        <div class="alumnDiv">
                            <div class="fullInf">
                                @if ($alumn->id_role == 1)
                                    <img class="alumnPicture" src="../teacher.svg" alt="">
                                @else
                                    <img class="alumnPicture" src="../student.svg" alt="">
                                @endif
                                <div class="alumnInfo">
                                    <h1>{{ $alumn->name }}</h1>
                                    <h2>{{ $alumn->email }}</h2>
                                    @php
                                        $birthdate = $alumn->birthdate;
                                        $age = date('Y') - date('Y', strtotime($birthdate));
                                        if (date('md') < date('md', strtotime($birthdate))) {
                                            $age--;
                                        }
                                    @endphp
                                    <h2>{{ $age }} years old</h2>
                                    @if ($alumn->id_role == 1)
                                        <h2>Teacher</h2>
                                    @else
                                        <h2>Student</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    @else
        <div class="alumnsList">
            @if ($userLoged->id_role == 1)
                <div class="createCourse">
                    <h2>Create New course</h2>
                    <div class="inputsNewCourse">
                        <input type="text" class="inputCourse" placeholder="Course Title" max="20" min="3"
                            wire:model="newCourseTitle">
                        <textarea type="" class="inputCourse textarea" placeholder="Enter a Description" wire:model="newCourseDescription"></textarea>
                        <select class="inputCourse" wire:model="newCourseTutor">
                            <option value="">Choose a Tutor</option>
                            @foreach ($usersAdmin as $user)
                                <option value={{ $user->id }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <select class="inputCourse" wire:model="newCourseDepartment">
                            <option value="">Choose a Department</option>
                            @foreach ($departments as $department)
                                <option value={{ $department->id }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click="addCourse" class="newCourseButt">+</button>
                </div>
            @else
            @endif
            @foreach ($courses as $course)
                <div class="coursesDiv">
                    <div class="fullInf">
                        <img class="coursePicture" src="../assignment2.svg" alt="">
                        <div class="alumnInfo">
                            <h1>{{ $course->title }}</h1>
                            <h2>{{ $course->description }}</h2>
                            <button class="deleteCourse" wire:click="deleteCourse({{$course->id}})">Delete Course</button>
                        </div>
                        <div class="tutorInfo">
                            <h1>Tutor Information</h1>
                            @foreach ($usersAdmin as $user)
                                @if ($user->id == $course->teacher_id)
                                    <h2>{{ $user->name }}</h2>
                                    <h2>{{ $user->email }}</h2>
                                    <h2>{{ $user->birthdate }}</h2>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
</div>
</div>
