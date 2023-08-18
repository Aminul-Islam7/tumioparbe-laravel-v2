<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Backend\Batch;
use App\Models\Backend\Course;
use App\Models\Frontend\Student;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct(){

        $this->middleware(function ($request, $next) {
            \Session::put('top_menu', "dashboard");
            \Session::put('sub_menu', "dashboard");
            return $next($request);
        });
    }

    public function index(){

        $batchWisestudents = DB::table('student_details')
            ->join('batches','batches.id','=','student_details.batch_id')
            ->select('batches.batch_name', DB::raw('count(student_details.id) as total'))
            ->groupBy('batches.batch_name')
            ->get();

        $labels = [];
        $data = [];
        
        foreach($batchWisestudents as $value){
            $labels[] = $value->batch_name ?? null;
            $data[] = $value->total ?? null;
        }

        $total_student = Student::count();
        $total_course = Course::count();
        $total_batch = Batch::count();

        return view('admin.dashboard.dashboard', compact('labels', 'data', 'total_student', 'total_course', 'total_batch'));

    }
    
}