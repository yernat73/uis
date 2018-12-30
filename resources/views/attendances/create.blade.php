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
                <h1 class="display-3">{{$lesson->course->name}}</h1>
                <p>
                    @foreach($lesson->course->users as $t)
                        <a href="#">{{$t->name.' '.$t->surname}}</a>
                    @endforeach
                </p>
                <div class="container">
                    <h2 class="display-4">{{$lesson->title}}</h2>
                    
                    {{ Breadcrumbs::render('attendances', $lesson) }}
                    <form method="GET" class="my-4">
                        <input hidden value="{{$lesson->id}}" name="lesson_id">
                        <select onchange="this.form.submit()" name="group_id" class="form-control rounded-0">
                            <option value="">Select Group</option>
                            @foreach($lesson->course->groups as $g)
                            <?php
                                $selected = "";
                                $group_id = "";
                                if(isset($_GET['group_id'])){
                                    $group_id = "?group_id=".$_GET['group_id'];
                                    if($_GET['group_id'] == $g->id ){
                                        $selected = "selected";
                                    }
                                }
                            ?>
                                <option value="{{$g->id}}" {{$selected}}>{{$g->name}}</option>
                            @endforeach
                        </select>    
                    
                    </form>
                   
            
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Attendance notes</th>
                                <th scope="col">Attendance value</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $s)
                                @if($s->id == $user_id)
                                <tr>
                                        <td scope="row">{{$s->id}}</td>
                                        <td>{{$s->name}}</td>
                                        <td>{{$s->surname}}</td>
                                       
                                        {!!Form::open(['action' => 'AttendancesController@store', 'method'=>'POST'])!!}
                                        {!!Form::hidden('user_id', $user_id)!!}
                                        {!!Form::hidden('lesson_id', $lesson->id)!!}
                                        <td>{!!Form::text('notes', '',['class' => 'form-control', 'placeholder' => 'Notes']) !!}</td>
                                        <td>{!!Form::checkbox('value', '1',['class' => 'custom-control']) !!}</td>
                                        <td>
                                            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                                        </td>
                                        {!!Form::close()!!}
                                        
                                    </tr>
                                @else
                                    <tr>
                                        <td scope="row">{{$s->id}}</td>
                                        <td>{{$s->name}}</td>
                                        <td>{{$s->surname}}</td>
                                        <?php
                                            $value = "";
                                            $notes = " ";
                                            foreach($attendances as $a){
                                                if($a->user_id == $s->id){
                                                    $value = $a->value;
                                                    $notes = $a->notes;
                                                }
                                            }
                                        ?>
                                        <td>{{$notes}}</td>
                                        <td>{{$value}}</td>
                                        <td>
                                            <a class="btn text-dark" role="button" href="/attendances/{{$lesson->id}}/{{$s->id}}" style="height: 40px;">
                                                <i class="material-icons md-18 p-1">mode_edit</i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    

                </div>
                
            </main>
        </div>

        <script>
            
        </script>
    @endsection
@else
    <div class="container mt-4">
        <div class="alert alert-danger">
            Unauthorized User
        </div>
    </div>
@endif
