
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
            <div class="btn-group-sm float-right" role="group">
                @if(Auth::user()->id == $n->user->id)
                    <a class="btn text-dark" role="button" href="/news/{{$n->id}}/edit"><i class="material-icons md-18">mode_edit</i></a>
                    <a class="btn text-dark" role="button" href="#" id="delete-button"><i class="material-icons md-18">delete</i></a>
                    {{ Form::open(['action' => ['NewsController@destroy', $n->id], 'id' => 'delete-account-form']) }}
        
                        {{ method_field('delete') }}
        
                    {{ Form::close() }}
                @endif
            </div>
        
            <div class="container">
                    {{ Breadcrumbs::render('post', $n) }}
                <h5 class="display-4">{{$n->title}}</h5>
                
                <p>{!!$n->content!!}</p>
                <hr>
                <p class="text-muted">Written on {{$n->created_at->format('l jS F Y \a\t g:ia ')}} by <a class="text-dark" href="#">{{$n->user->name}}</a></p>
                
            </div>
            <script>
                var deleteAccountButton = document.getElementById('delete-button');
                
                deleteAccountButton.addEventListener('click', function () {
                    document.getElementById('delete-account-form').submit();
                    return false;
                });
            </script>
            
        </main>
    </div>
@endsection
