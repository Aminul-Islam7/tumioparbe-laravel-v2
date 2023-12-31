@extends('frontend.layout.default')
@section('title_area', 'My Account')
@section('main_section')
<div class="welcome py-5" id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p style="background: #2da2bf; color: #fff; font-size: 18px; text-align: center;padding: 10px; text-transform: uppercase;">My Dashboard</p>
				@if(Session::has('message'))
                    <div class="alert alert-{{Session::get('class')}}">{{Session::get("message")}}</div>
                @endif
			</div>
		</div>
		<div class="row py-xl-4">
			<div class="col-lg-3 welcome-left pr-lg-5" style="border:1px solid #e2e2e2;padding: 10px;">
				@include('frontend.student.sidemenu')
			</div>
			<div class="col-lg-9" style="border:1px solid #e2e2e2; padding: 10px;">
                <div class="row" style="padding: 10px;">
                
                    <div class="col-md-4">
                        <div style="background:#000; padding:10px; border:2px solid #fff; color: #fff;">Total Courses = {{ $total_courses ?? '0' }}</div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection