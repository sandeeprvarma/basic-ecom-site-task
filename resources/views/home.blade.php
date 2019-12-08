@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container products">
 
        <div class="row">
            @foreach($products as $product)
            <div class="col-xs-18 col-sm-6 col-md-3" style="margin: 2px;">
                <div class="thumbnail">
                    <img src="{{strpos($product->image,'http') !== false?$product->image:url('uploads/'.$product->image) }}" alt="" width="50" height="50">
                    <div class="caption">
                        <h4>{{$product->title}}</h4>
                        <p>{{$product->description}}</p>
                        <p><strong>Price: </strong> {{$product->price}}</p>
                        <p class="btn-holder"><a href="{{ url('add-to-cart/'.$product->id) }}" class="align-self-end btn btn-warning btn-block text-center" role="button" style="position: absolute;bottom: 0;">Add to cart</a> </p>
                    </div>
                </div>
            </div>
            @endforeach 
        </div><!-- End row -->
 
    </div>
</div>
@endsection
