@extends('layouts.app')

<style>
    .qty {
        width: 40px;
        height: 25px;
        text-align: center;
    }
    input.qtyplus { width:25px; height:25px;}
    input.qtyminus { width:25px; height:25px;}

    .btn-checkout{
        float: right;
    }
</style>

@section('content')

    <div class="bg-light p-4 rounded">
        <h1 class="mb-3">Menu</h1>
        <form method="GET" action="/order" class="form-inline">
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-4">
                <input type="search" name="search" class="form-control form-control" placeholder="Search..." aria-label="Search" value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-4">
            
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mb-2">Go</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <form id='myform' method='POST' action='{{route('order.cart')}}' enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    @foreach ($menu as $key=>$item)
                    
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" width="250" src="{{ url('/uploads/images/'.$item['image']) }}" alt="$item['image']">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item['name']}}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">@currency($item['price'])</h6>
                                    <div class="quantity">
                                        <input type="hidden" name="menu[{{$key}}][id]" value="{{$item['id']}}" />
                                        <input type='button' value='-' class='qtyminus minus' field='quantity' />
                                        <input type='text' name='menu[{{$key}}][quantity]' value='0' class='qty' />
                                        <input type='button' value='+' class='qtyplus plus' field='quantity' />
                                        
                                    </div>
                                </div>
                            </div>
                        </div>  
                    
                    @endforeach
                </div>
            <button type="submit" class="btn btn-primary btn-checkout">Checkout</button>
        </form>

    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(($) => {
        $('.quantity').on('click', '.plus', function(e) {
            let $input = $(this).prev('input.qty');
            let val = parseInt($input.val());
            $input.val( val+1 ).change();
        });
 
        $('.quantity').on('click', '.minus', 
            function(e) {
            let $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 0) {
                $input.val( val-1 ).change();
            } 
        });
    });

</script>
@endsection
