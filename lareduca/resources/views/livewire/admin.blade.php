<div class="mainContentDashboard">
    @livewire('navbar')
    <div class="contentAdmin">
        <div class="divSelect">
            <select class="selectCourse" wire:model="selectedCourse" wire:change="changeCourse">
                <option value="">Select Course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="fullDashboard">
            <div class="alumnsDiv">
                @if ($selectedCourse != '')
                <div class="addAlumnDiv">
                    <div class="divNewAlumn">
                        <select class="divNewAlign" wire:model="newAlumnId">
                            <option value="">Add alumn</option>
                            @foreach ($addUsers as $user)
                                <option value={{ $user->id }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="divNewAlumn">
                        <select type="text" maxlength="20" minlength="3" class="divNewAlign" wire:model="newAlumnStatus">
                        <option value="">Alumn Status</option>
                        <option value="Active">Active</option>
                        <option value="Non Active">Non Active</option>
                    </select>
                    </div>
                    <button wire:click="addAlumn" class="submitNewAlumn">+</button>
                </div>
                    @if ($finalUsers != null)
                        
    
                        @foreach ($finalUsers as $user)
                            <div class="divAlumn">
                                <div class="divAlign">
                                    <img class="alumnPicture" src="../student.svg" alt="">
                                    <h1>{{ $user->name }}</h1>
                                    <h2>{{ $user->email }}</h2>
                                    @php
                                        $birthdate = $user->birthdate;
                                        $age = date('Y') - date('Y', strtotime($birthdate));
                                        if (date('md') < date('md', strtotime($birthdate))) {
                                            $age--;
                                        }
                                    @endphp
                                    <h2>{{ $age }} years old</h2>
                                    <button class="deleteAlumnClass" wire:click="deleteFromClass({{$user->id}})">Delete From Class</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1>No hay Usuarios en esta classe</h1>
                    @endif
                @else
                    <h1>No has seleccionado ningun curso</h1>
                @endif
            </div>
        </div>
        <div class="createCourse">
            <h2>Create New Department</h2>
            <div class="inputsNewCourse">
                <input type="text" class="inputCourse" placeholder="Department Title" max="20" min="3"
                    wire:model="newCourseTitle">
                <textarea type="" class="inputCourse textarea" placeholder="Enter a Description" wire:model="newCourseDescription"></textarea>
                <select class="inputCourse" wire:model="newCourseTutor">
                    <option value="">Choose a Tutor</option>
                    @foreach ($usersAdmin as $user)
                        <option value={{ $user->id }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button wire:click="addDepartment" class="newCourseButt">+</button>
        </div>
    </div>
</div>

