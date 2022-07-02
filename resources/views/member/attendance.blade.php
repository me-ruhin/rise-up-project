@extends('admin.app')


@section('title','Attendance Reports')
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
                      Attendence
                       </button>
                      {{-- Attendancy modal start here --}}

                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Attendnace Informations</h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                             <div class="modal-body">
                                 <form action="{{route('member.report')}}" method="POST">
                                     @csrf
                                     <div class="form-group mb-3">
                                         <label for="notation">Notation</label>
                                         <input type="text" id="notation" class="form-control" name="notation" required>

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

                      {{-- Attendancy modal end here --}}

                </div>
                <div class="col-lg-3 col-md-12 p-0 mb-5">
                    <form action="{{route('member.report.date')}}" method="get">
                         <label for="date">Search by Date</label>
                        <input type="date" name="date" id="date">
                        <button>Search </button>

                    </form>

                </div>
                </div>

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Date</th>
                        <th scope="col">In time</th>
                        <th scope="col">Out Time</th>
                        <th scope="col">Notation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $key=> $report )

                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$report->created_at->format('Y-m-d')??""}}</td>
                        <td>{{$report->in_time??""}}</td>
                        <td>{{$report->out_time??""}}</td>
                        <td>{{$report->in_notation ??''}} - {{$report->out_notation ??''}}</td>

                    </tr>



                    @endforeach

                </tbody>

            </table>
            <div>
                {{-- {{ $reports->render(); }} --}}
            </div>


@endsection

@push('js')
    <!-- jvectormap Min JS -->
    <script src="{{asset('backend/assets/js/jvectormap-1.2.2.min.js')}}"></script>
    <!-- jvectormap World Mil JS -->
    <script src="{{asset('backend/assets/js/jvectormap-world-mill-en.js')}}"></script>

@endpush
