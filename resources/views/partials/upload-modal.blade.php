<!-- Modal HTML -->
 
 {{-- Upload from Computer --}}

 <div id="computer-modal" class="modal fade" tabindex="-1">
                           <div class="modal-dialog " role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title">File Upload</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body">
                           <div class="form">
                              <form   method="POST" action="{{ route('file.upload') }}"  class="form-group">
                                   @csrf

                                 <div>
                                    <label for="" aria-label> Name: </label>
                                    <input name="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name">
                                 </div>

                                 <div class="mt-4">
                                    <label for="select_file"> Select File: </label>
                                    <input name="file" type="file" class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}">
                                 </div>
                             
                           </div>
                         </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-primary">Upload</button>
                                 </div>
                          </form>
                       </div>
                     </div>
  </div>
<!-- Modal HTML -->
   