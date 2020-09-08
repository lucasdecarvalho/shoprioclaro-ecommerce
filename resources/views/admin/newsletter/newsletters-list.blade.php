@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Newsletter</h6>
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
        <table class="table table-bordered">
        <tr>
            <th class="text-center">Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th class="text-center"><i class="fas fa-cogs"></i></th>
        </tr>
        @foreach ($newsletters as $news)
        <tr>
            <td class="text-center">{{ $news->id }}</td>
            <td>{{ $news->name }}</td>
            <td>{{ $news->email }}</td>
            <td class="text-center">
                <form method="POST" action="{{ route('newsletter.destroy',$news->id) }}" >
                    <!-- <a class="btn btn-primary" href="{{ route('newsletter.edit',$news->id) }}">Editar</a> -->
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $newsletters->links() !!}
</div>

      
@endsection