<div class="mainContentDashboard">
    @livewire('navbar')
    <div class="fullDashboard">
        <div class="coursesDiv">
            @foreach ($courses as $course)
                @php
                    $imagesPath = public_path('imagesStock'); // Path to your images directory
                    $images = File::files($imagesPath); // Get an array of image file paths
                    $randomImage = $images[array_rand($images)]; // Select a random image from the array
                    $randomImageFilename = basename($randomImage);
                @endphp

                <div class="course" style="background-image: url('{{ asset('imagesStock/' . $randomImageFilename) }}');">
                    <img src="../assignment2.svg" alt="">
                    <div class="courseInfo">
                        <h1>{{ $course->title }}</h1>
                        <h2>{{ $course->description }}</h2>
                    </div>
                    <div class="courseTutorInfo">
                        @if ($userLoged->id_role == 1)
                            <select class="selectTutor" wire:model="selectedTutor"
                                wire:change="changeTutor({{ $course->id }})">
                                <option wire:defer="selectedTutor" value="">Choose a new Tutor</option>
                                @foreach ($usersAdmin as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        @endif
                        @foreach ($usersAdmin as $user)
                            @if ($user->id == $course->teacher_id)
                                <h2>{{ $user->name }}</h2>
                                <h2>{{ $user->email }}</h2>
                                <h2>{{ $user->birthdate }}</h2>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @if ($userLoged->id_role == 1)
            <div class="divChangeRole">
                <label for="">Select a user to change the role.</label>
                <div class="selectsDiv">
                    <select class="selectUser" wire:model="selectedUser">
                        <option wire:defer="selectedUser" value="">Choose a User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select class="selectedRole" wire:model="selectedRole" wire:change="changeRole">
                        <option value="">Choose a new Role</option>
                        <option value="0">Student</option>
                        <option value="1">Teacher</option>
                    </select>
                </div>
            </div>
        @else
            <div class="divChangeRole">
                <label for="">Select a user to see the role.</label>
                <div class="selectsDiv">
                    <select class="selectUser" wire:model="selectedUser" wire:change="seeRole">
                        <option wire:defer="selectedUser" value="">Choose a User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                </div>
                <h3 wire:defer="roleofUser">{{ $userRole }}</h3>
            </div>
        @endif
    </div>
</div>
