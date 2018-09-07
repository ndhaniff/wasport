@extends('auth.admin.dashboard', ['active' => ['parent' => 'addons', 'child' => 'create']])
@section('title')
Admin | Create Addons
@endsection
@section('meta')
<link rel="stylesheet" href="//cdn.quilljs.com/1.2.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-datetime/2.15.0/css/react-datetime.min.css">
<script>
var addons = {
  id: "{{$addons->id}}",
  add_en : "{{$addons->add_en}}",
  add_ms : "{{$addons->add_ms}}",
  add_zh : "{{$addons->add_zh}}",
  addprice : "{{$addons->addprice}}",
  desc_en : "{{$addons->desc_en}}",
  desc_ms : "{{$addons->desc_ms}}",
  desc_zh : "{{$addons->desc_zh}}",
  type : "{{$addons->type}}",
  race_id : "{{$addons->race_id}}",

}
</script>
@endsection

@section('dashboard-content')
<div class="p-3">
  <h1>Edit Addons</h1>
  <div id="editaddonsform"></div>
</div>

@endsection
