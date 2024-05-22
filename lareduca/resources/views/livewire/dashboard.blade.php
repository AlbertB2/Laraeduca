<div class="mainContentDashboard">
    @livewire('navbar')
    <div class="fullDashboard">
        <div class="personalInfo">
            <div class="contentDiv">
                @if ($userLoged->id_role == 1)
                    <img class="profileImg" src="../teacher.svg" alt="">
                @else
                    <img class="profileImg" src="../student.svg" alt="">
                @endif
                <div class="profileInfo">
                    <h2>{{ $userLoged->name }}</h2>
                    <h2>{{ $userLoged->email }}</h2>
                    <h2>
                        @if ($userLoged->id_role == 1)
                            {{ 'Professor/a' }}
                        @else
                            {{ 'Student' }}
                        @endif
                    </h2>
                    <h2>{{ $userLoged->birthdate }}</h2>
                </div>
            </div>
            <div class="coursesDiv">
                <div class="coursesList">
                    @if ($courses->isNotEmpty())
                    @foreach ($courses as $course)
                        <div class="courseDiv" wire:click="showAlumns({{ $course->id }})">
                            <h3>{{ $course->title }}</h3>
                            <p>{{ $course->description }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No courses found.</p>
                @endif
                </div>
                
            </div>
        </div>

        <div class="courseInfo">
            <div class="alumnsList">
                @foreach ($alumnsCourse as $alumnCourse)
                    <div class="alumnDiv">
                        <div class="fullInf">
                            <img class="alumnPicture" src="../student.svg" alt="">
                            <div class="alumnInfo">
                                <h1>{{ $alumnCourse->name }}</h1>
                                <h2>{{ $alumnCourse->email }}</h2>
                                @php
                                    $birthdate = $alumnCourse->birthdate;
                                    $age = date('Y') - date('Y', strtotime($birthdate));
                                    if (date('md') < date('md', strtotime($birthdate))) {
                                        $age--;
                                    }
                                @endphp
                                <h2>{{ $age }} years old</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
