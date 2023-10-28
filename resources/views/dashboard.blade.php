@extends('layouts.shop')

@section('content')



<div class="row"> 
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">add_shopping_cart</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize"><b>สินค้าทั้งหมดในระบบ</b></p>
                    <h4 class="mb-0">{{$qty->total_qty}} ชิ้น</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
               
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">add_shopping_cart</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize"><b>ประเภทสินค้าทั้งหมด</b></p>
                    <h4 class="mb-0">{{$category->total_qty}} ประเภท</h4>
                </div>
                
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
               
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize"><b>ลูกหนี้ทั้งหมดในระบบ</b></p>
                    <h4 class="mb-0">{{$debtors->total_qty}} คน</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize"><b>ยอดขายทั้งหมดในระบบ</b></p>
                    <h4 class="mb-0">{{$price->total_qty}} บาท</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
               
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
<div class="col-6">

    <div class="card mb-3">
        <div class="card-header p-3 pt-2">
            <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"><b>ยอดขายแบ่งตามประเภทสินค้า</b></p>   
            </div>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="doughnut-chart" class="chart-canvas" height="300px"></canvas>
          </div>
        </div>
      </div>
</div>

<div class="col-6">
    <div class="card mb-3">
        <div class="card-header p-3 pt-2">
            <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize"><b>ยอดขายรายเดือน</b></p>   
            </div>
        </div>
        <div class="card-body p-3">
        <div class="chart">
        <canvas id="mixed-chart" class="chart-canvas" height="300px"></canvas>
        </div>
        </div>
        </div>

       
</div>

<a href="http://localhost/phpmyadmin/index.php?route=/database/export&db=pos"  target="_blank" class="btn btn-primary"> Export DB</a>

<a href="{{ route('upload.form') }}"  target="_blank" class="btn btn-success"> พื้นที่เก็บไฟล์</a>


<script src="../assets/js/plugins/chartjs.min.js"></script>




<script type="text/javascript">
   
   

      // Doughnut chart
      var ctx3 = document.getElementById("doughnut-chart").getContext("2d");

      new Chart(ctx3, {
        type: "doughnut",
        data: {
          labels: {!!json_encode($dash1)!!},
          datasets: [{
            label: "Projects",
            weight: 9,
            cutout: 60,
            tension: 0.9,
            pointRadius: 2,
            borderWidth: 2,
            backgroundColor: ['#03a9f4', '#3A416F', '#fb8c00', '#a8b8d8', '#e3316e'],
            data: {!!json_encode($dash1_1)!!},
            fill: false
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                display: false
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                display: false,
              }
            },
          },
        },
      });

      
     
      

      // Mixed chart
      var ctx7 = document.getElementById("mixed-chart").getContext("2d");

      new Chart(ctx7, {
        data: {
          labels: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
          datasets: [{
              type: "bar",
              label: "ยอดขาย",
              weight: 5,
              tension: 0.4,
              borderWidth: 0,
              pointBackgroundColor: "#3A416F",
              borderColor: "#3A416F",
              backgroundColor: '#3A416F',
              borderRadius: 4,
              borderSkipped: false,
              data: {!!json_encode($summon)!!} ,
              maxBarThickness: 10,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: true,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 10,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });

     

     

     
    </script>


@endsection
