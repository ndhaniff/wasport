<style>
  th, td { padding: 15px; }
</style>

<table border="1" style="border-collapse: collapse">
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
