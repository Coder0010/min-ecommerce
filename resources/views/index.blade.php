@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class='card justify-content-center'>
            <div class='card-header d-flex justify-content-between align-items-center text-center'>
                <span> All Products</span>
            </div>
            <div class='card-body p-1'>
                <products-show-as-card @add-item-cart='addToCartMethod'/>
            </div>
        </div>
    </div>
@endsection
