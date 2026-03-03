<form id="pin-code-form" method="post" action="{{url('forwardOrder')}}">
        @csrf
        <input type="text" id="order_id" name="order_id" placeholder="Enter order_id">
        <button type="submit">Check Serviceability</button>
    </form>