<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $courses = Course::getCourses();
            if(Auth::user()->isAdmin()){
                return view('pages.admin.index', compact('courses'));
            }
            if(Auth::user()->isTeacher()){
                return view('pages.teacher.index', compact('courses'));
            }
            if(Auth::user()->isStudent()){
                return view('pages.student.index', compact('courses'));
            }
        }
        else{
            return view('auth.login');
        }
    }
}
