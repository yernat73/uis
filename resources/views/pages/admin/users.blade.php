
@if(Auth::user()->isAdmin())
    @extends('layouts.sidebar')
    @section('sidebar')
        @include('inc.rolesSidebar')
    @endsection


    @section('content')
        <div id='content' class="col">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <main class="pt-3" role="main">
                <h1 class="display-3">Users</h1>
                
                @if(!isset($_GET['role_id']))
                    {{ Breadcrumbs::render('users') }}
                @elseif($_GET['role_id'] == 2)
                    {{ Breadcrumbs::render('students') }}
                @elseif($_GET['role_id'] == 3)
                    {{ Breadcrumbs::render('teachers') }}
                @endif
                <div class="table-responsive-md">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Role</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @if(count($users) > 0)
                            <tbody>
                                @foreach($users as $u)
                                    <tr>                  
                                        <th scope="row">{{$u->id}}</th>
                                        <td>{{$u->name}}</td>
                                        <td>{{$u->surname}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>{{$u->role->name}}</td>
                                        <td>
                                            <a class="text-secondary" role="button" href="/users/{{$u->id}}/edit"><i class="material-icons md-18">mode_edit</i></a>
                                            <a class="text-secondary ml-3" role="button" href="#" id="delete-button-{{$u->id}}"><i class="material-icons md-18">delete</i></a>
                                            {{ Form::open(['action' => ['UsersController@destroy', $u->id], 'id' => 'delete-account-form-'.$u->id]) }}

                                                {{ method_field('delete') }}

                                            {{ Form::close() }}
                                            

                                        </td>
                    
                                    </tr>
                                @endforeach
                            </tbody>
                        @else
                            <div class="alert alert-danger mt-4">
                                No Users found
                            </div>
                        @endif
                    </table>
                </div>
            </main>
        </div>
        @foreach($users as $u)
            <script>
                var deleteAccountButton = document.getElementById('delete-button-{{$u->id}}');
                
                deleteAccountButton.addEventListener('click', function () {
                    document.getElementById('delete-account-form-{{$u->id}}').submit();
                    return false;
                });
            </script>
        @endforeach
    @endsection
@else
    <div class="container mt-4">
        <div class="alert alert-danger">
            Unauthorized User
        </div>
    </div>
@endif

    
        

