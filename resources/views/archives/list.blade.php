

@extends('layouts.archives')
@section('styles')
<style>
  thead {
    display:none;
  }
</style>
@stop
@section('content')
        <section class="header searchContact">
          <div class="rep">Archives</div>
        </section>

        <section class="message">
          @include('archives.headers')
          <!-- Mobile view tags -->

          <table id="table_id" class="table table-hover" style="width:100%">
            <thead>
              <tr style="background:#E5E5E5">
                <td ><input type="checkbox" name="" value=""></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
              </tr>
            </thead>
            <tbody class="repMainTable" id="tableBody" style="width:100vw">
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
            <tbody class="repMobTable" style="width:100vw">
              <tr style="display:flex!important; justify-content:flex-start;">
                <td class="tdt" style="display:flex!important; justify-content:flex-start; margin-top:1rem">
                  <input type="checkbox" name="" value=""></td>
                <td data-search="Tiger Nixon" class="tdDept" style="display:flex!important; flex-direction:column; width:90vw; margin-right:0.5rem">
                  <div class="" style="display:flex!important; justify-content:space-between">
                    <div class="conEmailPhone">T. Nixon</div>
                    <div class="">Timestamp</div>
                  </div>
                  <div class="">System Arc</div>
                  <div class="">Message.... Message.... Message....</div>
                </td>
              </tr>
            </tbody>
          </table>

        </section>

      @stop


@section('modal')
    <!-- Delete Model -->
  <form action="" method="POST" class="remove-record-model">
      <div id="custom-width-modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog" style="width:55%;">
              <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title" id="custom-width-modalLabel">Delete Record</h4>
                      <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                      
                  </div>
                  <div class="modal-body">
                      <h4>Deleting this report will permanenty remove it from this organization.</h4>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger waves-effect waves-light">Yes, delete report</button>
                  </div>
              </div>
          </div>
      </div>
  </form>
  <!-- Delete modal ends -->

  {{--  Start restore modal  --}}

    <form action="" method="POST" class="restore-record-model">
      <div id="restore-width-modal" class="modal " tabindex="-1" role="dialog" aria-labelledby="restore-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog" style="width:55%;">
              <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title" id="restore-width-modalLabel">Restore Record</h4>
                      <button type="button" class="close remove-restore-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                      
                  </div>
                  <div class="modal-body">
                      <h4>Are you sure you want to restore this report?</h4>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default waves-effect remove-restore-data-from-delete-form" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Yes, restore </button>
                  </div>
              </div>
          </div>
      </div>
  </form>
  {{--  End restore modal  --}}
@endsection

@section('script')
  <script>
       //select all checkboxes
              $("#select_all").change(function(){  //"select all" change 
                var status = this.checked; // "select all" checked status
                $('.file-checkbox').each(function(){ //iterate all listed checkbox items
                  this.checked = status; //change ".checkbox" checked status
                });
                var countCheckedCheckboxes = $('.file-checkbox:checked').length;

                  $('#count-checked-checkboxes').text(countCheckedCheckboxes);

                  if($('.file-checkbox:checked').length){
                    $('#headtile').show();
                    $('#headcount').show();
                    $('#headshare').show();
                  }
                  else{
                    $('#headtile').hide();
                    $('#headcount').hide();
                    $('#headshare').hide();
                  }
              });

              $('.file-checkbox').change(function(){ //".checkbox" change 
                //uncheck "select all", if one of the listed checkbox item is unchecked
                if(this.checked == false){ //if this item is unchecked
                  $("#select_all")[0].checked = false; //change "select all" checked status to false
                  var countCheckedCheckboxes = $('.file-checkbox:checked').length;

                  $('#count-checked-checkboxes').text(countCheckedCheckboxes);

                  if($('.file-checkbox:checked').length){
                    $('#headtile').show();
                    $('#headcount').show();
                    $('#headshare').show();
                  }
                  else{
                    $('#headtile').hide();
                    $('#headcount').hide();
                    $('#headshare').hide();
                  }
                }
                
                //check "select all" if all checkbox items are checked
                if ($('.file-checkbox:checked').length == $('.file-checkbox').length ){ 
                  $("#select_all")[0].checked = true; //change "select all" checked status to true

                  var countCheckedCheckboxes = $('.file-checkbox:checked').length;

                  $('#count-checked-checkboxes').text(countCheckedCheckboxes);

                  if($('.file-checkbox:checked').length){
                    $('#headtile').show();
                    $('#headcount').show();
                    $('#headshare').show();
                  }
                  else{
                    $('#headtile').hide();
                    $('#headcount').hide();
                    $('#headshare').hide();
                  }
                }
                // Count

                  var countCheckedCheckboxes = $('.file-checkbox:checked').length;

                  $('#count-checked-checkboxes').text(countCheckedCheckboxes);

                  if($('.file-checkbox:checked').length){
                    $('#headtile').show();
                    $('#headcount').show();
                    $('#headshare').show();
                  }
                  else{
                    $('#headtile').hide();
                    $('#headcount').hide();
                    $('#headshare').hide();
                  }
                

                
              });



                // For A Delete Record Popup
                $('.deleteall').on('click', function(e) {

                        
                          var allVals = [];  
                          $(".file-checkbox:checked").each(function() {  
                              allVals.push($(this).attr('data-id'));
                          });  
                        


                          if(allVals.length <=0)  
                          {  
                              alert("Please select an item.");  
                          }

                          else{
                            showdeletemodal();
                              {{--  var ids = allVals.join(",");   --}}
                              var ids = allVals.toString(); 
                          

                          console.log(ids);
                          var deleteurl =  '{{ url('/delete/archives') }}';

                          {{--  var id = $(this).attr('data-id');  --}}
                          var url = deleteurl;
                          var token = $('meta[name="csrf-token"]').attr('content');
                          $(".remove-record-model").attr("action",url);
                          $('body').find('.remove-record-model').append('@csrf');
                          {{--  $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');  --}}
                          $('body').find('.remove-record-model').append('<input name="ids[]" type="hidden" value="'+ ids +'">');

                          $('.remove-data-from-delete-form').click(function() {
                            $('body').find('.remove-record-model').find( "input" ).remove();
                          });

                          }

                });


                 // For A Delete Record Popup
                $('.restoreall').on('click', function(e) {

                        
                          var allVals = [];  
                          $(".file-checkbox:checked").each(function() {  
                              allVals.push($(this).attr('data-id'));
                          });  
                        


                          if(allVals.length <=0)  
                          {  
                              alert("Please select an item.");  
                          }

                          else{
                            showrestoremodal();
                              {{--  var ids = allVals.join(",");   --}}
                              var ids = allVals.toString(); 
                          

                          
                          var deleteurl =  '{{ url('/restore/archives') }}';

                          {{--  var id = $(this).attr('data-id');  --}}
                          var url = deleteurl;
                          var token = $('meta[name="csrf-token"]').attr('content');
                          $(".restore-record-model").attr("action",url);
                          $('body').find('.restore-record-model').append('@csrf');
                          {{--  $('body').find('.restore-record-model').append('<input name="_method" type="hidden" value="DELETE">');  --}}
                          $('body').find('.restore-record-model').append('<input name="ids[]" type="hidden" value="'+ ids +'">');

                          $('.remove-restore-data-from-delete-form').click(function() {
                            $('body').find('.restore-record-model').find( "input" ).remove();
                          });

                          }

                });

                function showdeletemodal(){
                  $('#custom-width-modal').modal('show');
                }

                 function showrestoremodal(){
                  $('#restore-width-modal').modal('show');
                }

                function confirmdelete()
                {
                      var allVals = [];  
                          $(".file-checkbox:checked").each(function() {  
                              allVals.push($(this).attr('data-id'));
                          });  

                          console.log(allVals);
                          var deleteurl =  '{{ route('file.deleteall') }}';

                          alert(deleteurl);
                }

  </script>
@endsection