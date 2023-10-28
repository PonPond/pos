<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Barcode  </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container mt-5">
            <div class="container mt-4">
        
            <div class="mb-3">{!! DNS1D::getBarcodeHTML($productCode, 'C128') !!}</div>
  
        </div> 
        </div>
    </body>
</html>