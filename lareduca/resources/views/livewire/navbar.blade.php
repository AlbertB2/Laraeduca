<div class="navbarDiv bg-gray-200 backdrop-blur-md rounded-lg fixed flex justify-between items-center w-80% h-16 px-4 py-2">
    <img src="laraeducaLogoColor.png" class="laraeducaLogo h-full">
    <div class="navigationMenu flex gap-8 items-center">
        <h3><a href="/home" class="navigationLinks">Home</a></h3>
        <h3><a href="/dashboard" class="navigationLinks">Dashboard</a></h3>
        <h3><a href="/roles" class="navigationLinks">Roles</a></h3>
        @if ($userLoged->id_role == 1)
            <h3><a href="/admin" class="navigationLinks">Admin</a></h3>
        @endif
        <h3><a href="/games" class="navigationLinks">Games</a></h3>
        <a class="logoutButton font-bold text-white bg-red-600 px-4 py-2 rounded shadow transition duration-500"
            href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>