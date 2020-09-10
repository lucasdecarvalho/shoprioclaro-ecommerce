@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Produtos</h6>
            </div>
            <div class="col-12 col-xl-6 p-2 pt-xl-4 pr-xl-4 text-center text-xl-right">
                <a href="/exemplo/admin/products/create" class="btn btn-success">Adicionar <i class="fas fa-plus-circle"></i></a>
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
                    <th>Preço</th>
                    <th>Status</th>
                    <th class="text-center"><i class="fas fa-cogs"></i></th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td class="text-center">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>R$ <span class="money">{{ $product->price }}</span></td>
                    <td>@if($product->status == true) Publicado @else Escondido @endif</td>
                    <td class="text-center">
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                            <!-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Detalhes</a> -->
                            <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $products->links() !!}
    </div> 
@endsection