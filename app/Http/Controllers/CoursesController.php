<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Group;
use App\Lesson;

class CoursesController extends Controller
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
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('courses.create', compact('courses'));
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
            'name' => 'required',
            'description' => 'required',
            'credits' => 'required'
        ]);

        //Create Course
        $c = new Course;
        $c->name = $request->input('name');
        $c->description = $request->input('description');
        $c->credits = $request->input('credits');
        $c->save();

        return redirect('/course/'.$c->id)->with('success', 'Course Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        
        $all_teachers = User::select()->where('role_id', '=' , '3')->get();
        $courses = Course::getCourses();
        if(auth()->user()->isAdmin()){
            return view('courses.show_admin',compact('courses', 'course', 'all_teachers'));
        }
        else if(auth()->user()->isTeacher()){
            $all_groups = Group::all();
            return view('courses.show_teacher', compact('courses', 'course', 'all_groups'));
        }
        else{
            return view('courses.show_student', compact('courses', 'course'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $courses = Course::all();
        return view('courses.edit',compact('courses', 'course'));
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
            'name' => 'required',
            'description' => 'required',
            'credits' => 'required',

        ]);

        //Update Course
        $c = Course::find($id);
        $c->name = $request->input('name');
        $c->description = $request->input('description');
        $c->credits = $request->input('credits');
        $c->save();

        return redirect('/course/'.$c->id)->with('success', 'Course Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_teacher(Request $request, $id)
    {
        $this->validate($request,[
            'teacher' => 'required',
        ]);

        $course = Course::find($id);
        $course->users()->attach($request->input('teacher'));

        return redirect('/course/'.$course->id)->with('success', 'Teacher Added');
    }

    public function remove_teacher(Request $request, $id)
    {
        $this->validate($request,[
            'teacher' => 'required',
        ]);

        $course = Course::find($id);
        $course->users()->detach($request->input('teacher'));

        return redirect('/course/'.$course->id)->with('success', 'Teacher Removed');
    }

    public function add_group(Request $request, $id)
    {
        $this->validate($request,[
            'group' => 'required',
        ]);

        $course = Course::find($id);
        $course->groups()->attach($request->input('group'));

        return redirect('/course/'.$course->id)->with('success', 'Group Added');
    }

    public function remove_group(Request $request, $id)
    {
        $this->validate($request,[
            'group' => 'required',
        ]);

        $course = Course::find($id);
        $course->groups()->detach($request->input('group'));

        return redirect('/course/'.$course->id)->with('success', 'Group Removed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c = Course::find($id);
        $c->delete();
        return redirect('/news')->with('success', 'Course Deleted');
    }

    
}
