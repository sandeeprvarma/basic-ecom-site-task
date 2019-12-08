@extends('layouts.app')
 
{{-- @section('title', 'Cart') --}}
@section('content')
<div class="container">
	<div class="row">
	   <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">{{count($products)}}</span>
          </h4>
          <ul class="list-group mb-3">
            @foreach($products as $id => $product)
			<?php $total=$total??0; $total += $product['price'] * $product['quantity'] ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
            	<div>
	            	<h6 class="my-0">{{$product['title']}}</h6>
	            	{{-- <small class="text-muted">INR{{$product['description']}}</small> --}}
            	</div>
              <span class="text-muted">{{$product['quantity']}} x INR{{$product['price']}}</span>
            </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>INR{{$total}}</strong>
            </li>
          </ul>
        </div>
	<div class="col-md-8 order-md-1">
      	<h4 class="mb-3">Billing address</h4>
      	<form class="needs-validation" action="{{url('place-order')}}"> 
      	@csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="{{$user->name}}" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com" value="{{$user->email}}">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <textarea class="form-control" id="address" placeholder="1234 Main St" required>{{$user->address}}
          </textarea>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <hr class="mb-4">
        <h4 class="mb-3">Payment</h4>
        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" for="credit">COD</label>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
      </form>
    </div>
</div>
@endsection