@extends('layouts.master')
@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8">
                <h2>Billing address</h2>
                {{-- <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="name" id="" class="form-control " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Email </label>
                        <input type="text" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                    <div class="form-group">
                        <label for="">Address </label>
                        <input type="text" name="address" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                    <input type="submit" class="btn border" value="Place Order">
                </form> --}}
            </div>

            <div class="col-md-4">
                <h4 class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">
                        @if (session()->has('cart'))
                            {{ count(session()->get('cart')) }}
                        @else
                            {{ 0 }}
                        @endif
                    </span>
                </h4>
                <ul class="list-group">
                    @foreach ($cart as $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $item['name'] }}
                                    <span class="badge badge-secondary badge-pill">x{{ $item['quantity'] }}</span>
                                </h6>
                                <small><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="50px"></small>
                            </div>
                            <span class="text-muted">{{ $item['price'] * $item['quantity'] }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">Total:
                        <span class="text-muted">{{ $total }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
