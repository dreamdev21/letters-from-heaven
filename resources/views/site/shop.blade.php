@extends('layouts.app')

@section('content')
    <section id="shop" class="sections" style="margin-top: 5rem;">
        <div class="container">
            <div class="row text-center" style="padding: 3rem;">
                <h3>Welcome to our shop!!!</h3>
            </div>
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 4rem;">
                    <a href="{{ '/shop/email' }}"> <img src="site/images/email_thumbnail.jpg" class="shop-select" ></a>
                    <div class="row text-center" style="margin-top: 2rem;font-size: 2rem;text-align: center;   margin-top:3rem;   font-family: Alex Brush;    font-weight: 700;">
                        E-mail Letter
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 4rem;">
                    <a href="{{ '/shop/flower' }}"> <img src="site/images/sweet_love_hamper.jpg" class="shop-select" ></a>
                    <div class="row text-center" style="margin-top: 2rem;font-size: 2rem;text-align: center;    margin-top:3rem;    font-family: Alex Brush;    font-weight: 700;">Flower & Gifts</div>
                </div>

            </div>
        </div>
    </section>
    <script src="site/js/vendor/jquery-1.11.2.min.js"></script>
    {{--<script src="site/js/vendor/bootstrap.min.js"></script>--}}

    <script src="site/js/plugins.js"></script>
    <script src="site/js/main.js"></script>
@endsection
