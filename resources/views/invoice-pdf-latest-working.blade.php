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




    //To get prefix for invoice number
    $year = now()->format('Y'); // current year, e.g. 2025
    $month = now()->format('n'); // numeric month without leading zero (1-12)

    if ($month >= 4) {
        // Financial year starts in April
        $startYear = $year;
        $endYear = $year + 1;
    } else {
        $startYear = $year - 1;
        $endYear = $year;
    }

    $financialYear = 'AAY' . $startYear . '-' . substr($endYear, -2);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <title>Invoice</title>
  <style>
    /* Remove default page margins when printing to PDF */
    @page {
      size: A4;
      margin: 10px;
    }

    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      font-size: 14px;
      color: #000;
      font-family: "Plus Jakarta Sans", sans-serif;
    }

    .invoice-box {
      max-width: calc(100% - 20px);
      padding: 10px;
      margin: auto;
      font-family: "Plus Jakarta Sans", sans-serif;
      font-weight: 500;
    }

    h1, h2, h3 {
      margin: 0;
      padding: 0;
      font-family: "El Messiri", sans-serif;
    }

    .center {
      text-align: center;
      color: #b68555;
      font-size: 28px;
      margin: 10px 0;
      font-family: "El Messiri", sans-serif;
      line-height: 1;
      font-weight: 900;
    }

    .info, .billing {
      width: 100%;
      /* margin-bottom: 20px; */
    }

    .info td {
      padding: 2px 0;
    vertical-align: top;
    line-height: 1.1;
    }

    .billing td {
      width: 50%;
    padding: 4px 0;
    line-height: 1.1;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    .item-table th, .item-table td {
       /* border: 1px solid transparent; */
       padding: 7px;
    font-size: 13px;
    text-align: center;
    line-height: 1.1;
    }

    .item-table th {
      background-color: #b68555;
      color: #fff;
    }

    .highlight {
      background-color: #b68555;
      color: #fff;
    }

    .totals, .terms {
      margin-top: 20px;
    }

    .terms {
      font-size: 13px;
    }

    .totals td {
      padding: 1px;
      font-size: 14px;
    }

    .totals td:first-of-type {
      text-align: left;
    }

    .totals td:last-of-type {
      text-align: right;
    }

    .total-value {
      background-color: #0295d7;
      color: #fff;
      font-weight: bold;
    }

    .tax-summary {
      margin-top: 10px;
    }

    .tax-summary th, .tax-summary td {
      border: 1px solid #000;
      padding: 5px;
      font-size: 13px;
      text-align: center;
    }

    .tax-summary th {
      background-color: #fff;
    }

    .top-heading strong {
      font-size: 21px;
      margin-bottom: 6px;
      display: block;
    }

    .billing p {
      margin: 0px 0px;
    }

    .totals p {
      margin: 1px 0px;
      line-height: 1.1;
    }

    .summary-bg {
      background-color: #0000001a;
      padding: 4px 4px;
      margin-bottom:20px;
    }

    .billing .right-billing {
      text-align: right;
    }

    .total-row td {
      border-top: 1px solid #000 !important;
      border-bottom: 1px solid #000 !important;
    }


   .item-table {
    margin-top: 10px;
}

p.summary-bg {
    margin-top: 6px;
    margin-bottom: 10px;
}
  </style>
</head>
<body>
  <div class="invoice-box">
    <table class="info">
      <tr>
        <td class="top-heading">
          <strong>Aayurja (A Unit of Reshita Overseas LLP)</strong>
          Shivlalpur Pandey, Kashipur Road, Ramnagar, Nainital<br>
          Uttarakhand - 244715<br>
          Phone no.: +91-7055433886<br>
          Email: info@aayurja.com<br>
          State: Uttarakhand<br>
          GSTIN No: 05ABKFR0610E1ZP<br>
        </td>
      </tr>
    </table>

    <div class="center">Tax Invoice</div>

    <table class="billing">
      <tr>
        <td>
          <strong>Bill To:</strong>
          <p><strong>{{@$orders->customer_name}}</strong></p>
          <p>Address: {{@$orders->shipping_address}}</p>
          <p>Contact No.: {{@$orders->customer_phone}}</p>
          <p>State: {{@$orders->shipping_state}}</p>
        </td>
        <td class="right-billing">
          <p><strong>Place of supply:</strong> Uttarakhand</p>
          <p><strong>Invoice No.:</strong> {{$financialYear}}/{{str_pad(@$orders->invoice_no, 3, '0', STR_PAD_LEFT)}}</p>
          <p><strong>Date:</strong> {{ $orders->created_at->format('d-m-Y') }}</p>
        </td>
      </tr>
    </table>

    <table class="item-table">
      <tr>
        <th style="width:5%;">#</th>
        <th style="width:30%; text-align:left;">Item name</th>
        <th style="width:15%;">HSN</th>
        <th style="width:5%;">Quantity</th>
        <th style="width:15%;">Price/ Unit</th>
        <!-- <th style="width:10%;">Discount</th> -->
        <th style="width:10%;">Weight</th>
        <th style="width:10%;">Tax Rate</th>
        <th style="width:10%;">Amount</th>
      </tr>

      <?php
         $totalQty = 0;
         $totalItemPrice = 0;
         $totalItemPriceWithQty = 0;
         $totalGst = 0;
         $total_base_amount= 0; 
      ?>

      @foreach($allOrderDetails as $key => $allOrderDetail)
      <tr>
        <td>{{$key+1}}</td>
        <td style="text-align:left;">{{@$allOrderDetail->product_name}}</td>

        <?php
          $total = ($allOrderDetail->per_product_price*$allOrderDetail->product_quantity)
        ?>
        <?php
          $gst = \App\GstManagement::where('product_id', $allOrderDetail->product_id)->first();
        ?>

        <?php
          //CALCULATIONS FOR BASE AMOUNT WITHOUT GST AND GST AMOUNT
          // Calculate base amount (excluding GST)
          $base_amount = $total / (1 + ($gst->gst_percentage / 100));

          // Calculate GST amount
          $gst_amount = $total - $base_amount;

          // Optionally round to 2 decimal places
          $base_amount = round($base_amount, 2);
          $gst_amount = round($gst_amount, 2);
        ?>

        <td>{{ $gst->hsn_code ?? 'N/A' }}</td>
        <td>{{ number_format((float)@$allOrderDetail->product_quantity, 2) }}</td>
        <td>
         <?php
               $total = ($allOrderDetail->per_product_price*$allOrderDetail->product_quantity)
            ?>
            <?php echo number_format($base_amount, 2); ?>

        </td>
        <!-- <td>0.00</td> -->
        <td>{{$allOrderDetail->product_size}}</td>
        <td>
          <?php //echo ($total*$gst->gst_percentage)/100; ?>
          <?php echo number_format($gst_amount, 2); ?>
          ({{ $gst->gst_percentage ?? '0.00' }}%)
        </td>
        <?php 
          // $totalGst = $totalGst + ($total*$gst->gst_percentage)/100; 
          $totalGst = $totalGst + $gst_amount;

        ?>
        <td>{{ number_format((float)@$allOrderDetail->per_product_price * $allOrderDetail->product_quantity, 2) }}</td>

        
      </tr>
      <?php
         $totalQty = $totalQty + $allOrderDetail->product_quantity;

         $totalItemPrice = $totalItemPrice + $allOrderDetail->per_product_price;
         $totalItemPriceWithQty = $totalItemPriceWithQty + ($allOrderDetail->per_product_price*$allOrderDetail->product_quantity);

         $total_base_amount = $total_base_amount + $base_amount;

      ?>
      
      @endforeach

      <tr class="total-row">
        <td></td>
        <td colspan="2" style="text-align:left;"><strong>Total</strong></td>
        <td><?php echo number_format($totalQty, 2); ?></td>
        <td>&#8377; <?php echo number_format($total_base_amount, 2); ?></td>
        <td></td>
        <td>&#8377;{{ $totalGst ?? '0.00' }}</td>
        <td>&#8377;<?php echo number_format($totalItemPriceWithQty, 2); ?></td>
      </tr>
    </table>

    <table class="totals">
      <tr>
        <td style="width: 60%; padding-right: 30px;">
          <p><strong>INVOICE AMOUNT IN WORDS</strong></p>
          <p class="summary-bg">
            {{numberToWords(round($orders->grand_total))}}
          </p>
          <!-- <p><strong>TERMS AND CONDITIONS APPLIED</strong></p>
          <p>NO RETURN / NO EXCHANGE</p>
          <p>Please check items before leaving the store</p> -->
          <p></p>
          <p></p>

          <!-- <p>
            dasadsad<br>
            12345678<br>
            T&amp;C 5<br>
            wertyuiop<br>
            zcvbnm
          </p> -->
        </td>
        <td>
          <table class="totals-table">
            <tr>
              <td>Sub Total</td>
              <td>&#8377; <?php echo number_format($totalItemPriceWithQty, 2); ?></td>
            </tr>
            <tr>
              <td>Discount</td>
              <td>&#8377; <?php echo number_format($orders->discount_amount, 2); ?></td>
            </tr>
            <tr>
              <td>Round Off</td>
              <td>- &#8377; {{isset($orders->discount_amount) ? number_format(($totalItemPriceWithQty-$orders->discount_amount)-($totalItemPriceWithQty-$orders->discount_amount), 2) : 0.00}}</td>
            </tr>
            <tr class="highlight">
              <td>Total</td>
              <td>&#8377; <?php echo number_format(round($orders->grand_total), 2); ?></td>
            </tr>
            <tr>
              <td>Received</td>
              @if($orders->payment_source && $orders->payment_source == 'COD')
                <td>&#8377; 0.00</td>
              @else
                <td>&#8377; <?php echo number_format($orders->grand_total, 2); ?></td>
              @endif
            </tr>
            <!-- <tr>
              <td>Balance</td>
              <td>0.00</td>
            </tr> -->
            <tr>
              <td>Payment Mode</td>
              <td>{{@$orders->payment_source}}</td>
            </tr>
            <!-- <tr>
              <td>Previous Balance</td>
              <td>0.00</td>
            </tr> -->
          </table>
        </td>
      </tr>
    </table>

    <h3 class="center" style="margin-top:20px">Tax Summary</h3>
    <table class="tax-summary">
      <tr>
        <th>Taxable amount</th>
        <th>Tax Rate</th>
        <th>HSN</th>
        <th>CGST</th>
        <th>SGST</th>
        <th>IGST</th>
      </tr>

      @foreach($allOrderDetails as $key => $allOrderDetail)
      <?php
          $total = ($allOrderDetail->per_product_price*$allOrderDetail->product_quantity)
        ?>
        
        <?php
          $gst = \App\GstManagement::where('product_id', $allOrderDetail->product_id)->first();
        ?>

        <?php
          //CALCULATIONS FOR BASE AMOUNT WITHOUT GST AND GST AMOUNT
          // Calculate base amount (excluding GST)
          $base_amount = $total / (1 + ($gst->gst_percentage / 100));

          // Calculate GST amount
          $gst_amount = $total - $base_amount;

          // Optionally round to 2 decimal places
          $base_amount = round($base_amount, 2);
          $gst_amount = $gst_amount;
        ?>

        <tr>
          <td>&#8377; <?php echo number_format($base_amount, 2); ?></td>
          <td>{{ $gst->gst_percentage ?? '0.00' }}%</td>
          <td>{{ $gst->hsn_code ?? 'N/A' }}</td>
          <td>&#8377;
            <?php
              if($orders->shipping_state == 'Uttarakhand' || $orders->shipping_state == 'Uttrakhand')
              {
                echo number_format($gst_amount/2, 2);
              }
              else
              {
                echo '0.00';
              }
            ?>
          </td>
          <td>&#8377;
          <?php
            if($orders->shipping_state == 'Uttarakhand' || $orders->shipping_state == 'Uttrakhand')
            {
              echo number_format($gst_amount/2, 2);
            }
            else
            {
              echo '0.00';
            }
          ?>
          </td>
          <td>
          &#8377;
          <?php
            if($orders->shipping_state == 'Uttarakhand' || $orders->shipping_state == 'Uttrakhand')
            {
              echo '0.00';
            }
            else
            {
              echo number_format($gst_amount, 2);
            }
          ?>
          </td>
        </tr>
      @endforeach



<!-- 
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
        <td>241.94</td>
        <td>0.00</td>
        <td>0.00</td>
        <td>41.37</td>
        <td>13.79</td>
      </tr> -->
    </table>
  </div>
</body>
</html>

