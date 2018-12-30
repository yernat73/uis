@extends('layouts.admin')

@section('content')
    <div class="jumbotron text-center">
        {{ Breadcrumbs::render('home') }}
        
        <h1 class="display-4">Welcome, admin!</h1>
        <p class="lead">This is Laravel application for Web Technologies course</p>
        <hr class="my-4 box-shadow">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    </div>
@endsection