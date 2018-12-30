@if(Auth::user()->isTeacher())
    @extends('layouts.sidebar')

    @section('sidebar')
        @include('inc.coursesSidebar')
    @endsection


    @section('content')
        <div id='content' class="col">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <main class="p-3" role="main">
                <h1 class="display-3">{{$lesson->course->name}}</h1>
                <p>
                    @foreach($lesson->course->users as $t)
                        <a href="#">{{$t->name.' '.$t->surname}}</a>
                    @endforeach
                </p>
                <div class="container">
                    <h1 class="display-4">Edit Lesson</h1>
                    {{ Breadcrumbs::render('lesson_edit', $lesson) }}

                    {!! Form::open(['action' => ['LessonsController@update', $lesson->id], 'method'=>'POST']) !!}
                        
                        <div class="form-group">
                            {{Form::label('status', 'Status')}}
                            {{Form::select('status', ['-1' => 'Hidden', '0'=>'Not Attachable', '1'=>'Attachable'],$lesson->status, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('title', 'Title')}}
                            {{Form::text('title',$lesson->title,['class' => 'form-control', 'placeholder' => 'Title'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('content', 'Content')}}
                            {{Form::textarea('content',$lesson->content,['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Content Text'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('deadline', 'Deadline')}}
                            {{Form::date('deadline',\Carbon\Carbon::parse($lesson->deadline),['id' => 'deadline','class' => 'form-control'])}}
                        </div>
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
            </main>
        </div>
    @endsection
@else
    <div class="container mt-4">
        <div class="alert alert-danger">
            Unauthorized User
        </div>
    </div>
@endif
