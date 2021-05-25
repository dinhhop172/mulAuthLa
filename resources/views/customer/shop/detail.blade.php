@extends('layouts.master')
@section('content')
   <div class="container mt-5">
      <h1 class="border pr-5 pl-5 pt-2 pb-2 text-center text-warning">Product Detail</h1>
      <div class="row" id="detai-data">
         <div class="col-sm-4 mt-5">
            <img src="{{ $data->image }}" alt="" width="100%">
         </div>
         <div class="col-sm-8  mt-5">
            <h2 class="text-info text-center">{{ $data->name }}</h2>
            <h3 class="text-center">Price: {{ $data->price }}$</h3>
            <p>{{ $data->desc }}</p>
            <form action="{{ route('card.add', $data->id) }}" method="POST">
               @csrf
               {{-- <input type="hidden" name="id" value="{{ $data->id }}">
               <input type="hidden" name="name" value="{{ $data->name }}">
               <input type="hidden" name="image" value="{{ $data->image }}">
               <input type="hidden" name="price" value="{{ $data->price }}">
               <input type="hidden" name="desc" value="{{ $data->desc }}"> --}}
               <input type="number" name="quantity" value="1" min="1">
               <button type="submit">Add to Cart</button>
            </form>
            <a href="{{ route('product.show') }}">Home</a>
         </div>
      </div>
   </div>
@endsection
