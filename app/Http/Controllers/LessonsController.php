<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\Mark;

class LessonsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = $_GET['id'];
        $course = Course::find($id);
        $courses = Course::getCourses();

        if(auth()->user()->isTeacher()){
            
            return view('lessons.create', compact('courses', 'course'));
        }
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
            'title' => 'required',
            'deadline' => 'required',
            'content' => 'required'
        ]);

        //Create Lesson
        $l = new Lesson;
        $l->title = $request->input('title');
        $l->content = $request->input('content');
        $l->course_id =$request->input('course_id');
        $l->status = $request->input('status');
        $l->deadline = $request->input('deadline');
        $l->save();

        return redirect('course/'.$request->input('course_id'))->with('success', 'Lesson Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        $courses = Course::getCourses();
        if(auth()->user()->isStudent()){
            $mark = Mark::where([
                ['lesson_id', $lesson->id],
                ['user_id',auth()->user()->id]])->first();
            return view('lessons.show', compact('lesson', 'courses', 'mark'));
        }
        return view('lessons.show', compact('lesson', 'courses'));
    }
    public function edit_perc($id){
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        $courses = Course::getCourses();
        return view('lessons.edit', compact('lesson', 'courses'));
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
            'title' => 'required',
            'deadline' => 'required',
            'content' => 'required'
        ]);

        //Create Lesson
        $l = Lesson::find($id);
        $l->title = $request->input('title');
        $l->content = $request->input('content');
        $l->status = $request->input('status');
        $l->deadline = $request->input('deadline');
        $l->save();

        return redirect('course/'.$l->course_id)->with('success', 'Lesson Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $l = Lesson::find($id);
        $l->delete();

        return redirect('course/'.$l->course->id)->with('success', 'Lesson Deleted');
    }
}
