<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
class GroupsController extends Controller
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
        $groups = Group::all(); 
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
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
            'name' => 'required'
        ]);

        //Create Group
        $g = new Group;
        $g->name = $request->input('name');
        $g->save();

        return redirect('groups')->with('success', 'Group Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $g = Group::find($id);
        $all_students = User::select()->where('role_id', '=' , '2')->get();
        return view('groups.show', compact('g', 'all_students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $groups = Group::all(); 
        return view('groups.edit', compact('group','groups'));
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
            'name' => 'required'
        ]);

        //Update Group
        $g = Group::find($id);
        $g->name = $request->input('name');
        $g->save();

        return redirect('groups')->with('success', 'Group Updated');
    }

    public function add_student(Request $request, $id)
    {
        $this->validate($request,[
            'student' => 'required',
        ]);

        $group = Group::find($id);
        $group->users()->attach($request->input('student'));

        return redirect('/groups/'.$group->id)->with('success', 'Student Added');
    }

    public function remove_student(Request $request, $id)
    {
        $this->validate($request,[
            'student' => 'required',
        ]);

        $group = Group::find($id);
        $group->users()->detach($request->input('student'));

        return redirect('/groups/'.$group->id)->with('success', 'Student Removed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $g = Group::find($id);
        $g->delete();

        return redirect('groups')->with('success', 'Group Deleted');
    }
}
