@extends('layouts.shop')

@section('content')
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header p-3 pt-2">


                <h5>รายการสินค้าที่ถูกลบ</h5>
                <!-- <a
                        href="https://27.254.144.129/phpMyAdmin/index.php?route=/sql&pos=0&db=admin_pos&table=products"
                        target="_blank" class="btn btn-primary" style="float: left;">ข้อมูลสินค้า</a> -->

            </div>
            <div class="table-responsive">

                <table class="table align-items-center mb-0" id="myTable">
                    <div class="form-group">

                    </div>
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">รหัสสินค้า</th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7">ประเภท</th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">ชื่อสินค้า
                            </th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ราคาปลีก/ส่ง</th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">
                                ราคาส่ง</th>
                            <th class="text-uppercase text-secondary  text-1xl font-weight-bolder opacity-7 ps-2">จำนวน</th>

                            <th></th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>

    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#myTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('product.menu_delete') }}",
                    columns: [{
                            data: 'id_product',
                            name: 'id_product'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        }, // New column for category name
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'priceP',
                            name: 'priceP'
                        },
                        {
                            data: 'priceS',
                            name: 'priceS'
                        },
                        {
                            data: 'qty',
                            name: 'qty'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    deferRender: true,
                    // Pagination with server-side processing
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
