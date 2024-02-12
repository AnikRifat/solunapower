@if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
    <section class="payment_area shape2">
        <div class="container-fluid">
            <div class="">

                <div class="payment_slider text-center row">
                    @foreach($gateways->take(8) as $gateway)
                    <div class="col-md-2 col-4">
                        <div class="item">
                            <div class="image_area">
                                <img src="{{getFile(config('location.gateway.path').@$gateway->image)}}" class="img-fluid" alt="{{@$gateway->name}}">
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
