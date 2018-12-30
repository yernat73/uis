
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
                <h1 class="display-4">Create News</h1>
                {{ Breadcrumbs::render('create_news') }}
                
                {!! Form::open(['action' => 'NewsController@store', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::text('title','',['class' => 'form-control', 'placeholder' => 'Title'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Content')}}
                        {{Form::textarea('content','',['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Content Text'])}}
                    </div>
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
