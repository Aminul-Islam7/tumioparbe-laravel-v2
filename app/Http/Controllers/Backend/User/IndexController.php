<?php

namespace App\Http\Controllers\Backend\User;

use DB;
use Auth;
use View;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{

    public function __construct() {

        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"administrator");
            Session::put('sub_menu',"administrator");
            return $next($request);
        });
    }

    public function index(){
        $users = User::all();
    	return view('admin.user.index',['allUsers' => $users]);
    }

    public function store(
        Request $request,
        ?int $userId = null        
    ){

        if($userId != null){
            $this->validate($request, [
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|unique:users,email,'.$userId,
                'mobile'  => ['required', 'regex:/^(\\+88|88)?(01){1}[3456789]{1}(\\d){8}$/'], // Regular expression pattern for 10-digit mobile number
            ]);
        }else{
            $this->validate($request, [
                'name'        => 'required|string|max:255',
                'email'       => 'required|string|email|max:255|unique:users',
                'mobile'      => ['required', 'regex:/^(\\+88|88)?(01){1}[3456789]{1}(\\d){8}$/'], // Regular expression pattern for 10-digit mobile number
                'password'    => 'min:6',
                'confirm_password' => 'required_with:password|same:password|min:6',
            ]);
        }

        if($userId != null){
            $user = User::find($userId);
        }else{
            $user = new User;
        }

        if ($request->hasFile('photo')) {
            if($userId != null){
                $oldImage = $user->photo;
                if(file_exists($oldImage)){
                    unlink($oldImage);
                }
            }
            $folder = "admin/users/";
            $pictureinfo = $request->file("photo");
            $picture_name = "USER-" . time() . ".". $pictureinfo->getClientOriginalExtension();
            $pictureinfo->move(public_path($folder), $picture_name);
            $picture_url = $folder . $picture_name;
        } else {
            if($userId != null){
                $picture_url = $user->photo;
            }else{
                $picture_url = '';
            }
        }

        $user->photo = $picture_url;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        if($userId == null){
            $user->password = bcrypt($request->password);
        }
        if($user->save()){
            setMessage('message', 'success', 'Saved Successfully.');
        }else{
            setMessage('message', 'danger', 'Failed');
        }
        if($userId != null){
            return redirect('/admin/user/edit/'.$userId);
        }else{
            return redirect()->back();
        }
    }

    public function edit($id){
    	$userByID = User::find($id);
    	return view('admin.user.edit',['userByID' => $userByID]);
    }

    public function changePassword(Request $request){
    
        $this->validate($request, [
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $user = User::find($request->id);
        $user->password = bcrypt($request->password);
        if($user->save()){
            setMessage("message","success","Change Successful.");
        }else{
            setMessage("message","danger","Failed to change.");
        }
        return redirect('/admin/user/edit/'.$request->id);
    }

    public function control($id)
    {
        $data = User::findorfail($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->save();
        setMessage("message", "success", "Successfully");
        return redirect()->back();
    }

    public function destroy($id)
    {
        $data       =  User::find($id);
        if(file_exists($data->photo)){
            unlink($data->photo);
        }
        $success    =  $data->delete();
         if($success){
            setMessage("message", "success", "Successfully");
         }else{
             setMessage("message", "danger", "Failed");
         }
         return redirect()->back();
    }

}