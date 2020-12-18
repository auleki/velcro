<div>
    <div>
    <div class="form-inline">
      <label class="sr-only" for="inlineFormInputName2"></label>
      <input type="search"  wire:model.live="search"
       class="form-control search-form mb-2  mr-sm-2"
       style="width: 24rem"="inlineFormInputName2" placeholder="Search archive">

      <button type="submit" class="btn btn-primary search-btn btn-sm mb-2 p-2">
        <svg class="svg" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.0833 13.3333H14.1617L13.835 13.0183C15.0179 11.6464 15.668 9.89481 15.6667 8.08334C15.6667 6.58349 15.2219 5.11734 14.3886 3.87026C13.5554 2.62319 12.371 1.65121 10.9854 1.07725C9.59968 0.503286 8.07492 0.35311 6.6039 0.645715C5.13288 0.93832 3.78166 1.66056 2.72111 2.72111C1.66056 3.78166 0.93832 5.13288 0.645715 6.6039C0.35311 8.07492 0.503286 9.59968 1.07725 10.9854C1.65121 12.371 2.62319 13.5554 3.87026 14.3886C5.11734 15.2219 6.58349 15.6667 8.08334 15.6667C9.96167 15.6667 11.6883 14.9783 13.0183 13.835L13.3333 14.1617V15.0833L19.1667 20.905L20.905 19.1667L15.0833 13.3333ZM8.08334 13.3333C5.17834 13.3333 2.83334 10.9883 2.83334 8.08334C2.83334 5.17834 5.17834 2.83334 8.08334 2.83334C10.9883 2.83334 13.3333 5.17834 13.3333 8.08334C13.3333 10.9883 10.9883 13.3333 8.08334 13.3333Z" fill="white"/>
        </svg>
      </button>
    </div>
<div>
</div>


<div class="d-flex selected-text">
      
        <div class="p-2 bd-highlight ml-2">
            <input  id="select_all" style="margin-top: 5px;" type="checkbox" />
        </div>
        <div class="p-2 bd-highlight ml-1" id="headtile" style=" display: none;">
          <a class="deleteall"><img src="{{ asset('css/icons/trash.svg') }}" style="height: 18px; width: 14px; color:#717171; " /> </a>
        </div>


        <div class="p-2 bd-highlight ml-1" id="headshare" style=" display: none;">
        <a class="restoreall"><img src="{{ asset('css/icons/restore.svg') }}" style="height: 14px; width: 14px; color:#717171; " /></a>
        </div>


      <div class="mr-auto p-2 bd-highlight ml-2 " id="headcount" style=" display: none;" > 
        	<span  style="border-left: 2px solid #C4C4C4; transform: rotate(-90deg);">  
    <span class="ml-3"  >
        <em id="count-checked-checkboxes">0</em> selected
    </span>
    </span></div>
      <div class="p-2 bd-highlight text-right pull-right">
        <span class=" text-right">1-{{$archives->count()}} of {{$archives->total()}}</span>
      </div>
</div>

<hr class="shadow">

    <table id="table_id" class="table table-hover table-mobile table-borderless">             
      <tbody class="table-items">
        @forelse ($archives as $report)
        <tr>
          <td><input type="checkbox" data-id="{{ $report->id }}" class="checkbox file-checkbox"/></td>
          @if($report->report_type == 'sent')
          <td> {{ $report->sent_report()->withTrashed()->first()->report_title ?? '' }} </td>
          <td class="mobileHide"> </td>
          <td class="mobileHide">
                {{ $report->sent_report()->withTrashed()->first()->message ?? '' }}
          </td>
          @elseif($report->report_type == 'received')
          <td> {{ $report->received_report()->withTrashed()->first()->report_title }} </td>
          <td class="mobileHide">
            {{ $report->received_report()->withTrashed()->first()->recipient()->first()->contact()->first()->fname }}
              from 
            {{ $report->received_report()->withTrashed()->first()->recipient()->first()->contact()->first()->company }}  
          </td>
          <td class="mobileHide">
                {{ $report->received_report()->withTrashed()->first()->message }}
          </td>
          @elseif($report->report_type == 'scheduled')
          <td> {{ $report->scheduled_report()->withTrashed()->first()->report_title }} </td>
          <td class="mobileHide"> </td>
          <td class="mobileHide">
                {{ $report->scheduled_report()->withTrashed()->first()->message }}
          </td>
          @elseif($report->report_type == 'draft')
          <td> {{ $report->draft_report()->withTrashed()->first()->report_title }} </td>
          <td class="mobileHide"> </td>
          <td class="mobileHide">
                {{ $report->draft_report()->withTrashed()->first()->message }}
          </td>
          @endif
          <td class="mobileHide">{{ Carbon\Carbon::parse($report->created_at)->diffForHumans() }}</td>
        </tr>
        @empty
        <p class="empty_report">There are no reports</p>
        @endforelse
      </tbody>
    </table>

             <div class="mt-5 mb-5 row justify-content-center">
               {{ $archives->links() }}
             </div>
</div>
