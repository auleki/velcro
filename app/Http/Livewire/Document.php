<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Efile;
use Validator,Redirect,Response,File;
use Intervention\Image\Exception\NotReadableException;
use App\Sfile;
use Storage;
use Livewire\WithPagination;

class Document extends Component
{
	use WithPagination;

	public $search = '';
	// public $files = [];


	public function delete($id)
	{

		 $document = Efile::where('id',$id)->first();
        //delete the file from the server

        // Storage::delete($document->path);
        $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
		if(file_exists($storagePath.$document->path)){
		 unlink($storagePath.$document->path);
		}
		
        $document->delete($id);

	}



    public function render()

    {


		$shares = Sfile::where('user_id',Auth::id())->pluck('efile_id')->toArray();
        
        
        $myfiles = Efile::where('user_id',Auth::id())->pluck('id')->toArray();

		$allfiles = array_merge($shares,$myfiles);
		// dd($allfiles);
		
		$this->files = Efile::whereIn('id',$allfiles)
                            ->orderBy('created_at', 'desc')->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);


        return view('livewire.document',[

        	'files' => $this->files,

        ]);
    }
}
