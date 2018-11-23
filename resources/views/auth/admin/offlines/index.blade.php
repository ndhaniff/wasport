@extends('auth.admin.dashboard', ['active' => ['parent' => 'offlines', 'child' => null]])
@section('title')
Admin | Offline Races
@endsection
@section('meta')

@endsection

@section('dashboard-content')

<div class="p-3">

  <div class="float-right">
      <a href="{{route('admin.offlines.create')}}" class="btn btn-primary">Add New</a>
  </div>

  <h1 style="font-size: 2.2rem">Offline Races</h1>

  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.offlines.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search race title">
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>
    <div class="col-sm-4">
      <form action="{{route('admin.offlines.filter')}}" method="get">
        <div class="input-group">
          <select name="stateitem">
            <option value=”” disabled selected>Filter state</option>
            <option value="Johor">Johor</option>
            <option value="Kedah">Kedah</option>
            <option value="Kelantan">Kelantan</option>
            <option value="Kuala Lumpur">Kuala Lumpur</option>
            <option value="Labuan">Labuan</option>
            <option value="Melaka">Melaka</option>
            <option value="Negeri Sembilan">Negeri Sembilan</option>
            <option value="Pahang">Pahang</option>
            <option value="Perak">Perak</option>
            <option value="Perlis">Perlis</option>
            <option value="Pulau Pinang">Pulau Pinang</option>
            <option value="Sabah">Sabah</option>
            <option value="Sarawak">Sarawak</option>
            <option value="Selangor">Selangor</option>
            <option value="Terengganu">Terengganu</option>
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Filter</button>
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
      <th scope="col">Event Date</th>
      <th scope="col">@sortablelink('state', 'State')</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php $i= 0; ?>
    @foreach($offlines as $offline)
    <tr>
      <th scope="row">{{$i+1}}</th>
      <td>{{$offline->title_en}}</td>
      <td><?= DateTime::createFromFormat('Y-m-d', $offline->date)->format('d M Y'); ?></td>
      <td>{{$offline->state}}</td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#offlineViewer-{{$offline->fid}}" data-id="{{$offline->fid}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <a href="{{route('admin.offlines.edit',['fid'=>$offline->fid])}}">
          <button type="button" class="btn btn-info"><i class="far fa-edit"></i></button>
        </a>
        <form method="POST" action="{{route('admin.offlines.destroy',['fid' => $offline->fid ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
      </div>

      <!-- The Modal -->
      <div class="modal fade" id="offlineViewer-{{$offline->fid}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <table class="admin-modal-table">
                <tr>
                  <th rowspan="3">Offline Race</th>
                  <td>EN</td>
                  <td><?php echo ($offline->title_en) ? $offline->title_en : '-'; ?></td>
                </tr>
                <tr>
                  <td>MS</td>
                  <td><?php echo ($offline->title_ms) ? $offline->title_ms : '-'; ?></td>
                </tr>
                <tr>
                  <td>ZH</td>
                  <td><?php echo ($offline->title_zh) ? $offline->title_zh : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Date</th>
                  <td><?php echo ($offline->date) ? $offline->date : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Location</th>
                  <td><?php echo ($offline->location) ? $offline->location : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">State</th>
                  <td><?php echo ($offline->state) ? $offline->state : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Category</th>
                  <td><?php echo ($offline->category) ? $offline->category : '-'; ?></td>
                </tr>
                <tr>
                  <th colspan="2">Website</th>
                  <td><?php echo ($offline->website) ? $offline->website : '-'; ?></td>
                </tr>
                <tr>
                <th colspan="2">Image</th>
                  <td><?php echo ($offline->header != 'noimage.png') ? 'uploaded' : '-'; ?></td>
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

{{ $offlines->links() }}

</div>

@endsection
