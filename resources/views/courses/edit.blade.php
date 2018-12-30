@if(Auth::user()->isAdmin())
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
                <h1 class="display-4">Edit Course</h1>
                {{ Breadcrumbs::render('course_edit', $course) }}
                {!! Form::open(['action' => ['CoursesController@update', $course->id], 'method'=>'POST']) !!}
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name',$course->name,['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('credits', 'Credits Number')}}
                        {{Form::number('credits',$course->credits,['class' => 'form-control', 'placeholder' => 'Credits Number'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Description')}}
                        {{Form::textarea('description',$course->description,['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Description Text'])}}
                    </div>
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
                
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
