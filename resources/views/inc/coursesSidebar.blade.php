<nav id='sidebar' class="box-shadow">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <h3>Courses</h3>
    </div>

    <!-- Sidebar Links -->
    <ul class="list-unstyled components">
        
        @if(count($courses) > 0)
            @foreach($courses as $c)
                <li>
                    <a href="/course/{{$c->id}}">{{$c->name}}</a>
                </li>
            @endforeach
        @endif
        
        @if(Auth::user()->isAdmin())
            <li>
                <a href="/course/create" class="text-center"><i class="material-icons p-1" >add</i></a>
            </li>
        @endif
    </ul>
        
    
</nav>