@extends('auth.admin.dashboard', ['active' => ['parent' => 'contacts', 'child' => null]])
@section('title')
Admin | Contacts
@endsection
@section('meta')

@endsection

@section('dashboard-content')
<?php $i=1 ?>
<div class="p-3">

  <h1 style="font-size: 2.2rem">Contacts</h1>

  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <hr />

  <div class="row">
    <div class="col-sm-4">
      <form action="{{route('admin.contacts.search')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search by">
          <select name="field" class="form-control">
            <option value="name">name</option>
            <option value="email">email</option>
            <option value="phone">phone</option>
          </select>
          <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
    </div>

    <div class="col-sm-4">
      <form action="{{route('admin.contacts.filter')}}" method="get">
        <div class="input-group">
          <select name="categoryitem">
            <option value=”” disabled selected>Filter category</option>
            <option value="Registration Enquiry">Registration Enquiry</option>
            <option value="Account Enquiry">Account Enquiry</option>
            <option value="Payment Enquiry">Payment Enquiry</option>
            <option value="Shipping Enquiry">Shipping Enquiry</option>
            <option value="Appeal">Appeal</option>
            <option value="Technical Issues">Technical Issues</option>
            <option value="Submit Question">Submit Question</option>
            <option value="Other">Other</option>
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
      <th scope="col">@sortablelink('name', 'Name')</th>
      <th scope="col">@sortablelink('email', 'Email')</th>
      <th scope="col">Phone</th>
      <th scope="col">@sortablelink('category', 'Category')</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($contacts as $contact)
    <tr>
      <th scope="row">{{$i++ .'.'}}</th>
      <td>{{$contact->name}}</td>
      <td>{{$contact->email}}</td>
      <td>{{$contact->phone}}</td>
      <td>{{$contact->category}}</td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#contactViewer-{{$contact->cid}}" data-id="{{$contact->cid}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <form method="POST" action="{{route('admin.contacts.destroy',['cid' => $contact->cid ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
      </div>

      <!-- The Modal -->
      <div class="modal fade" id="contactViewer-{{$contact->cid}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <table class="admin-modal-table">
                <tr>
                  <th>Name</th>
                  <td>{{$contact->name}}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{$contact->email}}</td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td>{{$contact->phone}}</td>
                </tr>
                <tr>
                  <th>Category</th>
                  <td>{{$contact->category}}</td>
                </tr>
                <tr>
                  <th>Message</th>
                  <td>{{$contact->message}}</td>
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

{{ $contacts->links() }}

</div>

@endsection
