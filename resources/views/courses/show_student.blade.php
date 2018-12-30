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
                <h4 class="my-4">
                    <a href="/marks/{{$course->id}}" class="text-dark" style="text-decoration: none;">
                        <i class="material-icons">insert_chart</i> 
                        Marks
                    </a>
                </h4>
                <h4  class="my-4">
                        <a href="/attendances/{{$course->id}}" class="text-dark" style="text-decoration: none;">
                            <i class="material-icons">recent_actors</i>
                            Attendance
                        </a>
                    </h4>
                <div class="row">
                    <div class="col-md-8 order-md-1 mb-4">
                        <span class="d-flexs">
                            <div class="mb-3"> 
                                <h4 class=""><i class="material-icons">folder_open</i> Lessons</h4>
                            </div>
                            </span>
                        <?php 
                        $lessons = $course->lessons;
                        ?>
                        @if(count($lessons) > 0)
                            @foreach($lessons as $l)
                                @if($l->status != -1)
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
                                @endif

                            @endforeach
                        @else
                            <div class="alert alert-danger">No Lesson found</div>
                        @endif
                    </div>
                    <div class="col-md-4 order-md-2 mb-4">
                        
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Deadlines</span>
                            <span class="badge badge-secondary badge-pill"></span>
                        </h4>
                        <ul class="list-group mb-3 box-shadow">
                        </ul>
                        
                    </div>

                </div>
            </div>
            
        </main>
    </div>
 
@endsection