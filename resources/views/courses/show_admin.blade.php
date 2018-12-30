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
        <a class="btn text-dark" role="button" href="/course/{{$course->id}}/edit" style="height: 40px;">
            <i class="material-icons md-18 p-1">mode_edit</i>
        </a>
        <a class="btn text-dark" role="button" href="#" id="delete-button" style="height: 40px;">
            <i class="material-icons md-18 p-1">delete</i>
        </a>
        {{ Form::open(['action' => ['CoursesController@destroy', $course->id], 'id' => 'delete-account-form']) }}

            {{ method_field('delete') }}

        {{ Form::close() }}
        
        <main class="pt-3" role="main">
            <h1 class="display-3">{{$course->name}}</h1>
            {{ Breadcrumbs::render('course', $course) }}
            <p class="lead">{!!$course->description!!}</p>
            <table class="table">
                <caption>List of teachers</caption>
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">email</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $teachers = $course->users;
                    ?>
                    @if(count($teachers) > 0)
                        @foreach($teachers as $t)
                            <tr>
                                <th scope="row">{{$t->id}}</th>
                                <td>{{$t->name}}</td>
                                <td>{{$t->surname}}</td>
                                <td>{{$t->email}}</td>
                                <td>
                                    {!! Form::open(['action' => ['CoursesController@remove_teacher', $course->id], 'method'=>'POST']) !!}
                                        <input type="number" value="{{$t->id}}" name="teacher" hidden>
                                        <button type="submit" class="btn btn-outline-dark border-0" style="color:#edeef0;">X</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <th scope="row"><label for="select"> Add Teacher </label></th>
                        <td colspan="3">
                            {!! Form::open(['action' => ['CoursesController@add_teacher', $course->id], 'method'=>'POST']) !!}
                                <select onchange="this.form.submit()" name="teacher" class="form-control" id="select">
                                    <option class="form-control" selected>...</option>
                                        
                                    @foreach($all_teachers as $t)

                                        @if(!$teachers->contains('id', $t->id))
                                            <option value="{{$t->id}}">{{$t->name.' '.$t->surname}}</option>
                                        @endif
                                    @endforeach
                                </select> 
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
    <script>
        var deleteAccountButton = document.getElementById('delete-button');
        
        deleteAccountButton.addEventListener('click', function () {
            document.getElementById('delete-account-form').submit();
            return false;
        });
    </script>
 
@endsection