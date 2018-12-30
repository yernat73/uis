@extends('layouts.admin')

@section('content')
    <main class="pt-3" role="main">
        <h1 class="display-3">Groups</h1>
        {{ Breadcrumbs::render('groups') }}
        <div class="table-responsive-md">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                @if(count($groups) > 0)
                    <tbody>
                        @foreach($groups as $g)
                            
                            <tr>                  
                                <th scope="row">{{$g->id}}</th>
                                <td><a href="/groups/{{$g->id}}" class="text-dark">{{$g->name}}</a></td>
                                <td>
                                    <a class="text-secondary" role="button" href="/groups/{{$g->id}}/edit" ><i class="material-icons md-18">mode_edit</i></a>
                                    
                                    <a class="text-secondary ml-3" role="button" href="#" id="delete-button-{{$g->id}}"><i class="material-icons md-18">delete</i></a>
                                    {{ Form::open(['action' => ['GroupsController@destroy', $g->id], 'id' => 'delete-account-form-'.$g->id]) }}

                                        {{ method_field('delete') }}

                                    {{ Form::close() }}
                                </td>
            
                            </tr>
                        @endforeach
                        <tr>
                            {!! Form::open(['action' => 'GroupsController@store', 'method'=>'POST']) !!}
                                <td scope="row">
                                    <label for="name">Name:<label>
                                </td>
                                <td>
                                    <input id="name" name="name" type="text" class="form-control">
                                </td>
                                <td>
                                    <button class="btn btn-primary">Create</button>
                                </td>
                            {!! Form::close() !!}
                        </tr>
                    </tbody>
                    @foreach($groups as $g)
                        <script>
                            var deleteAccountButton = document.getElementById('delete-button-{{$g->id}}');
                            
                            deleteAccountButton.addEventListener('click', function () {
                                document.getElementById('delete-account-form-{{$g->id}}').submit();
                                return false;
                            });
                        </script>
                    @endforeach
                @else
                    <div class="alert alert-danger mt-4">
                        No Groups found
                    </div>
                @endif
            </table>
        </div>
    </main>
@endsection