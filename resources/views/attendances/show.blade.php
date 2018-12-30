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
            {{ Breadcrumbs::render('student_attendance', $course) }}
            
            
            <div class="container">
                <h3>Attendances</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Lesson</th>
                            
                            <th scope="col">Attendance</th>
                            <th scope="col">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0.0;
                        $counter = 0;
                        ?>
                        @foreach($course->lessons as $l)
                            @if($l->status == 1)
                                <tr>
                                    <td><i class="material-icons">folder</i>{{$l->title}}</tb>
                                    
                                        @if(count($l->attendances) > 0)
                                            @foreach($l->attendances as $a)
                                                @if($a->user_id == Auth::user()->id)
                                                    
                                                    <?php
                                                    $total += $a->value;
                                                    $counter++;
                                                    ?>
                                                    <td>{{$a->value}}</td><td>{{$a->notes}}</tb>
                                                @endif
                                            @endforeach
                                        @endif
                                   
                                    
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <th scope="row">Total:</th>
                            <td colspan="2">{{($total/($counter != 0 ? $counter : 1))*100 }}%</td>
                        </tr>
                    </tbody>

                </table>

            </div>
            
        </main>
    </div>
 
@endsection