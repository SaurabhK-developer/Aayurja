<!DOCTYPE html>
<html>
<body>

<h2>Query</h2>

<ul>
  @if($name)<li>Name:{{$name }}</li>@endif
  @if($email)<li>Email:{{$email }}</li>@endif
  @if($mobile)<li>Phone:{{$mobile }}</li>@endif
  {{-- @if($message)<li>Message:{{$message }}</li>@endif --}}
  @if($source_url)<li>Source URL:{{$source_url }}</li>@endif
  @if($product)<li>Product:{{$product }}</li>@endif
  @if($product_weight)<li>Product Weight:{{$product_weight }}</li>@endif
  @if($product_quantity)<li>Product Quantity:{{$product_quantity }}</li>@endif
  @if($interested_in)<li>Interested In:{{$interested_in }}</li>@endif     
  @if($person)<li>Person:{{$person }}</li>@endif
  @if($formtype)<li>FormType:{{$formtype }}</li>@endif
</ul>  


</body>
</html>
