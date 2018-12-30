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
                <h1 class="display-3">{{$course->name}}</h1>
                <p>
                    @foreach($course->users as $t)
                        <a href="#">{{$t->name.' '.$t->surname}}</a>
                    @endforeach
                </p>
                <div>
                    <h1 class="display-4">Create Lesson</h1>
                    
                    {{ Breadcrumbs::render('create_lesson', $course) }}

                    {!! Form::open(['action' => ['LessonsController@store'], 'method'=>'POST']) !!}
                        {{Form::hidden('course_id', $course->id)}}
                        <div class="form-group">
                            {{Form::label('status', 'Status')}}
                            {{Form::select('status', ['-1' => 'Hidden', '0'=>'Not Attachable', '1'=>'Attachable'],null, ['class' => 'form-control','placeholder' => 'Pick a type...'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('title', 'Title')}}
                            {{Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('content', 'Content')}}
                            {{Form::textarea('content','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Content Text'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('deadline', 'Deadline')}}
                            {{Form::date('deadline',\Carbon\Carbon::now(),['id' => 'deadline','class' => 'form-control'])}}
                        </div>
                        
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
