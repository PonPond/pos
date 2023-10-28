@extends('layouts.shop')
@inject('ThaiFormat', 'App\Services\ThaiDate')
@section('content')

<h4>รายการหนี้: {{$deb->name}} เบอร์โทร : {{$deb->phone}}</h4>
<br>
<div class="col-lg-6">



    <div class="card">
        <div class="card-header p-3 pt-2">

            <h5>ยอดค้าง</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0" id="myTable">
                <thead>
                
                      
                  
                    <tr>

                        <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                            ID SLIP
                        </th>
                        <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                            ประเภทการชำระ
                        </th>
                        <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                            ยอดรวม
                        </th>
                    
                        <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                            เวลาที่ขาย</th>

                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ใบเสร็จ
                            </th>
                          
                       
                    </tr>
                </thead>

                <tbody>

                    @php
                        $sumtotal = 0;
                    @endphp

                    @foreach ($deb2 as $item)
                   
               
                   
                        <tr>
                            <td>
                              
                                <div class="d-flex px-2">
                                    <div class="my-auto">
                                        <b>
                                            {{$item->slip_id}}
                                        </b>

                                    </div>
                                </div>
                            </td>
                                
                            <td>
                                <b>{{$item->type_sale}}</b>
                            </td>

                            <td>
                                
                                <b>{{$item->total_price}} บาท</b>

                                @php
                                    $sumtotal += $item->total_price ;
                                @endphp
                            </td>

                            <td>
                                <b>{{ $ThaiFormat->makeFormat($item->created_at) }}</b>

                            </td>
                           


                            <td class="align-middle">
                                <a   href="{{ URL::to('generate-pdf2/' . $item->id) }}"
                                    target="_blank"  class="text-danger" > รายละเอียด <i class="fas fa-print"></i></a>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

            <h5 style="margin-left: 10px">ยอดค้างชำระ: {{ $sumtotal}} บาท</h5>
            
        </div>
    </div>

</div>
<div class="col-lg-6">


        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>รายการชำระหนี้</h5>
            </div>
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn bg-gradient-primary " style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    เพิ่มการชำระหนี้ของ : {{$deb->name}}
                </button>
  
  
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">แบบฟอร์มเพิ่มการจ่ายเงิน</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="modal-body">
                                            
                                                <form action="{{ route('debtors_storeid') }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="input-group input-group-static mb-4">
                                                                    <label><b>ยอดจ่าย</b></label>
                                                                    <input type="text" class="form-control" name="amount" >
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group input-group-static mb-4">
                                                                    <label><b>รหัสลูกหนี้</b></label>
                                                                    <input type="text" class="form-control" name="debt_id" value="{{$deb->id}}" readonly >
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">ปิด</button>
                                                            <button type="submit" class="btn bg-gradient-primary">บันทึก</button>
                                                        </div>
                                                    </form>
                                            
                                            </div>

                                        </div>
                                    
                                    </div>
                                    </div>
                                </div>
                </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTable1">
                    <thead>
                        <tr>

                           
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2" style="text-align: center">
                                ยอดจ่าย
                            </th>
                          
                        
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2" style="text-align: center">
                                เวลาที่จ่าย</th>

                                <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2" style="text-align: center">
                                    จัดการ</th>
                                
                            
                        </tr>
                    </thead>

                    @php
                    $suma = 0;
                     @endphp
                    <tbody>


                        @foreach ($deb3 as $item)
                       
                        
                       
                            <tr>
                            

                                <td style="text-align: center">
                                    @php
                                    $suma += $item->amount ;
                                @endphp
                                 <b>{{$item->amount}} บาท</b>

                                </td>
                                <td style="text-align: center">
                                    
                                    <b>{{ $ThaiFormat->makeFormat($item->created_at) }} </b>
                                </td>
                                
                                <td style="text-align: center">
                                    <a href="{{ url('/payment/delete/' . $item->id) }}"class="btn btn-secondary btn-sm bg-gradient-danger mb-3"
                                        onclick="return confirm('ลบหรือไม่ ?')"> ลบข้อมูล</a>
                                </td>


                              
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <h5 style="margin-left: 10px">ยอดจ่ายทั้งหมด: {{ $suma}} บาท</h5>
            </div>
        </div>
        <br>
        @if (session('success'))

        <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
            <span class="alert-text">  <strong>สำเร็จ !</strong> เพิ่มการชำระหนี้เรียบร้อย</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
  

<div class="col-lg-12">



    <div class="card">
        <div class="card-header p-3 pt-2">

            <h5>สรุปยอด</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0" id="myTable">
                <thead>
                
                      
                  
                    <tr>

                        <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                            ยอดค้างทั้งหมด
                        </th>
                        <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                            จ่ายแล้ว
                        </th>
                        <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                            ยอดค้างคงเหลือ
                        </th>
                        
                       
                    </tr>
                </thead>

                <tbody>

                   
                        <tr>
                          
                            <td>
                               <h2>{{$sumtotal}} บาท</h2> 
                            </td>

                          
                                
                              

                            <td>
                              
                                <h2>{{$suma}} บาท</h2> 
                            </td>
                           

                            <td>
                              
                                <h2>{{$sumtotal-$suma}} บาท</h2> 
                            </td>
                          
                        </tr>
                


                </tbody>
            </table>

           
            
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
    <script>
        $(document).ready(function() {
            $('#myTable1').DataTable({
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
