<!DOCTYPE html>
<html>
<head>
    <title>Track Shipment</title>
</head>
<body>
    <h2>Track Your Shipment</h2>
    <form method="POST" action="{{ route('shipment.track') }}">
        @csrf
        <label for="waybill">Enter Waybill Number:</label>
        <input type="text" name="waybill" id="waybill" required>
        <button type="submit">Track</button>
    </form>
</body>
</html>
