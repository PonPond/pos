@extends('layouts.shop')

@section('content')
    <div class="col-lg-2">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">เพิ่มสินค้า</h6>
                    </div>

                </div>
            </div>
            <div class="card-body p-3 pb-0">

                <form action="{{ route('product_store') }}" method="POST" enctype="multipart/form-data">
                    <form id="post-form">
                        @csrf
                        <div class="row">


                            <div class="input-group input-group-outline my-3">
                                <input type="text" class="form-control" placeholder="ชื่อสินค้า" name="name">
                            </div>

                            <div class="input-group input-group-outline mb-1">
                                <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                                    <option>กรุณาเลือกประเภท</option>
                                    @foreach ($typeCategory as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline my-3">
                                    <input type="text" class="form-control" placeholder="ราคาปลีก" name="priceP">
                                </div>


                            </div>
                            @error('priceP')
                                <div class="my-2">
                                    <span class="text-danger my-2"> {{ $message }} </span>
                                </div>
                            @enderror
                            <div class="col-6">
                                <div class="input-group input-group-outline my-3">
                                    <input type="text" class="form-control" placeholder="ราคาส่ง" name="priceS">
                                </div>


                            </div>
                            @error('priceS')
                                <div class="my-2">
                                    <span class="text-danger my-2"> {{ $message }} </span>
                                </div>
                            @enderror
                            <div class="input-group input-group-outline my-1">
                                <input type="text" class="form-control" placeholder="จำนวน" name="qty">
                            </div>
                            @error('qty')
                                <div class="my-2">
                                    <span class="text-danger my-2"> {{ $message }} </span>
                                </div>
                            @enderror

                            <div class="input-group input-group-static my-3">
                                <input type="text" class="form-control" placeholder="BARCODE ID" name="id_product">
                            </div>
                            @error('id_product')
                                <div class="my-2">
                                    <span class="text-danger my-2"> {{ $message }} </span>
                                </div>
                            @enderror

                            <button type="input" class="btn btn-success">Add Product</button>


                        </div>

                    </form>
            </div>
        </div>

        <br><br>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <strong>สำเร็จ !</strong> เพิ่มสินค้าลงในรายการขายเรียบร้อย
            </div>
        @endif

        @if (session('update'))
            <div class="alert alert-success" role="alert">
                <strong>สำเร็จ !</strong> แก้ไขข้อมูลสินค้าเรียบร้อย
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>พบข้อผิดพลาด !</strong> ไม่พบสินค้าในฐานข้อมูล
            </div>
        @endif

        @if (session('delete'))
            <div class="alert alert-danger" role="alert">
                <strong>สำเร็จ !</strong> ลบข้อมูลเรียบร้อย
            </div>
        @endif

    </div>

    <div class="col-lg-10">

        <div class="card">
            <div class="card-header p-3 pt-2">


                <h5>รายการสินค้า</h5> <a
                    href="https://27.254.144.129/phpMyAdmin/index.php?route=/sql&pos=0&db=admin_pos&table=products"
                    target="_blank" class="btn btn-primary" style="float: left;">ข้อมูลสินค้า</a>

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
                    ajax: "{{ route('product.index') }}",
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
