@extends('layouts.shop')

@section('content')
    <div class="item-grid">
        <h1>{{__("Transaction History")}}</h1>

        <table class="table table-hover table-striped">
            <tr>
                <th>Object</th>
                <th>Amount</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{$transaction->object}}</td>
                    <td>{{$transaction->sum}}  {{$transaction->coin}}</td>
                    <td>{{$transaction->quantity}}</td>
                    <td>{{$transaction->created_at}}</td>
                </tr>
            @endforeach
        </table>
        {{$transactions->links()}}

    </div>

@endsection
