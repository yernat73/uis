@extends('layouts.sidebar')

@section('sidebar')
    @include('inc.coursesSidebar')
@endsection


@section('content')
    <div id='content' class="mx-auto" style="width: 70%; position: relative;">
        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <main class="pt-3">
            <h1 class="display-3">News</h1>
            {{ Breadcrumbs::render('news') }}
            <div class="sticky-top box-shadow">
                <form method="GET" action="{{route('news.index')}}">
                    <div class="input-group rounded-0" id="adv-search">
                        <input type="text" class="form-control rounded-0" placeholder="Search for News" name="key" value="{{isset($key) ? $key : ''}}" />
                        <div class="input-group-btn">
                            <div class="btn-group" role="group">
                                <button type="submit" class="btn btn-primary"><i class="material-icons p-1">search</i></button>
                                @if(Auth::user()->isAdmin())
                                    <a class="btn btn-light" href="news/create" role="button"><i class="material-icons p-1">add</i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            

            @if(count($news) > 0)
                @foreach($news as $n)
                <div class="jumbotron px-4 pt-3 my-2 bg-white">
                <p class="text-muted">Written on {{$n->created_at->format('l jS F Y \a\t g:ia ')}} by <a class="text-dark" href="#">{{$n->user->name}}</a></p>
                    <div class="container">
                        <h5 class="display-4"><a class="text-dark" href="news/{{$n->id}}" style="text-decoration: none;">{{$n->title}}</a></h5>
                        <div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 100ch;">
                            {!!$n->content!!}
                        </div>
                    </div>
            
                </div>
                @endforeach
                {{$news->appends(['key' => $key])->links()}}
            @else
                <div class="alert alert-danger mt-4">
                    No News found
                </div>
            @endif
        </main>
    </div>
@endsection