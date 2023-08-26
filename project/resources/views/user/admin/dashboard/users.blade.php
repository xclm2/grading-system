@extends('user.admin.index')
@section('content')
<div class="card">
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Email</th>
          <th scope="col">Firstname</th>
          <th scope="col">Lastname</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        @foreach ($users as $i => $user)
        <tr>
          <th scope="row">{{ $i }}</th>
          <td>{{ $user->getEmail() }}</td>
          <td>{{ $user->getFirstname() }}</td>
          <td>{{ $user->getLastname() }}</td>
          <td>
            @if (true)
            <button class="btn btn-warning btn-sm">Disable</button>
            @else
            <button class="btn btn-success btn-sm">Enable</button>
            @endif
            <button class="btn btn-primary btn-sm">View</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection