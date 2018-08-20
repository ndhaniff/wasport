<aside class="sidebar">
      <li class="{{($active == '') ? 'active' : ''}}"><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      @if(is_array($active ))
        <li class="{{($active['parent'] == 'races') ? 'active' : ''}}"><a href="{{route('admin.races')}}"><i class="fa fa-flag-checkered"></i> Races</a></li>
          <div class="children">
            <li class="{{($active['child'] == 'create') ? 'active' : ''}}"><a href="{{route('admin.races.create')}}">Add New Races</a></li>
        <div>
      @else
        <li class=""><a href="{{route('admin.races')}}"><i class="fa fa-flag-checkered"></i> Races</a></li>
          <div class="children">
            <li class=""><a href="{{route('admin.races.create')}}">Add New Races</a></li>
        <div>
      @endif
      <li><a href="#"><i class="fa fa-user-circle-o"></i> User</a></li>
</aside>


