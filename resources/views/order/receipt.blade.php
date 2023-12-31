@extends('layouts.app')

@section('content')
    <div class="bg-light p-4 rounded">

        <div class="container mt-4">
            <h2>Receipt</h2>
            <div class="mb-3">
                Receipt Number: #{{ $receipt->id }}<br>
                Total : @currency($total_receipt)
            </div>

            <table class="table table-bordered">
                <tr>
                    <th width="1%">No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                @foreach ($receipt->orders as $item)

                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <th>{{$item->menu->name}}</th>
                        <th>@currency($item->price)</th>
                        <th>{{$item->quantity}}</th>
                        <th>@currency($item->total_price)</th>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
@endsection