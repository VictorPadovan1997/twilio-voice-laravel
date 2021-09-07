@extends('layouts.dashboard')

@section('title', 'Chamadas')

@section('content')

<div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">From</th>
          <th scope="col">To</th>
          <th scope="col">Status</th>
          <th scope="col">Call Sid</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
            @foreach ($calls as $call)
            <tr>
                <td>{{$call->from_user}}</td>
                <td>{{$call->to_user}}</td>
                <td>{{$call->status}}</td>
                <td>{{$call->call_sid}}</td>
                <td>
                    <form action="calls/{{ $call->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button type='submit' class="btn btn-danger" href="">Excluir</a>
                    <form>
                </td>
            </tr>
            @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

