@extends('auth.admin.dashboard', ['active' => ['parent' => 'payments', 'child' => null]])
@section('title')
Admin | Payments
@endsection
@section('meta')

@endsection

@section('dashboard-content')
<?php $i=1 ?>
<div class="p-3">

  <h1 style="font-size: 2.2rem">Payments</h1>

  <hr />

  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif

  <div class="row">
    <div class="col-sm-8">
      <form action="{{route('admin.payments.searchBy')}}" method="get">
        <div class="input-group">
          <input type="search" name="search" class="form-control" placeholder="Search by">
          <select name="field" class="form-control">
            <option value="oid">order id</option>
            <option value="o_firstname">first name</option>
            <option value="o_lastname">last name</option>
            <option value="o_phone">phone</option>
            <option value="o_email">email</option>
          </select>
          <select name="race_id">
            <option value="" disabled selected>Filter race</option>
            @foreach($allpayments as $allpayment)
              <?php foreach($races as $race) {
                  echo "<option value='" .$race->rid. "'>" .$race->title_en. "</option>";
                } ?>
            @endforeach
          </select>
          <select name="payment_status">
            <option value="" disabled selected>Race status</option>
            <option value="1">paid</option>
            <option value="0">unpaid</option>
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
      <th scope="col">@sortablelink('pid', 'Payment ID')</th>
      <th scope="col">Order ID</th>
      <th scope="col">@sortablelink('p_status', 'Payment Status')</th>
      <th scope="col">@sortablelink('amount_paid', 'Amount')</th>
      <th scope="col">@sortablelink('created_at', 'Transaction Datetime')</th>
      <th scope="col">Race</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($payments as $payment)
    <tr>
      <th scope="row">{{$i++ .'.'}}</th>
      <td>{{$payment->pid}}</td>
      <td>{{$payment->order_id}}</td>
      <td>{{$payment->p_status}}</td>
      <td>{{$payment->amount_paid}}</td>
      <td>{{$payment->created_at}}</td>
      <td><?php /*foreach($orders as $order) {
                  if($payment->order_id == $order->oid) {
                    foreach($races as $race) {
                          if($order->race_id == $race->rid) echo $race->title_en;
                    }
                  }
                }*/
                foreach($races as $race) {
                  if($payment->race_id == $race->rid) echo $race->title_en;
                } ?></td>
      <td>
      <div class="btn-group " role="group" aria-label="Basic example">
        <a data-toggle="modal" data-target="#paymentViewer-{{$payment->pid}}">
          <button type="button" class="btn btn-success"><i class="far fa-eye"></i></button>
        </a>
        <i class="fas fa-cash-register"></i>
        <form method="POST" action="{{route('admin.payments.destroy',['pid' => $payment->pid ])}}">
          @method('DELETE')
          @csrf
          <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
        </form>
      </div>

      <!-- The Payment Modal -->
      <div class="modal fade" id="paymentViewer-{{$payment->pid}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>

              <table class="admin-modal-table">
                <tr>
                  <th>Payment ID</th>
                  <td>{{$payment->pid}}</td>
                </tr>
                <tr>
                  <th>Order ID</th>
                  <td>{{$payment->order_id}}</td>
                </tr>
                <tr>
                  <th>Payment Status</th>
                  <td>
                    <form method="POST" action="{{route('admin.payments.updatePaymentStatus',['pid' => $payment->pid ])}}" id="paymentstatus-form">
                      @csrf
                      <?php echo Form::select('paymentstatus', array('1' => 'paid', '0' => 'unpaid'), $payment->p_status); ?>
                      <button type="submit" class="btn btn-danger" id="racestatus-btn">Submit</button>
                    </form>
                  </td>
                </tr>
                <tr>
                  <th>Amount</th>
                  <td>{{$payment->amount_paid}}</td>
                </tr>
                <?php if($payment->trans_id != null) {
                        echo '<tr><th>Transaction ID</th><td>{{$payment->trans_id}}</td></tr>';
                      } ?>
                <tr>
                  <th>Remark</th>
                  <td>{{$payment->remark}}</td>
                </tr>
                <?php if($payment->err_desc != null) {
                        echo '<tr><th>Error Description</th><td>{{$payment->err_desc}}</td></tr>';
                      } ?>
                <tr>
                  <th>Race</th>
                  <td><?php foreach($races as $race) {
                              if($payment->race_id == $race->rid) echo $race->title_en;
                            } ?></td>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div> <!-- end of paymentViewer -->

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $payments->links() }}

</div>

@endsection

<script>
  var orderid = ''
  function orderFunction(d){
    orderid = d.getAttribute("data-id")
  }
</script>
