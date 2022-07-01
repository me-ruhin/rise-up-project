@extends('admin.app')


@section('title','index')
@push('css')

@endpush

@section('content')
<!-- Welcome Area -->
   <div class="welcome-area">
                <div class="row m-0 align-items-left">


                    <div class="col-lg-4 col-md-4 p-0">
                        @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    @if (\Session::has('error'))

                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif

                @if (\Session::has('success'))

                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
                    </div>
                </div>
            </div>
            <!-- End Welcome Area -->
            <table class="table">
                <div class="row">
                <div class="col-lg-7 col-md-12 p-0 mb-5">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                       Add User
                      </button>
                     {{-- add user modal start here --}}

                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Member Informations</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.users.add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" required>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" class="form-control" name="email" required>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="role">Role</label>

                                        <select class="form-control form-control-lg" id="role" name="role_id" required>
                                            <option>Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="0">Member</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                </form>
                            </div>

                          </div>
                        </div>
                      </div>

                     {{-- add user modal end here --}}
                </div>
                <div class="col-lg-3 col-md-12 p-0 mb-5">
                    <form action="{{route('admin.users.list')}}" method="get">
                         <label for="month">Search by Month</label>
                        <input type="month" name="month" id="month">
                        <button>Search </button>

                    </form>

                </div>
                </div>

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Image</th>
                        <th scope="col">Total Present</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key=> $user )

                    <tr>
                        <th scope="row">{{++$key}}</th>

                        <td>{{$user->name??""}}</td>
                        <td>{{$user->role_type??""}}</td>
                        <td><img src="{{asset('uploads/'.$user->photo)}}" alt="{{$user->name}}" height="50" width="50"/></td>
                        <td>{{$user->attendences->count() ??0}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editMember_{{$user->id}}">
                               Edit
                               </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteMember_{{$user->id}}">
                                Delete
                               </button>

                        </td>
                    </tr>

                     {{-- edit user modal start here --}}

                     <div class="modal fade" id="editMember_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editMember_{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editMember">Edit Member Informations</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.users.edit',$user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{$user->name}}" required>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" class="form-control" name="email" value="{{$user->email}}" required>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="role">Role</label>

                                        <select class="form-control form-control-lg" id="role" name="role_id" required>
                                            <option>Select Role</option>
                                            <option value="1" {{$user->is_admin == 1?'selected':''}}>Admin</option>
                                            <option value="0" {{$user->is_admin != 1?'selected':''}}>Member</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" >
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        <img src="{{asset('uploads/'.$user->photo)}}" alt="{{$user->name}}" height="50" width="50"/>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                </form>
                            </div>

                          </div>
                        </div>
                      </div>

                     {{-- edit user modal end here --}}


                       {{-- Delete user modal start here --}}

                       <div class="modal fade" id="deleteMember_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteMember_{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteMember_">Deleting Member Member</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.users.delete',$user->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('delete')


                                    <div class="form-group mb-3">
                                            <p>Are you sure to delete ? </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                      </div>
                                </form>
                            </div>

                          </div>
                        </div>
                      </div>

                     {{-- Delete user modal end here --}}

                    @endforeach

                </tbody>

            </table>
            <div>
                {{ $users->render(); }}
            </div>


@endsection

@push('js')
    <!-- jvectormap Min JS -->
    <script src="{{asset('backend/assets/js/jvectormap-1.2.2.min.js')}}"></script>
    <!-- jvectormap World Mil JS -->
    <script src="{{asset('backend/assets/js/jvectormap-world-mill-en.js')}}"></script>

@endpush
