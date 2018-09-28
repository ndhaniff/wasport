@extends('auth.admin.dashboard', ['active' => ['parent' => 'users', 'child' => null]])
@section('title')
Admin | Users
@endsection
@section('meta')

@endsection

@section('dashboard-content')

<div class="p-3">

  <!--<div class="float-right">
      <a href="{{route('admin.users.create')}}" class="btn btn-primary">Add New</a>
  </div>-->

  <h1 style="font-size: 2.2rem">Users</h1>

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.users.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search by">
          <select name="field" class="form-control">
            <option value="id">user id</option>
            <option value="email">email</option>
            <option value="name">name</option>
            <option value="firstname">firstname</option>
            <option value="lastname">lastname</option>
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>
  </div>

  <br />

  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">@sortablelink('user_id', 'User ID')</th>
      <th scope="col">@sortablelink('name', 'Name')</th>
      <th scope="col">@sortablelink('email', 'Email')</th>
      <th scope="col">@sortablelink('firstname', 'First Name')</th>
      <th scope="col">@sortablelink('lastname', 'Last Name')</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 0; ?>
    @foreach($users as $user)
    <?php $i++ ?>
    <tr>
      <th scope="row">{{$i}}</th>
      <th scope>{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->firstname}}</td>
      <td>{{$user->lastname}}</td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#userViewer-{{$user->id}}" data-id="{{$user->id}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <a href="{{route('admin.users.edit',['id'=>$user->id])}}">
          <button type="button" class="btn btn-info"><i class="far fa-edit"></i></button>
        </a>
        <?php if($user->status == 0) { ?>
          <form method="POST" action="{{route('admin.users.unblock',['id'=>$user->id])}}">
            @csrf
            <button type="submit" class="btn btn-primary"><i class="fas fa-lock-open"></i></button>
          </form>
        <?php } else { ?>
          <form method="POST" action="{{route('admin.users.block',['id'=>$user->id])}}">
            @csrf
            <button type="submit" class="btn btn-primary"><i class="fas fa-lock"></i></button>
          </form>
        <?php } ?>
        <a href="{{route('admin.users.reset',['id'=>$user->id])}}">
          <button type="button" class="btn btn-warning"><i class="fas fa-key"></i></button>
        </a>
        <!--<form method="POST" action="{{route('admin.users.destroy',['id' => $user->user_id ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
        <form method="POST" action="{{route('admin.users.edit.dupe',['id' => $user->id ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fas fa-copy"></i></button>
        </form>-->
      </div>

      <!-- The Modal -->
      <div class="modal fade" id="userViewer-{{$user->id}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <table class="admin-modal-table">
                <tr>
                  <th>User ID</th>
                  <td>{{$user->id}}</td>
                </tr>
                <tr>
                  <th>Name</th>
                  <td>{{$user->name}}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{$user->email}}</td>
                </tr>
                <tr>
                  <th>First Name</th>
                  <td><?php echo ($user->firstname) ? $user->firstname : '-'; ?></td>
                </tr>
                <tr>
                  <th>Last Name</th>
                  <td><?php echo ($user->lastname) ? $user->firstname : '-'; ?></td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td><?php echo ($user->phone) ? $user->phone : '-'; ?></td>
                </tr>
                <tr>
                  <th>Address</th>
                  <td><?php echo ($user->add_fl) ? $user->add_fl. '<br>' .$user->add_sl.'<br>' .$user->city. '<br>' .$user->postal. '<br>'. $user->state : '-'; ?></td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td><?php echo ($user->gender) ? $user->gender : '-'; ?></td>
                </tr>
                <tr>
                  <th>Motto</th>
                  <td><?php echo ($user->motto) ? $user->motto : '-'; ?></td>
                </tr>
                <tr>
                  <th>Blocked?</th>
                  <td><?php echo ($user->status == 0) ? 'No' : 'Yes'; ?></td>
                </tr>
                <tr>
                  <th>Member since</th>
                  <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d M Y');
                        echo '<td>' .$date. '</td>'?>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $users->links() }}

</div>

@endsection
