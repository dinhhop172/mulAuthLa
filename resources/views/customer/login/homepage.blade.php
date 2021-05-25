@extends('layouts.master')
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-12">
            <h3 class="">
               Ưelcome to trang home
            </h3>
            
            @if(auth()->guard('customer')->check())
            <h3>Xin chao {{ auth()->guard('customer')->user()->name }}</h3>
            <a href="{{ route('logout.cus') }}">Logout</a>
            @endif
         </div>
      </div>
   </div>
@endsection