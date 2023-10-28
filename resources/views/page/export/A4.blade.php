<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
         href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@200;300;400;500&family=Prompt:wght@200;300;400;500&display=swap"
         rel="stylesheet"
      />

      <script src="https://cdn.tailwindcss.com"></script>
      <title>Slip</title>

      <style>
         body {
            font-family: 'Prompt', sans-serif;
         }
      </style>
   </head>
   <body>
      <div class="w-screen h-full flex justify-center">
         <div class="min-w-[210mm] min-h-screen p-4">
            <div class="flex flex-col justify-between h-full py-9 px-6 relative">
               <div>
                  <div class="absolute right-0 top-0">
                     <p class="absolute right-4 top-3 z-10 text-lg text-white">1</p>
                     <div class="w-20 overflow-hidden inline-block">
                        <div class="h-28 bg-sky-600 -rotate-45 transform origin-top-left"></div>
                     </div>
                  </div>
                  <div class="flex justify-end">
                     <div class="w-[48%] text-center text-sky-500">
                        <h1 class="text-2xl">ใบส่งสินค้า/ใบแจ้งนี้</h1>
                        <h3 class="text-xl">ต้นฉบับ</h3>
                     </div>
                  </div>
                  <div class="grid grid-cols-2 gap-6 text-xs my-2">
                     <div>
                        <p><input type="text" class="outline-none" placeholder="ชื่อร้าน"</p>
                        <p>137 หมู่ 6 ตำบล มะเกลือใหม่ อ.สูงเนิน จ.นครราชสีมา </p>
                        <!-- <p>เลขประจำตัวผู้เสียภาษี 0303537000062</p>
                        <p>โทร. 044-441259</p>
                         -->
                        <p>เบอร์มือถือ 092-5377750</p>
                        <!-- <p>โทรสาร 044-283073</p>
                         -->
                     </div>
                     <div>
                        <div class="grid grid-cols-3 border-y-2 border-slate-300 py-4">
                           <div class="text-sky-400">
                              <p>เลขที่</p>
                              <p>วันที่</p>
                              <p>ครบกำหนด</p>
                              <p>ผู้ขาย</p>
                           </div>
                           <div class="col-span-2">
                              <p>{{$print->slip_id}}</p>
                              <p><input type="text" class="outline-none" placeholder="กรอกวันที่"></input></p>
                              <p><input type="text" class="outline-none" placeholder="กรอกวันที่"></input></p>
                              <p>ส.พานิชย์</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="text-sm my-2">
                     <h3 class="text-sky-400">ลูกค้า</h3>
                     <input type="text" class="outline-none" placeholder="กรอกชื่อ"></input>
                  </div>
                  <div class="overflow-x-auto">
                     <table class="w-full table-auto border-collapse text-sm">
                        <thead class="border-y-2 border-slate-300">
                           <tr class="h-8 font-normal">
                              <th class="w-10 font-normal">#</th>
                              <th class="font-normal">รายละเอียด</th>
                              <th class="w-28 text-right font-normal">จำนวน</th>
                              <th class="w-28 text-right font-normal">ราคาต่อหน่วย</th>
                              <th class="w-28 text-right font-normal">ยอดรวม</th>
                           </tr>
                        </thead>
                        <tbody>
                          @php
                          $i=0;
                          @endphp
                        @foreach($print->listall as $key =>$row)

                           <tr class="border-b border-slate-300 h-8">
                              <td class="text-center">{{$i+=1}}</td>
                              <td>{{$row}}</td>
                              <td class="text-right">{{$print->listcount[$key]}}</td>
                              <td class="text-right">{{number_format($print->listprice[$key], 2 )}}</td>
                              <td class="text-right">{{number_format($print->listprice[$key]*$print->listcount[$key],2)}}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="grid grid-cols-2 my-4 text-sm">
                     <div class="flex items-end">
                        <!-- <p class="py-1">(หนึ่งหมื่นถ้วน)</p> -->
                        <input type="text" class="outline-none my-1" placeholder="กรอกจำนวนเงิน"></input>
                     </div>
                     <div class="grid grid-cols-2">
                        <div class="text-right text-sky-400">
                           <p class="py-1">รวมเป็นเงิน</p>
                           <p class="py-1">จำนวนเงินรวมทั้งสิน</p>
                        </div>
                        <div class="text-right">
                           <p class="py-1">{{$print->total_price}} บาท</p>
                           <p class="py-1">{{$print->total_price}} บาท</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="grid grid-cols-2 gap-8 text-sm">
                  <div>
                     <p>ในนาม <input type="text" class="outline-none ml-1" placeholder="กรอกชื่อ"></input></p>
                     <div class="flex gap-4 pt-20">
                        <p class="w-36 text-center border-t py-2">ผู้รับสินค้าบริการ</p>
                        <p class="w-36 text-center border-t py-2">วันที่</p>
                     </div>
                  </div>
                  <div>
                     <p class="text-right"> <input type="text" class="outline-none text-right" placeholder="ในนาม ชื่อร้านค้า"</p>
                     <div class="flex justify-end gap-4 pt-20">
                        <p class="w-36 text-center border-t py-2">ผู้อนุมัติ</p>
                        <p class="w-36 text-center border-t py-2">วันที่</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   
   </body>
</html>
