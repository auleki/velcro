<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\User;
use Validator,Redirect,Response,File;
use Intervention\Image\Exception\NotReadableException;
use Storage;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    

    public function render()
    {

       
		// dd($allfiles);
		
        $this->files = User::whereNotIn('id', [1])->paginate(10);

        if($this->search !== ' ' || is_null($this->search))
        {
            $this->files = User::whereNotIn('id', [1])
            ->where('fname', 'like', '%' . $this->search . '%')
            ->Orwhere('lname', 'like', '%' . $this->search . '%')
            ->latest()->paginate(10);
        }


        return view('livewire.users',[

        	'users' => $this->files,

        ]);

        // return view('livewire.user');
    }
}
