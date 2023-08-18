@extends('admin.layout.default')
@section('title_area', 'Update Enroll Course')
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get('class')}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                <form action="{{ route('enroll.update', ['id' => $selected_info->id ?? null]) }}" name="editform" method="POST">
                @csrf
                    <div class="col-sm-12">
                        <div class="panel-group panel-group-joined" id="accordion-test">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                            Course Enroll Details Update
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="category">Full Name</label><small class="req">*</small>
                                                <input required name="full_name" placeholder="Full Name" type="text" value="{{ $selected_info->full_name }}" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Course <span style="color:#DC3545">*</span></label>
                                                <select required id="course_id" name="course_id" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">--Select Course--</option>
                                                    @foreach($all_courses as $value)
                                                        <option value="{{ $value->id }}">{{ $value->course_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Batch <span style="color:#DC3545">*</span></label>
                                                <select name="batch_id" class="form-control selectpicker" data-live-search="true" required>
                                                    <option value="">--Select Batch--</option>
                                                    @foreach($all_batches as $value)
                                                        <option value="{{ $value->id }}">{{ $value->batch_name }} ({{ $value->batch_timing }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group pull-left m-t-22">
                                                <input type="submit" class=" btn btn-primary pull-right" value="Update" name="submit" />
                                            </div>
                                        </div>
                                    </div> <!-- panel-body -->
                                </div>
                            </div> <!-- panel -->
                        </div>
                    </div> <!-- col -->
                </form>
            </div> <!-- End row -->
        </div> <!-- container -->
    </div>
    <script type="text/javascript">
        document.forms['editform'].elements['course_id'].value='{{ $selected_info->course_id }}';
        document.forms['editform'].elements['batch_id'].value='{{ $selected_info->batch_id }}';
    </script>
@endsection