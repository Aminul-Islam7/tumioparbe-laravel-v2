@extends('admin.layout.default')
@section('title_area', 'Our Students')
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get('class')}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Student List
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-responsive table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Photo</th>
                                                    <th>Student Details</th>
                                                    <th>Grade</th>
                                                    <th>District</th>
                                                    <th>FB Link</th>
                                                    <th>Status</th>
                                                    <th>Joined</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($get_all)
                                                    @foreach($get_all as $key => $value)
                                                        <tr>
                                                            <td>{{++$key}}</td>
                                                            <td>
                                                                @if($value->photo)
                                                                    <img src="{{ asset($value->photo) }}" height="100" width="100">
                                                                @else
                                                                    <img src="{{ asset('admin/images/no-image.jpg') }}" height="100" width="100">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                Name: {{$value->full_name}}<br>
                                                                Father's Name: {{$value->father_name}}<br>
                                                                Mother's Name: {{$value->mother_name}}<br>
                                                                Age: {{$value->age}}<br>
                                                                Phone: {{$value->phone}}<br>
                                                                Email: {{$value->email}}<br>
                                                                School: {{$value->school}}
                                                            </td>
                                                            <td>{{$value->grade}}</td>
                                                            <td>{{$value->district}}</td>
                                                            <td>{{$value->fb_link}}</td>
                                                            <td>
                                                                {{ ($value->status == 1 ? 'Active' : 'Inactive') }}
                                                                <a onclick="return confirm('Are You Sure?')" href="{{ route('student.control',['student_id' => $value->id]) }}" title="{{ $value['status'] == 1 ? 'Enable' : 'Disable' }}" class="text-{{ $value['status'] == 1 ? 'success' : 'danger' }} btn btn-default btn-xs waves-effect tooltips" data-placement="top" data-toggle="tooltip"><i class="fa fa-check-circle"></i></a>
                                                            </td>
                                                            <td>
                                                                {{ date('d-M-Y h:i:s A', strtotime($value->created_at)) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- panel-body -->
                            </div>
                        </div> <!-- panel -->
                    </div>
                </div> <!-- col -->
            </div>
        </div> <!-- container -->
    </div>
    <script>
        
    </script>
@endsection