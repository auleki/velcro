<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Efile;
use App\Company;
use App\Services\Report;
use Validator,Redirect,Response,File;

use Intervention\Image\Exception\NotReadableException;
use Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Sfile;
use App\Cfile;


class FileController extends Controller
{
    

    private $document_ext = ['doc', 'docx','zip'];
    private $pdf_ext = ['pdf'];
    private $excel_ext = ['xls','xlsx'];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Get type by extension
     * @param  string $ext Specific extension
     * @return string      Type
     */
    private function getType($ext)
    {
        if (in_array($ext, $this->pdf_ext)) {
            return 'pdf';
        }

        if (in_array($ext, $this->excel_ext)) {
            return 'excel';
        }

        // if (in_array($ext, $this->video_ext)) {
        //     return 'video';
        // }

        if (in_array($ext, $this->document_ext)) {
            return 'doc';
        }
    }

    /**
     * Get all extensions
     * @return array Extensions of all file types
     */
    private function allExtensions()
    {
        return array_merge($this->pdf_ext, $this->excel_ext, $this->document_ext);
    }

    /**
     * Get directory for the specific user
     * @return string Specific user directory
     */
    private function getUserDir()
    {
        return Auth::user()->name . '_' . Auth::id();
    }



    public function index()
    {
    	$user = Auth::user();

    	if($user->type != 'admin')
    	 {
    	    $files = Efile::where('user_id', Auth::id())
                            ->orderBy('created_at', 'desc')->paginate(1);
         }
         else{
            $files = Efile::orderBy('created_at', 'desc')->paginate(1);
         }

             if($files->count() > 0)
             {

             	    return view('files.file_upload');
             }

             else
             {
             	 return view('files.files');
             }
    	 }


    	
    



    public function store(Request $request)
    {

    	 request()->validate([
         'file'  => 'required|mimes:doc,docx,pdf,xls,xlsx,csv,zip|max:2048',
         'name' => 'required',
       ]);

      
        	// Get filename with extension            
        	$filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
           // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;  
             //Filename to store
            $dbfileNameToStore = '/files'.$fileNameToStore;    

            $file = $request->file('file');
            $ext = $request->file('file')->getClientOriginalExtension();
            $type = $this->getType($ext);
            $size = $this->filesize_formatted($file);
            $path = $request->file('file')->storeAs('files/'.$type, $fileNameToStore, 'public');

                $efile = new Efile();
                $efile->name = $request->name;
                $efile->type = $type;
                $efile->storage = $fileNameToStore;
                $efile->source = 'upload';
                $efile->path = $path;
                $efile->status = 'active';
                $efile->size = $size;
                $efile->user_id = Auth::id();
                $efile->save();


               

               toast('File Uploaded','success');
   
        return back()
            ->with('success','You have successfully upload file.');
       
    }


    public function deleteall(Request $request)
    {
     
        $id =$request->ids;
        $myArray = explode(',', $id[0]);
        $ids = $myArray;

         $documents = Efile::whereIn('id',$ids)->get();
        //delete the file from the server

        // dd($documents->count());

        // Storage::delete($document->path);
        if($documents->count() > 0)
        {
            foreach($documents as $document)
            {
                $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
                if(file_exists($storagePath.$document->path)){
                 unlink($storagePath.$document->path);
                }
                
                $document->delete();
        
            }

            toast('Files have been successfully deleted.','success');
   
            return back()
                ->with('success','Files have been successfully deleted.');
    
        }
       
              
    }


    public function usersearch(Request $request)
    {

        $search = $request->user;
        $auth = Auth::user();

        
           $users = User::orderby('created_at','asc')->select('id','fname','lname')
           ->whereNotIn('id',[$auth->id])
           ->where('fname', 'like', '%' .$search . '%')->limit(5)->get();
        //    ->whereRaw('CONCAT(firstname, " ", lastname) LIKE ? ', '%' . $request->input('name') . '%')->limit(5)->get();


  
        $response = array();
        foreach($users as $user){
           $response[] = array(
                "id"=>$user->id,
                "text"=>$user->fullname
           );
        }
  
        // echo json_encode($response);
        // exit;


        // $users = User::where('fname', 'LIKE', '%'.$request->input('user', '').'%')
        // ->Orwhere('lname', 'LIKE', '%'.$request->input('user', '').'%')
        // ->get(['id', 'full_name  as text']);
        // whereRaw('CONCAT(firstname, " ", lastname) LIKE ? ', '%' . $request->input('name') . '%');
        // $users = User::withName($request->input('user'))->get();

        return ['results' => $response];
        
    }



        /**
         * Formats filesize in human readable way.
         *
         * @param file $file
         * @return string Formatted Filesize, e.g. "113.24 MB".
         */
        private function filesize_formatted($file)
        {
            $bytes = filesize($file);

            if ($bytes >= 1073741824) {
                return number_format($bytes / 1073741824, 2) . ' GB';
            } elseif ($bytes >= 1048576) {
                return number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                return number_format($bytes / 1024, 2) . ' KB';
            } elseif ($bytes > 1) {
                return $bytes . ' bytes';
            } elseif ($bytes == 1) {
                return '1 byte';
            } else {
                return '0 bytes';
            }
        }

        
        public function share(Request $request,$id)
        {

            request()->validate([
                'user'  => 'required|exists:users,id',
              ]);
              

            $file =  Efile::whereId($id)->first();
            $user =  User::whereId($request->user)->first();
            $shared = Sfile::where('efile_id',$file->id)->where('user_id',$user->id)->first();
            if($shared)
                {
                    return back()
                        ->with('error','This file have already been shared with '.$user->full_name);
                }
                if(!$file || !$user)
                    {
                        return back()
                        ->with('error','File could not be sent');
                    }
                else
                    {
                      $share = new Sfile();
                      $share->efile_id = $file->id;
                      $share->user_id = $user->id;
                      $share->save();

                      return back()
                        ->with('success','File shared successfully');
                    }

        }



        public function filesearch(Request $request)
    {

        $search = $request->file;
        $auth = Auth::user();

        $shares = Sfile::where('user_id',Auth::id())->pluck('efile_id')->toArray();
        
        
        $myfiles = Efile::where('user_id',Auth::id())->pluck('id')->toArray();

        $allfiles = array_merge($shares,$myfiles);

        $results = Efile::orderby('created_at','asc')->whereIn('id',$allfiles)
        ->where('name', 'like', '%' .$search . '%')->limit(5)->get();

        
        //    $results = Efile::orderby('created_at','asc')->select('id','fname','lname')
        //    ->whereNotIn('id',[$auth->id])
        //    ->where('fname', 'like', '%' .$search . '%')->limit(5)->get();
        


  
        $response = array();
        foreach($results as $result){
           $response[] = array(
                "id"=>$result->id,
                "text"=>$result->name
           );
        }

        return ['results' => $response];
        
    }


    public function sharetocompany(Request $request,$id)
    {

        request()->validate([
            'file'  => 'required|exists:efiles,id',
          ]);
          
        $file = $request->file;
        $user = Auth::user();
        $company =  Company::whereId($id)->first();
        $efile = Efile::whereId($file)->first();
        $shared = Cfile::where('efile_id',$file)->where('company_id',$company->id)->first();
        
        if($shared)
            {
                return back()
                    ->with('error','This file have already been added to '.$company->c_name);
            }
            if(!$efile || !$company)
                {
                    return back()
                    ->with('error','File could not be sent');
                }
            else
                {
                  $share = new Cfile();
                  $share->efile_id = $efile->id;
                  $share->user_id = $user->id;
                  $share->type = 'local';
                  $share->company_id = $company->id;
                  $share->path = $efile->path;
                  $share->name = $efile->name;
                  $share->save();

                  return back()
                    ->with('success','File added');
                }

    }


    public function urlcompany(Request $request,$id)
    {

        
        request()->validate([
            'name'  => 'required|string',
            'url' => 'required|url'
          ]);

          $user = Auth::user();
          $company =  Company::whereId($id)->first();

          if(!$company)
          {
              return back()
              ->with('error','Entity resource does not exist');
          }
            
            $share = new Cfile();
                    
            $share->user_id = $user->id;
            $share->type = 'google';
            $share->company_id = $company->id;
            $share->path = $request->url;
            $share->name = $request->name;
            $share->save();

        return back()
        ->with('success','Link added ');
    }

    public function uploadfilecompany(Request $request, $id)
    {

        request()->validate([
            'file'  => 'required|mimes:doc,docx,pdf,xls,xlsx,csv,zip|max:2048',
            'name' => 'required|string',
          ]);

          $user = Auth::user();
          $company =  Company::whereId($id)->first();



          	// Get filename with extension            
        	$filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
           // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;  
             //Filename to store
            $dbfileNameToStore = '/files'.$fileNameToStore;    

            $file = $request->file('file');
            $ext = $request->file('file')->getClientOriginalExtension();
            $type = $this->getType($ext);
            $size = $this->filesize_formatted($file);
            $path = $request->file('file')->storeAs('files/'.$type, $fileNameToStore, 'public');

                $efile = new Efile();
                $efile->name = $request->name;
                $efile->type = $type;
                $efile->storage = $fileNameToStore;
                $efile->source = 'upload';
                $efile->path = $path;
                $efile->status = 'active';
                $efile->size = $size;
                $efile->user_id = Auth::id();
                if($efile->save())
                {
                    $share = new Cfile();
                    $share->efile_id = $efile->id;
                    $share->user_id = $user->id;
                    $share->type = 'local';
                    $share->company_id = $company->id;
                    $share->path = $efile->path;
                    $share->name = $efile->name;
                    $share->save();
                }

        return back()
          ->with('success','File added');

    }







}
