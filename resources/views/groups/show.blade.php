@extends('layouts.admin')

@section('content')
    <main class="pt-3" role="main">
        <h1 class="display-4">{{$g->name}}</h1>
        
        {{ Breadcrumbs::render('group', $g) }}

        <div class="table-responsive-md">
            <table class="table">
                <caption>List of students</caption>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php
                    $students = $g->users;
                ?>
                @if(count($students) > 0)
                    <tbody>
                        @foreach($students as $s)
                            <tr>                  
                                <th scope="row">{{$s->id}}</th>
                                <td>{{$s->name}}</td>
                                <td>{{$s->surname}}</td>
                                <td>{{$s->email}}</td>
                                <td>
                                    {!! Form::open(['action' => ['GroupsController@remove_student', $g->id], 'method'=>'POST']) !!}
                                        <input type="number" value="{{$s->id}}" name="student" hidden>
                                        <button type="submit" class="btn btn-outline-dark border-0" style="color:#edeef0;">X</button>
                                    {!! Form::close() !!}
                            </tr>
                        @endforeach
                        
                    
    
                @else
                    <div class="alert alert-danger mt-4">
                        No Students found
                    </div>
                @endif
                <tr>
                    <th scope="row"><label for="select"> Add Student </label></th>
                        <td colspan="3">
                            {!! Form::open(['action' => ['GroupsController@add_student', $g->id], 'method'=>'POST']) !!}
                                <select onchange="this.form.submit()" name="student" class="form-control" id="select">
                                    <option class="form-control" selected>...</option>
                                        
                                    @foreach($all_students as $s)

                                        @if(!$students->contains('id', $s->id))
                                            <option value="{{$s->id}}">{{$s->name.' '.$s->surname}}</option>
                                        @endif
                                    @endforeach
                                </select> 
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection