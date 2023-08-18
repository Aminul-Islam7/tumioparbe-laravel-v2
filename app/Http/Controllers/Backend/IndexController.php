<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Frontend\Student;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Frontend\StudentDetail;

class IndexController extends Controller
{

    public function __construct(){

        $this->middleware(function ($request, $next) {
            \Session::put('top_menu', "student");
            \Session::put('sub_menu', "student");
            return $next($request);
        });
    }

    public function index(){
        $data['get_all'] = Student::all();
        return view("admin.student.index", $data);
    }

    public function studentEnrollCourse(){
        \Session::put('sub_menu', "student_enroll");
        $data['get_all'] = DB::table("student_details as SD")
            ->join('courses as C', 'SD.course_id', '=', 'C.id')
            ->join('batches as B', 'SD.batch_id', '=', 'B.id')
            ->join('students as S', 'SD.student_id', '=', 'S.id')
            ->select('SD.*', 'C.course_name', 'C.admission_fee', 'B.batch_name', 'B.group_link', 'S.full_name', 'S.photo')
            ->get();
        return view("admin.student.enroll_details", $data);
    }

    public function control($id){

        $data = Student::findorfail($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->save();
        setMessage("message", "success", "Operation Successful");
        return redirect()->back();
    }

    public function enroll_control($id){
        
        $data = StudentDetail::findorfail($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->save();
        setMessage("message", "success", "Operation Successful");
        return redirect()->back();
    }


}