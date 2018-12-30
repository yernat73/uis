<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Lesson;
use App\Course;
use App\Mark;

class MarksController extends Controller
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
        $lesson = Lesson::find($_GET['lesson_id']);
        $students = array();
        $courses = Course::getCourses();
        $marks = Mark::where('lesson_id', $lesson->id)->get();

        if(isset($_GET['group_id'])  && $_GET['group_id'] != null){
            $group = Group::find($_GET['group_id']);
            $students = $group->users;
        }else{
            $groups = $lesson->course->groups;
            foreach($groups as $g){
                foreach($g->users as $u){
                    array_push($students, $u);
                }
            }
        }
        return view('marks.index', compact('lesson', 'students', 'courses', 'marks'));
    }

    public function update_percentage(Request $request){
        $lesson = Lesson::find($request->input('lesson_id'));
        $lesson->percentage = $request->input('percentage');
        $lesson->update();
        return redirect('/marks?lesson_id='.$request->input('lesson_id'))->with('success', 'Perccentsge Updated');
    }


    public function create_or_edit($lesson_id, $user_id){
        $mark = Mark::where([
            ['lesson_id', $lesson_id],
            ['user_id',$user_id]])->first();
        if($mark != null){
            return $this->edit($mark, $lesson_id);
        }else{
            return $this->create($lesson_id, $user_id);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lesson_id, $user_id)
    {
        $lesson = Lesson::find($lesson_id);
        $students = array();
        $courses = Course::getCourses();
        $marks = Mark::where('lesson_id', $lesson->id)->get();

        if(isset($_GET['group_id']) && $_GET['group_id'] != null){
            $group = Group::find($_GET['group_id']);
            $students = $group->users;
        }else{
            $groups = $lesson->course->groups;
            foreach($groups as $g){
                foreach($g->users as $u){
                    array_push($students, $u);
                }
            }
        }
        return view('marks.create',compact('lesson', 'students', 'courses', 'marks','user_id'));
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
            'value' => 'required|max:100'
        ]);

        //Create Mark
        $m = new Mark;
        $m->value = $request->input('value');
        $m->notes = $request->input('notes');
        $m->user_id = $request->input('user_id');
        $m->lesson_id = $request->input('lesson_id');
        $m->save();
        return redirect('/marks?lesson_id='.$request->input('lesson_id'))->with('success', 'Mark Created');
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
        $courses = Course::getCourses();
        return view('marks.show', compact('course', 'courses'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($mark, $lesson_id)
    {
        
        $lesson = Lesson::find($lesson_id);
        $user_id = $mark->user_id;
        $students = array();
        $courses = Course::getCourses();
        $marks = Mark::where('lesson_id', $lesson->id)->get();

        if(isset($_GET['group_id']) && $_GET['group_id'] != null){
            $group = Group::find($_GET['group_id']);
            $students = $group->users;
        }else{
            $groups = $lesson->course->groups;
            foreach($groups as $g){
                foreach($g->users as $u){
                    array_push($students, $u);
                }
            }
        }
        return view('marks.edit',compact('lesson', 'students', 'courses', 'marks', 'mark', 'user_id'));
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
            'value' => 'required|max:100'
        ]);

        //Create Mark
        $m = Mark::find($id);
        $m->value = $request->input('value');
        $m->notes = $request->input('notes');
        $m->save();
        return redirect('/marks?lesson_id='.$m->lesson_id)->with('success', 'Mark Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
