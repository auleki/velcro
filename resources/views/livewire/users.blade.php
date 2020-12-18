<div>
    {{-- The Master doesn't talk, he acts. --}}
     <div class="profile-form mt-4 ">
                      @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('warning'))
                        <div class="alert alert-warning  alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                            {{ session('warning') }}
                        </div>
                        @endif
                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                {!! session('error') !!}
                                            </div>
                                        @endif

                

                    <h3 class="font-weight-bold text-center">Users and Permissions</h3>
                    <div class="form-inline form-search mt-4" style="border-radius: 4px"  >
                        <label class="sr-only" for="inlineFormInputName2"></label>
                        <input type="search" wire:model.live="search" class="form-control search-form mb-2   mr-sm-2" style="width: 24rem"="inlineFormInputName2" placeholder="Search for a user">

                        {{-- <button type="submit" class="btn btn-primary search-btn btn-sm mb-2 p-2">
                          <svg class="svg" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M15.0833 13.3333H14.1617L13.835 13.0183C15.0179 11.6464 15.668 9.89481 15.6667 8.08334C15.6667 6.58349 15.2219 5.11734 14.3886 3.87026C13.5554 2.62319 12.371 1.65121 10.9854 1.07725C9.59968 0.503286 8.07492 0.35311 6.6039 0.645715C5.13288 0.93832 3.78166 1.66056 2.72111 2.72111C1.66056 3.78166 0.93832 5.13288 0.645715 6.6039C0.35311 8.07492 0.503286 9.59968 1.07725 10.9854C1.65121 12.371 2.62319 13.5554 3.87026 14.3886C5.11734 15.2219 6.58349 15.6667 8.08334 15.6667C9.96167 15.6667 11.6883 14.9783 13.0183 13.835L13.3333 14.1617V15.0833L19.1667 20.905L20.905 19.1667L15.0833 13.3333ZM8.08334 13.3333C5.17834 13.3333 2.83334 10.9883 2.83334 8.08334C2.83334 5.17834 5.17834 2.83334 8.08334 2.83334C10.9883 2.83334 13.3333 5.17834 13.3333 8.08334C13.3333 10.9883 10.9883 13.3333 8.08334 13.3333Z" fill="white"/>
                          </svg>
                        </button> --}}

                    </div>
                        <div class="manage">
                            <div class="table ml-1">
                                <table class="  table-borderless table-hover" style="width: 100%">
                                    
                                    <thead >
                                        <tr>
                                            <th colspan> Name </th>

                                            <th colspan> Email </th>

                                            <th> Permissions </th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                    @forelse ($users as $user)
                                          <tr>
                                            @if ($user->id == 1)
                                                
                                            @else
                                                <td >{{$user->fullname}}</td>


                                            <td>{{$user->email}}</td>
                                            <td></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default">{{$user->permission}}</button>
                                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                          {{-- <span class="sr-only">Toggle Dropdown</span> --}}
                                                        </button>
                                                        <div class="dropdown-menu text-left" aria-labelledby="dropdownMenuReference">
                                                          <a class="dropdown-item" href="{{ url('/admin/user/permission/view/') }}/{{ $user->id }}">can view</a>
                                                          <a class="dropdown-item" href="{{ url('/admin/user/permission/edit/') }}/{{ $user->id }}">can edit</a>
                                                          <a class="dropdown-item" href="{{ url('/admin/user/permission/admin/') }}/{{ $user->id }}">admin</a>
                                                          <div class="dropdown-divider"></div>
                                                          <a class="dropdown-item text-danger remove-record" data-toggle="modal" data-url="{{url('/admin/user/delete/')}}/{{$user->id}}" data-id="{{$user->id}}" data-target="#custom-width-modal">remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @endif
                                          </tr>
                                   



                                    </tbody>

                                     @empty

                                   
                                        <strong> Sorry there is nothing here </strong>
                                     

                                    @endforelse
                                </table>
                            </div>
                            <div class="mt-5 mb-5 row justify-content-center">
                                {{ $users->links() }}
                            </div>
                        </div>

                    </div>
            </div>
</div>
