<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use PavelMironchik\LaravelBackupPanel\LaravelBackupPanel;
use Illuminate\Support\Facades\Cache;
use Spatie\Backup\Helpers\Format;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use PavelMironchik\LaravelBackupPanel\Jobs\CreateBackupJob;
use PavelMironchik\LaravelBackupPanel\Rules\BackupDisk;
use PavelMironchik\LaravelBackupPanel\Rules\PathToZip;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use App\Sbackup;
use Validator;
use App\Services\Report;
use Redirect;
use Auth;


class BackupController extends Controller
{
    // Store our neccesity in variables
    public  $frequencies = ['Yearly' =>'Yearly', 'Monthly' =>'Monthly'];

     public function index()
     {
        $user = Auth::user();

        if($user && $user->id !== 1)
        {
            if($requet->ajax())
            {
                return response()->json(['error'=>'Permission denied']);
            }
           return back()->with('error','Permission Denied');
        }



        $setting = Sbackup::whereId(1)->first();

        $backupDestination = BackupDestination::create('google', config('backup.backup.name'));
 
        $backups = Cache::remember("backups-google", now()->addSeconds(4), function () use ($backupDestination) {
             return $backupDestination
                 ->backups()
                 ->map(function (Backup $backup) {
                     return [
                         'path' => $backup->path(),
                         'date' => $backup->date()->format('d-m-Y H:i:s'),
                         'size' => Format::humanReadableSize($backup->size()),
                     ];
                 })
                 ->toArray();
         });

        $new_submissions = Report::newSubmissions();
     
        return view('backup', [
            'globalVariables' => LaravelBackupPanel::scriptVariables(),
            'backups' => $backups,
            'setting' => $setting,
            'frequencies' => $this->frequencies,
            'new_submissions' => $new_submissions
        ]);
     }


     public function local(Request $request)
     {
        $user = Auth::user();

        if($user && $user->id !== 1)
        {
            if($requet->ajax())
            {
                return response()->json(['error'=>'Permission denied']);
            }
           return back()->with('error','Permission Denied');
        }
        //  $validated = $request->validate([
        //      'disk' => ['required', new BackupDisk()],
        //  ]);
 
         $backupDestination = BackupDestination::create('local', config('backup.backup.name'));
 
        $backups = Cache::remember("backups-local", now()->addSeconds(4), function () use ($backupDestination) {
             return $backupDestination
                 ->backups()
                 ->map(function (Backup $backup) {
                     return [
                         'path' => $backup->path(),
                         'date' => $backup->date()->format('d-m-Y H:i:s'),
                         'size' => Format::humanReadableSize($backup->size()),
                     ];
                 })
                 ->toArray();
         });
         
        //  return $backups;
        $new_submissions = Report::newSubmissions();

         return view('backup', [
            'backups' => $backups,
            'new_submissions' => $new_submissions
        ]);
         
     }


     public function delete(Request $request)
     {

        $user = Auth::user();

        if($user && $user->id !== 1)
        {
            if($requet->ajax())
            {
                return response()->json(['error'=>'Permission denied']);
            }
           return back()->with('error','Permission Denied');
        }

         $validated = $request->validate([
             'disk' => new BackupDisk(),
             'path' => ['required', new PathToZip()],
         ]);
 
         $backupDestination = BackupDestination::create($validated['disk'], config('backup.backup.name'));
 
         $backupDestination
             ->backups()
             ->first(function (Backup $backup) use ($validated) {
                 return $backup->path() === $validated['path'];
             })
             ->delete();
 
        //  $this->respondSuccess();
        return redirect()->back()->with('success','backup have been deleted');

     }



     public function setting(Request $request)
     {

        $user = Auth::user();

        if($user && $user->id !== 1)
        {
            if($requet->ajax())
            {
                return response()->json(['error'=>'Permission denied']);
            }
           return back()->with('error','Permission Denied');
        }


        //  dd($request->day);
        if ($request->interval == 'Monthly') {
            $validator = Validator::make($request->all(), [
                'interval' => 'required|string|',
                'day' => 'nullable|numeric|digits_between:1,30',
                'hour' => 'nullable|numeric|digits_between:1,30',
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
            'interval' => 'required|string|',
            'day' => 'nullable|numeric|min:1|max:30',
            'hour' => 'nullable|numeric|between:1,60',
        ]);
        }
        

        if ($validator->fails()) 
        {
            //Session::flash('error', $validator->messages()->first());
           return redirect()->back()->with('error', $validator->messages()->first());
        }

        if($request->interval == 'Monthly')
        {
            $settings = Sbackup::updateOrCreate(
                ['id' => 1],
                ['interval' => $request->interval,
                 'day' => $request->day,
                 'hour' => $request->hour,
                 'daylight' => $request->daylight]
            );   
        }
        else{
           
            $settings = Sbackup::updateOrCreate(
                ['id' => 1],
                ['interval' => $request->interval]
            );    
        }
        // $settings->save();

        

         return redirect()->back()->with('success', 'backup settings saved');
     }

     public function statuschange(Request $request)
     {

        $user = Auth::user();

        if($user && $user->id !== 1)
        {
            if($requet->ajax())
            {
                return response()->json(['error'=>'Permission denied']);
            }
           return back()->with('error','Permission Denied');
        }

         $setting = Sbackup::find(1);
         if($setting && $setting->status == 1)
         {
            $setting->status = 0;
         }
         else{
            $setting->status = 1;
         }
         $setting->save();
   
         return response()->json(['success'=>'Backup status change successfully.']);
     }

     public function create(Request $request)
     {

        $user = Auth::user();

        if($user && $user->id !== 1)
        {
            if($requet->ajax())
            {
                return response()->json(['error'=>'Permission denied']);
            }
           return back()->with('error','Permission Denied');
        }
         $option = '';
 
         dispatch(new CreateBackupJob($option))
             ->onQueue(config('laravel_backup_panel.queue'));
        
             return back()->with('success','Backup task have been dispatched');
     }
}
