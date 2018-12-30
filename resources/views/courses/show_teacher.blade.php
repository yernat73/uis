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
            
            <h1 class="display-3">{{$course->name}}</h1>
            <p>
                @foreach($course->users as $t)
                    <a href="#">{{$t->name.' '.$t->surname}}</a>
                @endforeach
            </p>
            {{ Breadcrumbs::render('course', $course) }}
            <p class="lead">{!!$course->description!!}</p>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-md-1 mb-4">
                        <span class="d-flexs">
                            <div class="mb-3"> 
                                <h4 class=""><i class="material-icons">folder_open</i> Lessons <a href="/lesson/create?id={{$course->id}}" class="badge badge-secondary badge-pill p-0"><i class="material-icons m-1" >add</i></a></h4>
                            </div>
                            </span>
                        <?php 
                        $lessons = $course->lessons;
                        ?>
                        @if(count($lessons) > 0)
                            @foreach($lessons as $l)
                                
                                <div class="card m-4 rounded-0 box-shadow">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="/lesson/{{$l->id}}" style="text-decoration: none;">
                                                <i class="material-icons m-0">folder</i>
                                                {{$l->title}}
                                            </a>
                                        </h5>

                                    </div>
                                    <div class="card-footer text-muted">
                                        @if($l->status == 1)
                                            <?php
                                                $deadline = \Carbon\Carbon::parse($l->deadline);
                                                $now = \Carbon\Carbon::now();
                                                $diff = $deadline->diffForHumans($now); 
                                            ?>
                                            @if($now->gt($deadline))
                                                Deadline has passed!
                                            @else
                                                {{$diff}}
                                            @endif
                                            
                                        @endif
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div class="alert alert-danger">No Lesson found</div>
                        @endif
                    </div>
                    <div class="col-md-4 order-md-2 mb-4">
                        <?php
                            $groups = $course->groups;
                            ?>
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Groups</span>
                            <span class="badge badge-secondary badge-pill">{{count($groups)}}</span>
                        </h4>
                        <ul class="list-group mb-3 box-shadow">
                            @if(count($groups) > 0)
                                @foreach($groups as $g)
                                    <li class="list-group-item d-flex justify-content-between lh-condensed  rounded-0 ">
                                        <div>
                                            <h6 class="m-2"><b>{{$g->name}}</b></h6>
                                        </div>
                                        <span>
                                            {!! Form::open(['action' => ['CoursesController@remove_group', $course->id], 'method'=>'POST']) !!}
                                                <input type="number" value="{{$g->id}}" name="group" hidden>
                                                <button type="submit" class="btn btn-outline-dark border-0" style="color:#edeef0;">X</button>
                                            {!! Form::close() !!}
                                        </span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        {!! Form::open(['action' => ['CoursesController@add_group', $course->id], 'method'=>'POST', 'class'=>'card p-2 srounded-0 ']) !!}
                            <div class="input-group">
                                <select onchange="this.form.submit()" name="group" class="form-control" id="select">
                                    <option class="form-control" selected>...</option>
                                        
                                    @foreach($all_groups as $g)

                                        @if(!$groups->contains('id', $g->id))
                                            <option value="{{$g->id}}">{{$g->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
            
        </main>
    </div>
 
@endsection