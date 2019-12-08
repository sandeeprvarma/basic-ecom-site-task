@extends('admin.layouts')

@section('admincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Total Orders 
                    @if(!empty($orders))
                    <span class="float-right badge">{{count($orders)}}</span>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!empty($orders))
                    <table class="table table-border">
                        <tr>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        @foreach($orders as $order)
                        <tr>
                            <td><img src="{{strpos($order->image,'http') !== false?$order->image:url('/uploads/'.$order->image)}}" height="20" width="20"></td>
                            <td>{{$order->title}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->quantity*$order->price}}</td>
                        </tr>
                        {{-- <span class="p-3"></span> --}}
                        {{-- <span class="p-3">{{$order->description}}</span> --}}
                        {{-- <span class="p-3"> </span> --}}
                        @endforeach 
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
