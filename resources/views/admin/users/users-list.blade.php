@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Usuários</h6>
            </div>
        </div>
    </div>
   
    <div class="col-12 p-4 bg-white border border-top-0 rounded-bottom">

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="p-0 m-0 text-center">{{ $message }}</p>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th><i class="fas fa-cogs"></i></th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name ?? null }}</td>
                <td>{{ $user->lastname ?? null }}</td>
                <td>{{ $user->doc ?? null }}</td>
                <td>{{ $user->email ?? null }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}" data-toggle="tooltip" data-placement="top" title="Detalhes"><i class="fas fa-search-plus"></i></a>
                    <!-- <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>    -->
                </td>
            </tr>
            @endforeach
        </table>

        {!! $users->links() !!}
    </div>
      
@endsection
