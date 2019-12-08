@extends('layouts.app')
 
{{-- @section('title', 'Cart') --}}
 
@section('content')
@if(session('cart')) 
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
 
        <?php $total = 0 ?>
             @foreach(session('cart') as $id => $details)
 
                <?php $total += $details['price'] * $details['quantity'] ?>
 
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{strpos($details['image'],'http') !== false?$details['image']:url('uploads/'.$details['image']) }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['title'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">INR{{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity"  readonly="true" />
                    </td>
                    <td data-th="Subtotal" class="text-center">INR{{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <a class="btn btn-info btn-sm update-cart" href="{{url('add-to-cart/'.$id)}}" data-id="{{ $id }}"><i class="fa fa-refresh"></i>+</a>
                        <a class="btn btn-danger btn-sm remove-from-cart" href="{{url('remove-cart/'.$id)}}" data-id="{{ $id }}"><i class="fa fa-trash-o"></i>-</a>
                    </td>
                </tr>
            @endforeach 
        </tbody>
            <tfoot>{{-- 
            <tr class="visible-xs">
                <td class="text-center"><strong>Total INR{{ $total }}</strong></td>
            </tr> --}}
        <tr>
            <td><a href="{{ url('/checkout') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Checkout</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total INR{{ $total }}</strong></td>
        </tr>
        </tfoot>
    </table>
@else
    <div>
        <h3 class="text-center">No Products <a href="/home">Continue Shopping</a></h3>
    </div>
@endif
@endsection