@extends('layouts.shop')
@inject('ThaiFormat', 'App\Services\ThaiDate')
@section('content')
 
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>สินค้าขายดีค้นหาจากวันที่</h5>
            </div>
            <form action="{{ route('category_store') }}" method="POST" enctype="multipart/form-data"> 
            <div class="row">
                <div class="col-12"  style="margin-left: 10px">
                    <div class="input-group input-group-static ">
                        <h6>เวลาเริ่มต้น</h6> &nbsp;
                        <h6> {{ $ThaiFormat->makeFormat2($from) }}</h6>
                        &nbsp; <h6>-</h6>&nbsp;
                        <h6>เวลาสิ้นสุด</h6> &nbsp;
                        <h6> {{ $ThaiFormat->makeFormat2($to) }}</h6>
                      </div>
                </div>

            

                
            </div>
        </form>
    
        </div>

        <br>

       


        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>ข้อมูล</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ลำดับ
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ชื่อสินค้า
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                จำนวน
                            </th>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ราคาต่อชิ้น</th>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ราคารวม</th>

                            
                             
                            
                        </tr>
                    </thead>

                    <tbody>


                      @php
                       $i=1;
                       $sum=0;
                       $qty=0;
                      @endphp
                       
                        @foreach ($orders as $item)
                            
                       
                        
                            <tr>
                                <td>
                                  
                                    <div class="d-flex px-2">
                                        <div class="my-auto">
                                            <b>
                                               {{{$i++}}}
                                            </b>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <b>{{$item->name}}</b>
                                       
                                    

                                </td>
                              
                                <td>
                                    @php
                                            $qty += $item->total_qty;
                                        @endphp
                                    <b>{{$item->total_qty}} ชิ้น</b> 

                                </td>
                                <td>
                
                                <b>{{$item->price}} บาท</b>
                            </td>
                                <td>

                                        @php
                                            $sum += $item->price*$item->total_qty;
                                        @endphp


                                    <b>{{$item->price*$item->total_qty}} บาท</b>
                                </td>
                              

                               
                            </tr>
                       
                           
                            @endforeach
                    </tbody>
                </table>
                <h5 style="margin-left: 20px;color:red" >ยอดรวมจำนวน : {{$qty}}  ชิ้น</h5>
                <h5 style="margin-left: 20px;color:red">ยอดขายรวมไม่หักค้างชำระ : {{$sum}}  บาท</h5>
              
                @foreach ($orders1 as $item)
                <h5 style="margin-left: 20px;color:blue">{{$item->type_sale}} : {{$item->total}} บาท</h5>
                @endforeach

                <h5 style="margin-left: 20px">จ่ายยอดค้างชำระ : {{$payment}}  บาท</h5>


                
                <h5 style="margin-left: 20px">ยอดคืนของ : {{$refund}}  บาท</h5>

                <h3 style="margin-left: 20px;color:blue">ยอดขายรวมหลังการคำนวณทั้งหมด : {{$sum-$orders2+$payment}}  บาท</h5>

            </div>
        </div>

    </div>



    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                paging: true,
                lengthMenu: [10, 25, 50, 75, 100, 10000],
                ordering: false,
                info: false,

                "language": {
                    "search": "<b>ค้นหา</b>",
                    "zeroRecords": "ไม่พบข้อมูล - ขออภัย",
                    "info": '',
                    "infoEmpty": "ไม่มีข้อมูล",
                    "infoFiltered": "",
                    "lengthMenu": "   _MENU_ ",
                    "paginate": {
                        "previous": false,
                        "next": false
                    }
                }
            });
        });
    </script>
@endsection
