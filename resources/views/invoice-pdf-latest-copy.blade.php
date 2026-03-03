<?php
   function numberToWords($number)
   {
       $words = array(
           '0' => '', '1' => 'One', '2' => 'Two', '3' => 'Three',
           '4' => 'Four', '5' => 'Five', '6' => 'Six', '7' => 'Seven',
           '8' => 'Eight', '9' => 'Nine', '10' => 'Ten', '11' => 'Eleven',
           '12' => 'Twelve', '13' => 'Thirteen', '14' => 'Fourteen',
           '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
           '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
           '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
           '60' => 'Sixty', '70' => 'Seventy', '80' => 'Eighty',
           '90' => 'Ninety'
       );
   
       $digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];
   
       if (!is_numeric($number)) {
           return false;
       }
   
       $no = floor($number);
       $decimal = round($number - $no, 2) * 100;
       $decimalPart = ($decimal > 0) ? " and " . numberToWords($decimal) . " Paise" : "";
   
       $i = 0;
       $str = array();
   
       while ($no > 0) {
           $divider = ($i == 2) ? 10 : 100;
           $number = $no % $divider;
           $no = floor($no / $divider);
           $i += ($divider == 10) ? 1 : 2;
   
           if ($number) {
               $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
               $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
               $str[] = ($number < 21) ? $words[$number] .
                   " " . $digits[$counter] . $plural . " " . $hundred :
                   $words[floor($number / 10) * 10] . " " . $words[$number % 10] .
                   " " . $digits[$counter] . $plural . " " . $hundred;
           } else {
               $str[] = null;
           }
       }
   
       $output = implode('', array_reverse($str));
       return trim($output) . " Rupees" . $decimalPart . " Only";
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
      <title>Invoice</title>
      <style>
         * {
         box-sizing: border-box;
         }
         html, body {
         margin: 0;
         padding:0px;
         }
         body {
         font-family: Arial, sans-serif;
         background-color: #fff;
         color: #000;
         font-size: 13px;
         box-shadow: none;
           width: 21cm;
         height: 14.8cm; 
         margin: 0 auto;
         }
         .page {
         padding: 0;
         box-sizing: border-box;
         }
         .invoice-box {
         position: relative;
         width: 100%;
         /* border: 1px solid #eee; */
         padding: 10px 10px;
         font-size: 14px;
         }
         .header h2 {
         margin: 0;
         color: #000;
         }
         .header p {
         margin: 3px 0;
         font-size: 14px;
         line-height: 1.4;
         }
         .top-header {
         background: #9c6f42;
         color: #fff;
         }
         .top-header th {
            border: 1px solid #9c6f42;
            text-align: left;
         }
         .main-box-area tr td{
         text-align: left;
         }


         .center {
         text-align: center;
         color: #9c6f42;
         font-size: 28px;
         font-weight: 700;
         margin: 10px 0;
         }
         .billing {
         display: flex;
         justify-content: space-between;
         margin: 20px 0;
         font-size: 14px;
         flex-wrap: wrap;
         }
         .billing p {
         margin: 3px 0;
         }
         .right {
         text-align: right;
         }
         table {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 20px;
         }
         th, td {
         padding: 10px;
         text-align: center;
         }
         .total-row {
         font-weight: bold;
         border-top: 1.4px solid #898282;
         border-bottom: 1.4px solid #898282;
         }
         .summary {
         font-size: 13px;
         margin-top: 10px;
         }
         .totals {
            margin-top: 20px;
            width: 45%;
            float: left;
         }
         .totals .right p {
         margin: 4px 0;
         }
         .bottom-table-area,
         .bottom-table-area th,
         .bottom-table-area td {
         border: 1px solid #898282;
         }
         .bottom-table-area td {
         font-weight: 500;
         }
         .tax-summary {
         text-align: center;
         margin-bottom: 10px;
         line-height: 1;
         }
         .summary-area {
         display: flex;
         justify-content: space-between;
         margin-top: 20px;
         gap: 30px;
         flex-wrap: wrap;
         }
         .summary-left {
            width: 50%;
            font-size: 13px;
            line-height: 1.5;
            float: left;
         }
         .summary-left p {
         margin: 3px 0;
         font-weight: 500;
         }
         .summary-bg {
         background: #eee;
         padding: 5px;
         }
         .summary-left strong {
         color: rgb(134 126 126);
         }
         .totals-table {
         width: 100%;
         border-collapse: collapse;
         }
         .totals-table td {
         padding: 6px 8px;
         font-size: 13px;
         /* border: 1px solid #ccc; */
         text-align: left;
         font-weight: 500;
         }
         .totals-table td:last-child {
         text-align: right;
         }
         .totals-table .highlight {
         background: #9c6f42;
         color: #fff;
         }
         .totals-table .highlight td {
         font-weight: 600;
         }

.billing  .billing-left{

   width: 60%;
}

.billing  .billing-right{

   width: 40%;
}

         /* @media screen and (orientation: landscape) {
         html, body, .page, .invoice-box {
         width: 99vw;
         max-width: 99vw;
         overflow-x: hidden;
         }
         } */
         /* @media print {
         html, body, .page, .invoice-box {
         margin: 0;
         padding: 0;
         width: 100vw;
         max-width: 100vw;
         box-shadow: none;
         }
         } */
         @media print {
         .top-header,
         .highlight,
         .summary-bg {
         -webkit-print-color-adjust: exact;
         print-color-adjust: exact;
         }
         .top-header {
         background-color: #9c6f42 !important;
         color: #fff !important;
         }
         .highlight {
         background-color: #9c6f42 !important;
         color: #fff !important;
         }
         .summary-bg {
         background-color: #eee !important;
         }
         }



         @media print {
          body, .page {
          margin: 0;
         padding: 0;
         box-shadow: none;
         width: 21cm;
         height: 14.8cm;  
         }
         }


      </style>
   </head>
   <body class="page">
      <div class="invoice-box">
         <div class="header">
            <h2>Aayurja</h2>
            <p>
               Shivlalpur Pandey, Kashipur Road, Ramnagar, Nainital<br>
               Uttarakhand - 244715<br>
               Phone no.: +91-7055433886<br>
               Email: info@aayurja.com<br>
               State: Uttarakhand<br>
               GSTIN No: 05ABKFR0610E1ZP<br>
               <!-- FSSAI No: 12345678901234<br>
                  Website: www.vasyerp.com -->
            </p>
         </div>
         <h2 class="center">Tax Invoice</h2>
         <div class="billing clearfix">
            <div class="billing-left">
               <strong>Bill To:</strong>
               <p><strong>{{@$orders->customer_name}}</strong></p>
               <p>Address: {{@$orders->shipping_address}}</p>
               <p>Contact No.: {{@$orders->customer_phone}}</p>
               <p>State: {{@$orders->shipping_state}}</p>
            </div>
            <div class="billing-right right">
               <p><strong>Place of supply:</strong> Uttarakhand</p>
               <p><strong>Invoice No.:</strong> {{str_pad(@$orders->invoice_no, 3, '0', STR_PAD_LEFT)}}</p>
               <p><strong>Date:</strong> {{ $orders->created_at->format('d-m-Y') }}</p>
            </div>
         </div>
         <table>
            <thead>
               <tr class="top-header">
                  <th>#</th>
                  <th>Item name</th>
                  <th>HSN/ SAC</th>
                  <th>Quantity</th>
                  <th>Price/Unit</th>
                  <th>Weight</th>
                  <!-- <th>Discount</th> -->
                  <th>GST</th>
                  <th>Amount</th>
               </tr>
            </thead>
            <tbody class="main-box-area">
              

               <?php
                  $totalQty = 0;
                  $totalItemPrice = 0;
                  $totalItemPriceWithQty = 0;
               ?>

               @foreach($allOrderDetails as $key => $allOrderDetail)

                  <tr>
                     <td>{{$key+1}}</td>
                     <td>{{@$allOrderDetail->product_name}}</td>
                     <td>N/A</td>
                     <td>{{ number_format((float)@$allOrderDetail->product_quantity, 2) }}</td>
                     <td>{{ number_format((float)@$allOrderDetail->per_product_price, 2) }}</td>
                     <td>{{$allOrderDetail->product_size}}</td>
                     <!-- <td>0.01</td> -->
                     <td>41.37 (18%)</td>
                     <td>
                        <?php
                           $total = ($allOrderDetail->per_product_price*$allOrderDetail->product_quantity)
                        ?>
                        <?php echo number_format($total, 2); ?></td>
                  </tr>

                  <?php
                     $totalQty = $totalQty + $allOrderDetail->product_quantity;

                     $totalItemPrice = $totalItemPrice + $allOrderDetail->per_product_price;
                     $totalItemPriceWithQty = $totalItemPriceWithQty + ($allOrderDetail->per_product_price*$allOrderDetail->product_quantity);

                  ?>
                  
               @endforeach



               <!-- <tr>
                  <td>2</td>
                  <td>Product name Blue / l</td>
                  <td></td>
                  <td>1.00</td>
                  <td>241.94</td>
                  <td>0.01</td>
                  <td>41.37 (18%)</td>
                  <td>285.00</td>
               </tr> -->
               <tr class="total-row">
                <td></td>
                  <td >Total</td>
                  <td></td>
                  <td><?php echo number_format($totalQty, 2); ?></td>
                  <td><?php echo number_format($totalItemPrice, 2); ?></td>
                  <!-- <td>0.02</td> -->
                  <td></td>
                  <td>82.74</td>
                  <td><?php echo number_format($totalItemPriceWithQty, 2); ?></td>
               </tr>
            </tbody>
         </table>
         <div class="summary-area clearfix">
            <div class="summary-left">
               <p><strong>INVOICE AMOUNT IN WORDS</strong></p>
               
               <p class="summary-bg">
              
               {{numberToWords($orders->grand_total)}}
              
               </p>
               <p><strong>TERMS AND CONDITIONS</strong></p>
               <p>NO RETURN / NO EXCHANGE</p>
               <p>Please check items before leaving the store</p>
               <p>
                  dasadsad<br>
                  12345678<br>
                  T&amp;C 5<br>
                  wertyuiop<br>
                  zcvbnm
               </p>
            </div>
            <div class="totals">
               <table class="totals-table">
                  <tr>
                     <td>Sub Total</td>
                     <td><?php echo number_format($totalItemPriceWithQty, 2); ?></td>
                  </tr>
                  <tr>
                     <td>Discount</td>
                     <td><?php echo number_format($orders->discount_amount, 2); ?></td>
                  </tr>
                  <tr class="highlight">
                     <td>Total</td>
                     <td><?php echo number_format($orders->grand_total, 2); ?></td>
                  </tr>
                  <tr>
                     <td>Received</td>
                     <td>0.00</td>
                  </tr>
                  <tr>
                     <td>Balance</td>
                     <td>0.00</td>
                  </tr>
                  <tr>
                     <td>Payment Mode</td>
                     <td>{{@$orders->payment_source}}</td>
                  </tr>
                  <tr>
                     <td>Previous Balance</td>
                     <td>0.00</td>
                  </tr>
               </table>
            </div>
         </div>
         <h3 class="tax-summary">Tax Summary</h3>
         <table class="bottom-table-area">
            <thead>
               <tr>
                  <th>Tax Rate</th>
                  <th>Taxable amount</th>
                  <th>CGST</th>
                  <th>SGST</th>
                  <th>IGST</th>
                  <th>CESS</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>0%</td>
                  <td>100.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
               </tr>
               <tr>
                  <td>18%</td>
                  <td>383.88</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>82.74</td>
                  <td>13.79</td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
</html>

