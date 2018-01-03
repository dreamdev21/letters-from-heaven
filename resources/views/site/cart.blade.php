@extends('layouts.app')

@section('content')
@if (Cart::isEmpty())
    <div class="container" style="margin-top: 10rem;margin-bottom:30rem;">
@else
            <div class="container" style="margin-top: 10rem;margin-bottom: 15rem;">
                @endif
        <h1><i class="fa fa-shopping-cart" aria-hidden="true"></i>Your Cart</h1>

        <hr>

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        @if (sizeof(Cart::getContent()) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th class="table-image"></th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Order Delivery info state</th>
                        <th class="column-spacer">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::getContent() as $item)
                        @if($item->attributes->draftstate == "0")
                        <tr>
                            <td class="table-image" style="width: 7em;height: 7rem;">
                                @if($item->attributes->pro_type == 1)
                                <a href="{{ url('shop/flower/') }}/{{ $item->id }}"><img src="/images/{{ $item->attributes->image }}"></a>
                                @else
                                <a href="{{ url('shop/email/') }}/{{ $item->id }}"><img src="/images/{{ $item->attributes->image }}"></a>
                                @endif
                            </td>

                            <td style="vertical-align: middle;">{{ $item->name }}</td>
                            <td style="vertical-align: middle;">{{ $item->quantity }}
                                {{--<select class="quantity" data-id="{{ $item->rowId }}">--}}
                                    {{--<option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>--}}
                                    {{--<option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>--}}
                                    {{--<option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>--}}
                                    {{--<option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>--}}
                                    {{--<option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>--}}
                                {{--</select>--}}
                            </td>
                            <td style="vertical-align: middle;">${{ $item->price }}</td>
                            <td style="vertical-align: middle;color:red;">Draft</td>
                            <td style="vertical-align: middle;">
                                @if($item->attributes->pro_type == 0)
                                <a href="{{ url('shop/email/edit') }}/{{ $item->id }}"><button class="btn btn-success btn-sm" style="    float: left;margin-right: 5px;">Edit</button></a>
                                @else
                                <a href="{{ url('shop/flower/') }}/{{ $item->id }}"><button class="btn btn-success btn-sm" style="    float: left;margin-right: 5px;">Edit</button></a>
                                @endif
                                <form action="{{ url('/cart', [$item->id]) }}" method="POST" class="side-by-side">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                                </form>
                                {{--<form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">--}}
                                    {{--{!! csrf_field() !!}--}}
                                    {{--<input type="submit" class="btn btn-success btn-sm" value="To Wishlist">--}}
                                {{--</form>--}}
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    @foreach (Cart::getContent() as $item)
                        @if($item->attributes->draftstate != "0")
                            <tr>
                                <td class="table-image" style="width: 7em;height: 7rem;">
                                    @if($item->attributes->pro_type == 1)
                                        <a href="{{ url('shop/flower/') }}/{{ $item->id }}"><img src="/images/{{ $item->attributes->image }}"></a>
                                    @else
                                        <a href="{{ url('shop/email/') }}/{{ $item->id }}"><img src="/images/{{ $item->attributes->image }}"></a>
                                    @endif
                                </td>

                                <td style="vertical-align: middle;">{{ $item->name }}</td>
                                <td style="vertical-align: middle;">{{ $item->quantity }}

                                </td>
                                <td style="vertical-align: middle;">${{ $item->price }}</td>
                                <td style="vertical-align: middle;color:blue;">Complete</td>
                                <td style="vertical-align: middle;">
                                    @if($item->attributes->pro_type == 0)
                                        <a href="{{ url('shop/email/edit') }}/{{ $item->id }}"><button class="btn btn-success btn-sm" style="    float: left;margin-right: 5px;">Edit</button></a>
                                    @else
                                        <a href="{{ url('shop/flower/') }}/{{ $item->id }}"><button class="btn btn-success btn-sm" style="    float: left;margin-right: 5px;">Edit</button></a>
                                    @endif
                                    <form action="{{ url('/cart', [$item->id]) }}" method="POST" class="side-by-side">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                                    </form>
                                    {{--<form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">--}}
                                    {{--{!! csrf_field() !!}--}}
                                    {{--<input type="submit" class="btn btn-success btn-sm" value="To Wishlist">--}}
                                    {{--</form>--}}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    <tr class="border-bottom">
                        <td class="table-image"></td>
                        <td style="padding: 40px;"></td>
                        <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                        <td class="table-bg">${{Cart::getTotal()}}</td>
                        <td class="column-spacer"></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-md">Continue Shopping</a> &nbsp;

            <div style="float:right">
                <a href="{{ url('/orderreview') }}" class="btn btn-success btn-md">Proceed to Checkout</a>
            </div>

        @else

            <h3>You have no items in your shopping cart</h3>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-md">Continue Shopping</a>

        @endif

        <div class="spacer"></div>

    </div>

@endsection
            <script src="site/js/vendor/jquery-1.11.2.min.js"></script>
            {{--<script src="site/js/vendor/bootstrap.min.js"></script>--}}

            <script src="site/js/plugins.js"></script>
            <script src="site/js/main.js"></script>
@section('extra-js')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '{{ url("/cart") }}' + '/' + id,
                  data: {
                    'quantity': this.value,
                  },
                  success: function(data) {
                    window.location.href = '{{ url('/cart') }}';
                  }
                });

            });

        })();

    </script>

@endsection
