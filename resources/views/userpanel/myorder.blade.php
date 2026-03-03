@include('userpanel.header')



            <h3 class="heading">My Order</h3>

            <div class="user-form myorder-wrap">
                <div class="order-sec">

                @if(isset($orders))
                @foreach ($orders as $order_id => $ordersGrouped)
                    <div class="order-col">
                        <div class="order-top">
                            <div class="order-left">ORDER#  <span>{{@$order_id}}</span></div>
                            @php
                            $firstOrder = $ordersGrouped->first();
                            @endphp
                            @if($firstOrder->invoice)
                            <div class="order-right">
                            <a href="{{url('public')}}/{{$firstOrder->invoice}}" download="{{ $firstOrder->invoice }}">Download Invoice</a>
                            </div>
                           

                            <div class="order-right">Grand Total: ₹{{ number_format($firstOrder->grand_total,2) }}</div>
                            <p class="order-right">Order on {{ $firstOrder->created_at->format('d F Y') }}</p>
                            @endif
                        </div>
                        @foreach($ordersGrouped as $key => $order)
                        <div class="bottom-data">
                            <div class="order-bottom">
                                <div class="img-wrap">

                                    <div class="order-items">
                                        <div class="left">
                                        @php
                                            $image = "App\Product_Image"::where('product_id',$order->product_id)->first();
                                        @endphp
                                            <img src="{{url('public')}}/{{@$image->url}}"  alt="Addresses" />
                                        </div>
                                        <div class="right">
                                            <div class="right-inner">
                                                <p>Name</p>
                                                <h3>{{@$order->product_name}}</h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="content-wrap">
                                    
                                    <div class="weight-wrap items">
                                        <strong>Weight</strong>
                                        <p><span>{{@$order->product_size}}</span></p>
                                    </div>

                                    <div class="total-wrap items">
                                        <strong>Price </strong>
                                        <p>{{number_format(@$order->per_product_price,2)}}</p>
                                    </div>
                                    <div class="price-wrap items">
                                        <strong>Quantity</strong>
                                        <p><span>@if($order->product_quantity && $order->product_quantity != null && $order->product_quantity != '') {{$order->product_quantity}} @else - @endif</span></p>
                                    </div>

                                    <div class="total-wrap items">
                                        <strong> Total Price </strong>
                                        <p>{{number_format(@$order->per_product_price * $order->product_quantity ,2) }}</p>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endforeach
                @endif

                    <div class="view-all-btn">
                        <a href="javascript:void(0)" id="viewMore" class="theme-button"> View More </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@include('userpanel.footer')


<script>

$(document).ready(function(){
  $(".order-col").slice(0,2).show();
  $("#viewMore").click(function(e){
    e.preventDefault();
    $(".order-col:hidden").slice(0,2).fadeIn("slow");  
  });
})
</script>