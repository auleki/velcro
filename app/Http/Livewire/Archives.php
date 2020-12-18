<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Report;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
Use App\SentReport;
Use App\ScheduledReport;
Use App\DraftReport;
use App\User;
use App\Contact;
use App\Recipient;
use App\ReceivedReport;
use App\ReportTextRequest;
use App\ReportMetric;
use App\ReportMetricKpi;
use App\SubmittedReport;
use App\ReportFileRequest;
use PDF;
use Carbon\Carbon;
use Livewire\WithPagination;

class Archives extends Component
{
    use WithPagination;

    public $search = '';

    
    public function render()
    {
        $user =  Auth::user();
        if($user->permission === 'admin')
      {
        $archives = Report::onlyTrashed()
        ->orderBy('id', 'desc')
       ->paginate(10);
      }
      else{
        $archives = Report::where('user_id',Auth::user()->id)
        ->orderBy('id', 'desc')
        ->onlyTrashed()
        ->paginate(10);
      }
      
       if($archives->count() > 0){
        return view('livewire.archives',[
            'archives' => $archives
        ]);
      }

      return view('archives.archives');

        // return view('archives.archivelist',[
        //   'archives' => $this->files
        // ]);
    }
}
