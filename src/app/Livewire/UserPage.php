<?php

namespace App\Livewire;

use App\Models\DocumentPermition;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserPage extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::paginate(5);
        $permitions = DocumentPermition::all();

        return view('livewire.user-page', [
            'permitions' => $permitions,
            'users'=> $users,
        ]);
    }

}
