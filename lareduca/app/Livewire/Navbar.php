<?php

namespace App\Livewire;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public function render() {
        $userLogedNav = Auth::user();
        
        return view('livewire.navbar', ['userLoged' => $userLogedNav]);    
    }

    public function logout(Request $request){
        $request->session()->forget('key');
    }
}
