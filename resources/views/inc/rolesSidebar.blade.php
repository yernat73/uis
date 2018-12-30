
<nav id='sidebar'>
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <h3>Select role</h3>
    </div>

    <!-- Sidebar Links -->
    <ul class="list-unstyled components">
        <li>
            <a href="/users">All</a>
        </li>
        @if(count($roles) > 0)
            @foreach($roles as $role)
                <li>
                    <a href="#role{{$role->id}}" data-toggle="collapse" aria-expanded="false">{{ucfirst($role->name)}}</a>
                    <ul class="collapse list-unstyled" id="role{{$role->id}}">
                        <a href="/users?role_id={{$role->id}}">Select</a>
                        <a href="/users/create?role_id={{$role->id}}"><i class="material-icons p-1 md-18" >add</i></a>
                    
                    </ul>
                </li>
            @endforeach
        @endif
    </ul>
    

</nav>