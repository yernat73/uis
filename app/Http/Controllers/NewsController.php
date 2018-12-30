<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Course;
class NewsController extends Controller
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


    public function index(Request $request)
    {   
        $key = $request->input('key');
      
        $news = News::orderBy('created_at', 'desc')
        ->search($key)
        ->paginate(5);
        $courses = Course::getCourses();
        

        return view('news.index', compact('news', 'key', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::getCourses();
        return view('news.create', compact('courses'));
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
            'content' => 'required'
        ]);

        //Create News
        $n = new News;
        $n->title = $request->input('title');
        $n->content = $request->input('content');
        $n->user_id = auth()->user()->id;
        $n->save();

        return redirect('news')->with('success', 'News Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courses = Course::getCourses();
        $n = News::find($id);
        return view('news.show', compact('n', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $n = News::find($id);
        $courses = Course::all();
        return view('news.edit', compact('n', 'courses'));
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
            'content' => 'required'
        ]);

        //Create News
        $n = News::find($id);
        $n->title = $request->input('title');
        $n->content = $request->input('content');
        $n->save();

        return redirect('news')->with('success', 'News Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $n = News::find($id);
        $n->delete();
        return redirect('news')->with('success', 'News Removed');
    }
}
