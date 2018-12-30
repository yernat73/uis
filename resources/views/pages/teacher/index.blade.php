
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
            <div class="jumbotron text-center">
                {{ Breadcrumbs::render('home') }}
                <h1 class="display-4">Welcome, teacher!</h1>
                <p class="lead">This is Laravel application for Web Technologies course</p>
                <hr class="my-4 box-shadow">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            </div>
        </main>
    </div>
    
@endsection