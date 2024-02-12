@extends($theme.'layouts.user')
@section('title', trans('Lisence'))

@section('content')
    <!--@include($theme.'sections.faq')-->
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>Secure and Easy Crypto Trading</h1>
            <p>Buy, sell, and trade your favorite cryptocurrencies with our user-friendly app.</p>
            <button class="btn btn-primary">Get Started</button>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-124">
            <h2>Advantages</h2>
            <div class="list-container">
                <div class="list-item"><span class="badge badge-success">✓</span> Double the safety</div>
                <div class="list-item"><span class="badge badge-success">✓</span> Simple to use</div>
                <div class="list-item"><span class="badge badge-success">✓</span> High performance and high stability</div>
            </div>
        </div>
        <div class="col-md-12">
            <h2>Compliance operation</h2>
            <p>We are committed to providing a safe and compliant trading environment for all of our users.</p>
        </div>
    </div>
    <div class="row my-5">
        <h2 class="col-12 text-center">Technical advantages</h2>
        <div class="col-md-12">
            <div class="list-container">
                <div class="list-item"><span class="badge badge-success">✓</span> Automatic risk control</div>
                <div class="list-item"><span class="badge badge-success">✓</span> Second-level reconciliation</div>
                <div class="list-item"><span class="badge badge-success">✓</span> High performance and high stability</div>
                <div class="list-item"><span class="badge badge-success">✓</span> Independent asset vault</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="list-container">
                <div class="list-item"><span class="badge badge-success">✓</span> Hot and cold wallet dual mechanism</div>
                <div class="list-item"><span class="badge badge-success">✓</span> Currency mixing technology</div>
            </div>
        </div>
    </div>
@endsection
