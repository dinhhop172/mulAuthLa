@extends('layouts.master')
@section('content')
   <div class="container">
      <div class="row">
         <div class="col-6 offset-3">
            <div class="card">
               <div class="card">
                  <div class="card-header">
                     Login
                  </div>
                  <div class="card-body">
                     @if(session()->has('failed'))
                     <div class="alert alert-warning">
                        {{ session()->get('failed') }}
                     </div>
                     @endif
                     <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="">Username</label>
                          <input type="text" name="name" id="" class="form-control" placeholder="Name" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <div class="form-group">
                          <label for="">Password</label>
                          <input type="text" name="password" id="" class="form-control" placeholder="Password" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <button type="submit">Login</button>
                        <a href="{{ route('product.show') }}" class="btn">Back</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection