<style>

</style>
<div class="container-fluid">
    {{-- Do your work, then step back. --}}
    <div class="container" >
        <div class="mt-2 mt-md-5 ml-3">
            <div class="d-flex mt-3 mb-4">
             <h2>Files</h2>
                <div class="ml-auto">

                        <button data-target="#computer-modal" data-toggle="modal"  class="btn btn-primary ">
                        Upload file
                        </button>
                </div>
            </div>
        </div>

    <div>
    <div class="form-inline">
        <label class="sr-only" for="inlineFormInputName2"></label>
        <input type="search" wire:model.live="search"
        class="form-control search-bar mb-2  mr-sm-2"
            style="width: 24rem"="inlineFormInputName2"
            placeholder="Search files">
    </div>
<div>


          <div class="col-md-10 mt-1 mb-1 p-1">

            	 @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong>{{ $message }}</strong>
                  </div>
                  {{--  <img src="uploads/{{ Session::get('file') }}">  --}}
              @endif

              @if ($message = Session::get('error'))
                  <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                          <strong>{{ $message }}</strong>
                  </div>
                  {{--  <img src="uploads/{{ Session::get('file') }}">  --}}
              @endif
          </div>



<div class="d-flex selected-text">

        <div class="p-2 bd-highlight ml-2">
            <input style="margin-top: 5px;" type="checkbox" name="deleteall" id="select_all"/>
        </div>

        <div class="p-2 bd-highlight ml-1" id="headtile" style=" display: none;"  >
        <a class="deleteall"><img src="{{ asset('css/icons/trash.svg') }}" style="height: 18px; width: 14px; color:#717171; " /> </a>
        </div>


        <div class="p-2 bd-highlight ml-1" id="headshare" style=" display: none;">
        <img src="{{ asset('css/icons/share.png') }}" style="height: 14px; width: 14px; color:#717171; " />
        </div>


        <div class="mr-auto p-2 bd-highlight ml-2 " id="headcount" style=" display: none;" >
        	<span  style="border-left: 2px solid #C4C4C4; transform: rotate(-90deg);">
    <span class="ml-3"  >
        <em id="count-checked-checkboxes">0</em> selected
    </span>
    </span></div>
      <div class="p-2 bd-highlight text-right pull-right">
        <span class=" text-right">1-{{$this->files->count()}} of {{$this->files->total()}}</span></div>
</div>

<table class="table table-hover table-mobile table-borderless ">
              <thead class="thead-light table-head">
                <th>{{--  --}}</th>
                <th>NAME</th>
                <th>OWNER</th>
                <th>FILE SIZE</th>
                <th>LAST MODIFIED</th>
                 <th></th>
              </thead>
              <tbody class="table-items">
              	@forelse($this->files as $i => $file)
               <tr>
                  <td>
                  @if($file->user_id === Auth::id())
                  <input type="checkbox" data-id="{{ $file->id }}" class="checkbox file-checkbox"/>
                  @endif</td>
                  <td><span> <img
                  	@if($file->type == 'excel')
                  	src="{{ asset('css/icons/xls.png') }}"
                  	@endif

                  	@if($file->type == 'pdf')
                  	src="{{ asset('css/icons/pdf.png') }}"
                  	@endif

                  	@if($file->type == 'doc')
                  	src="{{ asset('css/icons/docx.png') }}"
                  	@endif

                  	 />  {{$file->name}} </span> </td>
                  <td class="mobileHide">
                    @if ($file->mine())
                        me
                    @else

                          {{--  @php
                              dd($file->userexists($file->user_id));
                          @endphp  --}}

                          @if ($file->userexists($file->user_id))
                              {{ $file->user->fullname() }}
                          @else
                              Owner removed
                          @endif

                    @endif
                  </td>
                  <td class="mobileHide">{{$file->size}}</td>
                  <td class="mobileHide">Aug 19</td>
                  <td>
                    @if($file->user_id === Auth::id())
                  	<a class="mr-3" onclick="docdelete({{$file->id}})" data-catid={{$file->id}} data-toggle="modal" data-target="#delete" ><img  src="{{ asset('css/icons/trash.svg') }}" style="height: 18px; width: 14px; color:#717171; " /></a>
                    @endif
                    <button id="delete_{{$file->id}}" style="display:none;" wire:click="delete({{$file->id}})"></button>
                        <a  data-catid={{$file->id}} data-toggle="modal" data-target="#share_{{ $file->id}}"/><img  src="{{ asset('css/icons/share.png') }}" style="height: 18px; width: 14px; color:#717171; " /></a>

                        <div class="modal fade" id="share_{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Share Document</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                {{--  Sharable forms  --}}
                              <form id="share_{{$file->id}} " method="POST" action=" {{ route('file.share',$file->id)   }}">
                                 @csrf
                                <div class="modal-body">
                                  <p class="row justify-content-center">
                                    <select id='selUser' class="col-lg-8" name="user">
                                    </select>
                                  </p>
                                </div>
                                <div class="modal-footer">
                                  <button  type="submit"   onclick="share({{ $file->id }})"  class="btn btn-primary deleteRecord" data-dismiss="modal"> Share</button>
                                  <button type="button" class="btn btn-default btn-test " class="close" data-dismiss="modal" aria-label="Close">No, keep file</button>
                                </div>
                              </form>
                                {{--  Sharable forms  --}}
                            </div>
                          </div>
                        </div>

                    </td>
               </tr>
               @empty

               <tr class="p-2 text-center">
                  <td cols="3">
                  	<div >
                  		There is nothing here
                  	</div>
                  </td>

               </tr>

               @endforelse
 {{-- wire:click="delete({{$file->id}})" --}}
 {{-- onclick="docdelete() || event.stopImmediatePropagation()" --}}


              </tbody>

            </table>



</div>

          <div class="mt-5 mb-5 row justify-content-center">
               {{ $files->links() }}
             </div>
</div>
