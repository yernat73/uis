@if(Auth::user()->isTeacher() || Auth::user()->isStudent())
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
            @if(Auth::user()->isTeacher())
                <a class="btn text-dark" role="button" href="/lesson/{{$lesson->id}}/edit" style="height: 40px;">
                    <i class="material-icons md-18 p-1">mode_edit</i>
                </a>
                <a class="btn text-dark" role="button" href="#" id="delete-button" style="height: 40px;">
                    <i class="material-icons md-18 p-1">delete</i>
                </a>
                {{ Form::open(['action' => ['LessonsController@destroy', $lesson->id], 'id' => 'delete-account-form']) }}
        
                    {{ method_field('delete') }}
        
                {{ Form::close() }}
            @endif
            <main class="p-3" role="main">
                <h1 class="display-3">{{$lesson->course->name}}</h1>
                <p>
                    @foreach($lesson->course->users as $t)
                        <a href="#">{{$t->name.' '.$t->surname}}</a>
                    @endforeach
                </p>
                <div class="container">
                    <h2 class="display-4">{{$lesson->title}}</h2>
                    {{ Breadcrumbs::render('lesson', $lesson) }}

                    <p>{!!$lesson->content!!}</p>
                    @if($lesson->status == 1)
                        <p class="text-muted">Deadline on {{$lesson->deadline}}</p>
                    @endif
                    <hr class="box-shadow">
                    @if($lesson->status == 1)
                        @if(Auth::user()->isTeacher())
                            
                            <h4 class="d-flex justify-content-between align-items-center m-3">
                                <a href="/marks?lesson_id={{$lesson->id}}" class="text-dark" style="text-decoration: none;">
                                    <i class="material-icons">insert_chart</i> 
                                    Marks
                                </a>
                                <a href="/attendances?lesson_id={{$lesson->id}}" class="text-dark" style="text-decoration: none;">
                                    <i class="material-icons">recent_actors</i>
                                    Attendance
                                </a>
                            </h4>
                            
                            
    
                        @endif

                        @if(Auth::user()->isStudent())
                            <h4>Mark</h4>
                            <table class="table table-striped">
                                <tbody>
                                    @if($mark)
                                        <tr>
                                            <td scope="row">
                                                Status:
                                            </td>
                                            <td>
                                                Marked
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">
                                                Value:
                                            </td>
                                            <td>
                                                {{$mark->value}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">
                                                Notes:
                                            </td>
                                            <td>
                                                {{$mark->notes}}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td scope="row">
                                                Status:
                                            </td>
                                            <td>
                                                Not marked yet
                                            </td>
                                        </tr>
                                    @endif
                                </tbody> 
                            </table>
                        @endif
                    @endif
                    
                    

                </div>
                
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
@else
    <div class="container mt-4">
        <div class="alert alert-danger">
            Unauthorized User
        </div>
    </div>
@endif
