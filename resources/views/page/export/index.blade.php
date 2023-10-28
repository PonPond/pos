<!DOCTYPE html>
<html lang="en" >

<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <title>CodePen - POS Receipt Template Html Css</title>

    <style>

        @media print {
            .page-break { display: block; page-break-before: always; }
        }
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 3mm;
            margin: 0 auto;
            width: 44mm;
            background: #FFF;
        }
        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }
        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }
        #invoice-POS h1 {
            font-size: 1.5em;
            color: #000000;
        }
        #invoice-POS h2 {
            font-size: .9em;
        }
        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        #invoice-POS p {
            font-size: .8em;
            color: #000000;
            line-height: 1.4em;
        }
        #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }
        #invoice-POS #top {
            min-height: 20px;
        }
        #invoice-POS #mid {
            min-height: 80px;
        }
        #invoice-POS #bot {
            min-height: 50px;
        }
        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }
        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }
        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }
        #invoice-POS .title {
            float: right;
        }
        #invoice-POS .title p {
            text-align: right;
        }
        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }
        #invoice-POS .tabletitle {
            font-size: .5em;
            background: #fffcfc;
        }
        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }
        #invoice-POS .item {
            width: 22mm;
        }
        #invoice-POS .itemtext {
            font-size: .7em;
            text-align: center
        }
        #invoice-POS .itemtextname {
            font-size: .7em;
            
        }
        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }

    </style>

    <script>
        window.console = window.console || function(t) {};
    </script>



    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>


</head>

<body translate="no" >

<div id="invoice-POS">

   
    <center id="top">
    
       
            <h2>ใบเสร็จรับเงินร้าน</h2>
            <h2> ส.พานิชย์</h2>
    </center><!--End InvoiceTop-->

    <div id="mid">
        <div class="info">
            <h2>ช่องทางติดต่อ</h2>
            <p>
                137 หมู่ 6 ตำบล มะเกลือใหม่ อ.สูงเนิน จ.นครราชสีมา 30170</br>
                โทรศัพท์   :092-5377750</br>
            </p>
         
        </div>
        <hr>
        <p style="text-align: center">รหัสใบเสร็จ </br>
            @foreach($order_receipt as $item)
            {{$item->slip_id}} 
            @endforeach
    </p>
        
    </div><!--End Invoice Mid-->

    <div id="bot">

        <div id="table" style="width:100%">
            <table>
                <tr class="tabletitle">
                    <td class="item"><h2>ชื่อสินค้า</h2></td>
                    
                    <td class="Rate" style="text-align: center"><h2>ราคา</h2></td>
                </tr>

                @php                                                                 
                $i = 0;
                $j = 0;
                 @endphp


                @foreach($order_receipt as $item)
                @foreach($item->listall as $key =>$row)
                <tr class="service">
                    <td class="tableitem"><p class="itemtextname">{{$row}} <br> จน.{{$item->listcount[$key]}} x {{$item->listprice[$key]}} </p> </td>
                    <!-- <td class="tableitem"><p class="itemtext" style="font-size: 0.4cm">{{$item->listcount[$key]}}</p></td> -->
                    <td class="tableitem"><p class="itemtext" style="font-size: 0.4cm">{{$item->listprice[$key]*$item->listcount[$key]}} </p></td>
                    @php                                                                 
                
                $j += $item->listcount[$key];
                 @endphp

                </tr>
                @endforeach
                @endforeach
              
                <tr class="tabletitle">
                    <td></td>
                 
                </tr>
                <tr class="tabletitle">
                    <td style="font-size: 0.4cm">ยอดรวม</td>
                   
                    @foreach($order_receipt as $item)
                    
                    <td style="font-size: 0.4cm"><h2>{{$item->total_price}} บาท</h2></td>
                    @endforeach
                </tr>
                
                <tr class="tabletitle">
                    <td style="font-size: 0.4cm">ยอดรับ</td>
                    
                    @foreach($order_receipt as $item)
                
                    <td style="font-size: 0.4cm"><h2>{{$item->amount}} บาท</h2></td>
                    @endforeach
                </tr>

                <tr class="tabletitle">
                    <td style="font-size: 0.4cm">เงินทอน</td>
                  
                    @foreach($order_receipt as $item)
                    
                    <td style="font-size: 0.4cm"><h2>{{$item->change}} บาท</h2></td>
                    @endforeach
                </tr>

                <tr class="tabletitle">
                    <td style="font-size: 0.4cm">รวมรายการ</td>
                  
                   
                    
                    <td style="font-size: 0.4cm"><h2>{{$j}} รายการ</h2></td>
                    
                </tr>
                
               

                <tr class="tabletitle">
                    <td style="font-size: 0.4cm">วันที่ขาย</td>
                   
                    @foreach($order_receipt as $item)
                    
                    <td ><h2>  {{ $ThaiFormat->makeFormat($item->created_at) }}</h2></td>
                    @endforeach
                </tr>

                <tr class="tabletitle">
                    <td style="font-size: 0.4cm">พนักงานขาย</td>
                   
                    @foreach($order_receipt as $item)
                    
                    <td ><h2>  {{ $item->user_auth }}</h2></td>
                    @endforeach
                </tr>

            </table>
        </div><!--End Table-->

        <div id="legalcopy">
            
 
                  <h5 style="text-align: center">ขอบคุณที่ใช้บริการ</h5>
              
               
        </div>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->







</body>

</html>
