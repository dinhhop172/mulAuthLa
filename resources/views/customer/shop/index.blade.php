@extends('layouts.master')
@section('content')
   <div class="container pt-5">
      <div class="row">
         @if(Auth::guard('customer')->check())
         <div class="col-12">
            <ul class="menu float-right">
               <li>
                  <a href="">Hi {{ Auth::guard('customer')->user()->name }}</a>
                  <ul class="sub-menu">
                     <li><a href="{{ route('logout.cus') }}">Logout</a></li>
                  </ul>
               </li>
               <li>
                  <a href="{{ route('cart.checkout') }}">Cart
                     <span class="badge badge-light">
                        @if(session()->has('cart'))
                           {{ count(session()->get('cart')) }}
                        @else
                           {{ 0 }}
                        @endif
                     </span>
                  </a>
               </li>
            </ul>
         </div>
         @else
         <div class="col-sm-4 offset-sm-8 col-md-3 col-12 offset-md-9 col-12 nav-login">
            <a href="" >Register</a>
            <a href="{{ route('login.index') }}">Login</a>
            <a href="{{ route('cart.show') }}">Cart
               <span class="badge badge-light">
                  @if(session()->has('cart'))
                     {{ count(session()->get('cart')) }}
                  @else
                     {{ 0 }}
                  @endif
               </span>
            </a>
         </div>
         @endif
      </div>
      <h2 class="text-center pb-4">All the Products</h2>
      <div class="row">
         @foreach($data as $item)
         <div class="col-sm-6 col-md-3 pb-3">
            <div class="card">
               <div class="card-body">
                  <a href="{{ route('product.detail', $item->id) }}">
                     <img src="{{ $item->image }}" alt="">
                  </a>
                  <h4 class="border text-center">{{ $item->name }}</h4>
                  <p>{{ $item->desc }}</p>
                  <p>Price: {{ $item->price }}</p>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
@endsection
