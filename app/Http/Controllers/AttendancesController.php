<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Lesson;
use App\Course;
use App\Attendance;

class AttendancesController extends Controller
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
        $attendances = Attendance::where('lesson_id', $lesson->id)->get();

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
        return view('attendances.index', compact('lesson', 'students', 'courses', 'attendances'));
    
    }

    public function create_or_edit($lesson_id, $user_id){
        $attendance = Attendance::where([
            ['lesson_id', $lesson_id],
            ['user_id',$user_id]])->first();
        if($attendance != null){
            return $this->edit($attendance, $lesson_id);
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
        $attendances = Attendance::where('lesson_id', $lesson->id)->get();

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
        return view('attendances.create',compact('lesson', 'students', 'courses', 'attendances','user_id'));
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
            'value' => 'max:1|min:0'
        ]);

        //Create Attendance
        $a = new Attendance;
        if($request->input('value') == null){
            $a->value = 0;
        }else{
            $a->value = $request->input('value');
        }
        $a->notes = $request->input('notes');
        $a->user_id = $request->input('user_id');
        $a->lesson_id = $request->input('lesson_id');
        $a->save();
        return redirect('/attendances?lesson_id='.$request->input('lesson_id'))->with('success', 'Attendance Created');
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
        return view('attendances.show', compact('course', 'courses'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($attendance, $lesson_id)
    {
        
        $lesson = Lesson::find($lesson_id);
        $user_id = $attendance->user_id;
        $students = array();
        $courses = Course::getCourses();
        $attendances = Attendance::where('lesson_id', $lesson->id)->get();

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
        return view('attendances.edit',compact('lesson', 'students', 'courses', 'attendances', 'attendance', 'user_id'));
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
            'value' => 'max:1|min:0'
        ]);

        //UpdateAttendance
        $a = Attendance::find($id);
        if($request->input('value') == null){
            $a->value = 0;
        }else{
            $a->value = $request->input('value');
        }
        $a->notes = $request->input('notes');
        $a->save();
        return redirect('/attendances?lesson_id='.$request->input('lesson_id'))->with('success', 'Attendance Updated');
 
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
