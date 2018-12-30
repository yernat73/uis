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
            {{ Breadcrumbs::render('student_marks', $course) }}
            
            
            <div class="container">
                <h3>Marks</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Lesson</th>
                            
                            <th scope="col">Mark</th>
                            <th scope="col">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0.0;
                        ?>
                        @foreach($course->lessons as $l)
                            @if($l->status == 1)
                                <tr>
                                    <td><i class="material-icons">folder</i>{{$l->title}}</tb>
                                    <td>
                                        @foreach($l->marks as $m)
                                            @if($m->user_id == Auth::user()->id)
                                                
                                                <?php
                                                $total += $m->value * ($l->percentage / 100);

                                                ?>
                                                {{$m->value}}%
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$l->percentage}}</tb>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <th scope="row">Total:</th>
                            <td colspan="2">{{$total}}/100</td>
                        </tr>
                    </tbody>

                </table>

            </div>
            
        </main>
    </div>
 
@endsection