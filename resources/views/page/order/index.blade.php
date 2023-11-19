@extends('layouts.shop')
@inject('ThaiFormat', 'App\Services\ThaiDate')
@section('content')
 
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header p-3 pt-2">

                <h5>รายการขายปลีก</h5>
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

                        
                              
                                <th>
                            

                                </th>

                                
                                <th>
                            

                                </th>
                            
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>


    @push('scripts')


    <script type="text/javascript">
        $(document).ready(function () {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('listindex') }}",
                columns: [
            { data: 'slip_id', name: 'slip_id' },
            { data: 'type_sale', name: 'type_sale' }, // New column for category name
            { data: 'total_price', name: 'total_price' },
            { data: 'created_at', name: 'created_at'},
            { data: 'action', name: 'action', orderable: false, searchable: false },
            
            { data: 'action1', name: 'action1', orderable: false, searchable: false }
                ],
                deferRender: true,
                serverSide: true,
                processing: true,
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
@endpush
@endsection
