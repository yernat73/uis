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
                    
                    {{ Breadcrumbs::render('marks', $lesson) }}
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
                        <tr>
                            {!! Form::open(['action' => ['MarksController@update_percentage'], 'method'=>'POST']) !!}
                            
                                <td>
                                    <label for="perc">
                                        Percentage:
                                    </label>
                                </td>
                                <td>
                                    <input class="form-control" id="perc" type="number" name="percentage" value="{{$lesson->percentage}}">
                                    <input name="lesson_id" value="{{$lesson->id}}" hidden>                                    
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </td>
                            {!!Form::close()!!}
                        </tr>
                    </table>
                         
                        
                    
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Mark notes</th>
                                <th scope="col">Mark value</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $s)
                                <tr>
                                    <td scope="row">{{$s->id}}</td>
                                    <td>{{$s->name}}</td>
                                    <td>{{$s->surname}}</td>
                                    <?php
                                        $mark = " ";
                                        $notes = " ";
                                        foreach($marks as $m){
                                            if($m->user_id == $s->id){
                                                $mark = $m->value;
                                                $notes = $m->notes;
                                            }
                                        }
                                    ?>
                                    <td>{{$notes}}</td>
                                    <td>{{$mark}}</td>
                                    <td>
                                        
                                        <a class="btn text-dark" role="button" href="/marks/{{$lesson->id}}/{{$s->id}}{{$group_id}}" style="height: 40px;">
                                            <i class="material-icons md-18 p-1">mode_edit</i>
                                        </a>
                                    </td>
                                    
                                </tr>
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
