@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <h3>Select Product to buy </h3>
                    <table class="table table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Quantity</th>
                            <th>Buy</th>
                        </thead>
                        <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->stock}}</td>
                            <form method="post" action="/buy">
                                <td>
                                    <input type="number" class="form-control col-8 quantity" value="1" name="quantity" id="" min="1" max="{{$item->stock}}" >
                                    <input type="hidden" class="form-control" name="id" value="{{$item->id}}">
                                    <input value="{{$item->name}}" type="hidden" class="form-control" name="name" id="">
                                    <input value="{{$item->price}}" type="hidden" class="form-control" name="price" id="">
                                    <input value="{{$item->stock}}" type="hidden" class="form-control stock" name="stock" id="">
                                    @csrf
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-primary" value="Buy">
                                </td>
                            </form>

                        </tr>
                        @endforeach
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

