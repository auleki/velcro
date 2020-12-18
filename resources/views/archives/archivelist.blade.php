@extends('layouts.sidbar')
@section('styles')
<style type="text/css" media="screen">
 /* @import('https://fonts.googleapis.com/css?family=Nunito:400,600'); */
    .selected-text{
        font-weight: 300;
        font-size: 1rem;
        line-height: 18px;
        color: #717171;
    }

    .table-head{
        font-weight: bolder;
        font-size: 1rem;
        line-height: 16px;
        /* identical to box height */

        text-transform: uppercase;

        color: #666666;

    }


    .table-items{
        font-size: 1rem;
        font-weight: 700;
        line-height: 20px;
        /* identical to box height, or 143% */


        color: #333333;

    }
    .table-items > tr >td > span > img {
    margin-top: -5px;
    /* padding-top: 1rem; */
    }

    @media (max-width: 1440px){
        .mobileOnly{
            display: none;
        }
    }
    @media(max-width: 425px){
    .search-form{
      width: 17rem !important;
 
    }
    .upload-btn{
      display: none;
    }
    .selected-text{
      display: none;
      visibility: hidden;
    }
    thead{
      display: none;
    }
    td.mobileHide{
      display: none;
      border: none;
    }
    .table-mobile{
      margin-top: -1rem;
      font-size: 1rem !important;
    }
    .table-items{
      font-size: 1remem;
      padding: 0;
    }
    .table-items > tr >td > span > img {
      height: 1.6rem;
      margin-left: -1.2rem;
    }
    .header_file{
      margin-left: 1.7rem;
      margin-top: -1.3rem;
    }
    .search-btn{
      margin-left: 1rem;
    }
 
  }
    
  
  @media(max-width: 375px){
    .search-form{
      width: 17rem !important;
 
    }
    .upload-btn{
      display: none;
    }
    .selected-text{
      display: none;
      visibility: hidden;
    }
    thead{
      display: none;
    }
    td.mobileHide{
      display: none;
      border: none;
      /* margin-top: 5rem !important; */
    }
    .table-mobile{
      margin-top: -1.1rem;
      font-size: 1rem !important;

    }
    hr{
        margin-top: -2rem;
    }
    .table-items{
      font-size: 1remem;
      padding: 0;
    }
    .table-items > tr >td > span > img {
      height: 1.6rem;
      margin-left: -1.2rem;
    }
    .header_file{
      margin-left: 1.7rem;
      margin-top: -1.3rem;
    }
    .search-btn{
      margin-left: 1rem;
    }

 
  }

  @media(max-width: 320px){
    .search-form{
      width: 13rem !important;
    }
  }


</style> 

@stop
@section('content')
<div class="container-fluid">
  <div class="">
    <div class="d-flex mt-4">
      <div class="p-2 header_file"><h2 > Archive</h2></div>
      {{-- <div class="ml-auto p-2"><a class="btn btn-primary upload-btn text-white  mb-1"> Upload file </a></div> --}}
    </div>
  </div>
    @yield('body')
      {{--  @include('livewire.archives')  --}}
</div>
@stop
 
@section('modal')
    <!-- Delete Model -->
  <form action="" method="POST" class="remove-record-model">
      <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
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
      <div id="restore-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="restore-width-modalLabel" aria-hidden="true" style="display: none;">
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
           