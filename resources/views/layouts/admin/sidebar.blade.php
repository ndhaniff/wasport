<aside class="sidebar">
      <li class="{{($active == '') ? 'active' : ''}}"><a href="{{route('admin.dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      @if(is_array($active ))
        <li class="{{($active['parent'] == 'races') ? 'active' : ''}}"><a href="{{route('admin.races')}}"><i class="fas fa-flag-checkered"></i> Races</a></li>
          <!--<div class="children">
            <li class="{{($active['child'] == 'create') ? 'active' : ''}}"><a href="{{route('admin.races.create')}}">Add New Races</a></li>
          </div>-->
      @else
        <li class=""><a href="{{route('admin.races')}}"><i class="fas fa-flag-checkered"></i> Races</a></li>
          <!--<div class="children">
            <li class=""><a href="{{route('admin.races.create')}}">Add New Races</a></li>
          </div>-->
      @endif

      @if(is_array($active ))
        <li class="{{($active['parent'] == 'addons') ? 'active' : ''}}"><a href="{{route('admin.addons')}}"><i class="fas fa-plus-square"></i> Addons</a></li>
          <!--<div class="children">
            <li class="{{($active['child'] == 'create') ? 'active' : ''}}"><a href="{{route('admin.addons.create')}}">Add New Addons</a></li>
          </div>-->
      @else
        <li class=""><a href="{{route('admin.addons')}}"><i class="fas fa-plus-square"></i> Addons</a></li>
          <!--<div class="children">
            <li class=""><a href="{{route('admin.addons.create')}}">Add New Addons</a></li>
          </div>-->
      @endif

      @if(is_array($active ))
        <li class="{{($active['parent'] == 'users') ? 'active' : ''}}"><a href="{{route('admin.users')}}"><i class="fas fa-user"></i> Users</a></li>
      @else
        <li class=""><a href="{{route('admin.users')}}"><i class="fas fa-user"></i> Users</a></li>
      @endif

      @if(is_array($active ))
        <li class="{{($active['parent'] == 'medals') ? 'active' : ''}}"><a href="{{route('admin.medals')}}"><i class="fas fa-medal"></i> Medals</a></li>
      @else
        <li class=""><a href="{{route('admin.medals')}}"><i class="fas fa-medal"></i> Medals</a></li>
      @endif

      @if(is_array($active ))
        <li class="{{($active['parent'] == 'contacts') ? 'active' : ''}}"><a href="{{route('admin.contacts')}}"><i class="fas fa-envelope"></i> Contacts</a></li>
      @else
        <li class=""><a href="{{route('admin.contacts')}}"><i class="fas fa-envelope"></i> Contact</a></li>
      @endif
</aside>
