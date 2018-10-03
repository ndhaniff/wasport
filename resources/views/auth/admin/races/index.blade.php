@extends('auth.admin.dashboard', ['active' => ['parent' => 'races', 'child' => null]])
@section('title')
Admin | Races
@endsection
@section('meta')

@endsection

@section('dashboard-content')

<div class="p-3">

  <div class="float-right">
      <a href="{{route('admin.races.create')}}" class="btn btn-primary">Add New</a>
  </div>

  <h1 style="font-size: 2.2rem">Races</h1>

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.races.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search race title">
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
      <th scope="col">@sortablelink('title_en', 'Title')</th>
      <th scope="col">@sortablelink('date_from', 'Race Date From')</th>
      <th scope="col">@sortablelink('date_to', 'Race Date To')</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $i= 0; ?>
    @foreach($races as $race)
    <tr>
      <th scope="row">{{$i+1}}</th>
      <td>{{$race->title_en}}</td>
      <td><?= DateTime::createFromFormat('Y-m-d', $race->date_from)->format('d M Y'); ?></td>
      <td><?= DateTime::createFromFormat('Y-m-d', $race->date_to)->format('d M Y'); ?></td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#raceViewer-{{$race->rid}}" data-id="{{$race->rid}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <a href="{{route('admin.races.edit',['rid'=>$race->rid])}}">
          <button type="button" class="btn btn-info"><i class="far fa-edit"></i></button>
        </a>
        <form method="POST" action="{{route('admin.races.destroy',['rid' => $race->rid ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
        <!--<form method="POST" action="{{route('admin.races.edit.dupe',['rid' => $race->rid ])}}">
          @csrf
          <button type="submit" class="btn btn-primary"><i class="fas fa-copy"></i></button>
        </form>-->
      </div>

      <!-- The Modal -->
      <div class="modal fade" id="raceViewer-{{$race->rid}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <table class="admin-modal-table">
                <tr>
                  <th rowspan="3">Race</th>
                  <td>EN</td>
                  <td><?php echo ($race->title_en) ? $race->title_en : '-'; ?></td>
                </tr>
                <tr>
                  <td>MS</td>
                  <td><?php echo ($race->title_ms) ? $race->title_ms : '-'; ?></td>
                </tr>
                <tr>
                  <td>ZH</td>
                  <td><?php echo ($race->title_zh) ? $race->title_zh : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Race Date</th>
                  <td><?php echo ($race->date_from) ? $race->date_from. ' (' .$race->time_from. ')' : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Race Deadline</th>
                  <td><?php echo ($race->date_to) ? $race->date_to. ' (' .$race->time_to. ')' : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Register Date</th>
                  <td><?php echo ($race->dead_from) ? $race->dead_from. ' (' .$race->deadtime_from. ')' : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Register Deadline</th>
                  <td><?php echo ($race->dead_to) ? $race->dead_to. ' (' .$race->deadtime_to. ')' : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Price</th>
                  <td><?php echo ($race->price) ? $race->price : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Category</th>
                  <td><?php echo ($race->category) ? $race->category : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Engrave</th>
                  <td><?php echo ($race->engrave) ? $race->engrave : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Image</th>
                  <td><?php echo ($race->header != 'noimage.png') ? 'uploaded' : '-'; ?></td>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div>

      </td>
    </tr>
    <?php $i++ ?>
    @endforeach
  </tbody>
</table>

{{ $races->links() }}

</div>

@endsection
