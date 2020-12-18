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
      {{--  <div class="p-2 bd-highlight text-right pull-right">
        <span class=" text-right">1-{{$archives->count()}} of {{$archives->total()}}</span>
      </div>  --}}
</div>