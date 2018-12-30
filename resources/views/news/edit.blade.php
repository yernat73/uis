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
                @if(Auth::user()->id == $n->user->id)
                    <h1 class="display-4">Edit News</h1>
                    {{ Breadcrumbs::render('post_edit', $n) }}
                    {!! Form::open(['action' => ['NewsController@update', $n->id], 'method'=>'POST']) !!}
                        <div class="form-group">
                            {{Form::label('title', 'Title')}}
                            {{Form::text('title', $n->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('content', 'Content')}}
                            {{Form::textarea('content', $n->content, ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Content Text'])}}
                        </div>
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Submit', ['class' => 'btn btn-primary mb-4'])}}
                    {!! Form::close() !!}
                
                @else
                <div class="container mt-4">
                    <div class="alert alert-danger">
                        You cannot edit this
                    </div>
                </div>
                @endif
                
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
