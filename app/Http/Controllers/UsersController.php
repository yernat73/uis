<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use App\Course;
use App\Lesson;
use App\Mark;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role_id; 
        $users = array();
        $roles = Role::select()->where('name', '!=' , 'admin')->get();

        if(!isset($_GET['role_id'])){
            $role_id = Role::select('id')->where('name', '!=' , 'admin')->get();
            $roles =  Role::find($role_id);
            
            foreach($roles as $role){
                foreach($role->users as $user){
                    array_push($users, $user);
                }
            }
        }
        else{
            $role_id = $_GET['role_id'];
            $role =  Role::find($role_id);
            if($role->name != 'admin'){
                foreach($role->users as $user){
                    array_push($users, $user);
                }
            }
            
            
        }
        return view('pages.admin.users',compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        $role_id = $_GET['role_id'];
        $role = Role::find($role_id);
        $roles = Role::select()->where('name', '!=' , 'admin')->get();
        return view('pages.admin.user_create', compact('role', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|integer',
            
        ]);

        //Create User
        $u = new User;
        $u->name = $request->input('name');
        $u->surname = $request->input('surname');
        $u->email = $request->input('email');
        $u->role_id = $request->input('role');
        $u->password = Hash::make($request->input('password'));
        $u->remember_token = $request->input('_token');
        $u->save();

        return redirect('/users?role_id='.$u->role_id)->with('success', 'User Created:'.$request->input('password'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u = User::find($id);
        $roles = Role::select()->where('name', '!=' , 'admin')->get();
        return view('pages.admin.user_edit',compact('u', 'roles'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('pages.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);

        $u = User::find($id);
        $u->name = $request->input('name');
        $u->surname = $request->input('surname');
        $u->email = $request->input('email');
        $u->save();

        return redirect()->back()->with('success', 'User updated');
    }

    
    public function changePassword(Request $request, $id)
    {
        if(auth()->user()->id == $id){
            auth()->logout();
        }
        $this->validate($request,[
            'password' => 'required|string|min:6|confirmed',
        ]);

        $u = User::find($id);
        $u->password = Hash::make($request->input('password'));
        $u->remember_token = $request->input('_token');
        $u->save();

        return redirect()->back()->with('success', 'Password changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::find($id);
        $u->delete();
        return redirect()->back()->with('success', 'User deleted');
    }

    public function gpa(){
        $user = auth()->user();
        if($user->isStudent()){
            $courses = Course::getCourses();
            return view('pages.student.gpa', compact('courses'));
        }
    }

}
