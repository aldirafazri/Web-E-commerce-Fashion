<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/Icon Zalira.png" type="">
      <title>Zalira</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      
      <link rel="stylesheet" href="home/css/custorders.css" />
      
      
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <header class="clearfix">
      <div id="logo">
        <img src="/images/logo zalira.png">
      </div>
      <h1>ORDERS</h1>
      <div id="company" class="clearfix">
        <div>ZALIRA</div>
        <div>(021) 519-0450</div>
        <div><a href="mailto:company@example.com">zalira@gmail.com</a></div>
      </div>
      <div id="project">
        <div><span>&ensp;&ensp;&ensp;&ensp;&ensp;BUYER NAME&ensp; </span> &ensp;&ensp;&ensp;&ensp;: &ensp;{{$orders->keranjang->user->name}} </div>
        <div><span>EMAIL </span>:&ensp;{{$orders->keranjang->user->email}} </div>
        <div><span>&ensp;&ensp;&ensp;&ensp;&ensp;ADDRESS</span> &ensp;&ensp;:&ensp;{{$orders->keranjang->user->address}} </a></div>
      
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">PRODUCT NAME</th>
            <th class="desc">DESCRIPTION</th>
            <th class="service" >NUM OF ITEMS</th>
            <th class="service">SIZE</th>
            
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($detailKeranjang as $detailKeranjang)
          <tr>
            <td class="service">{{$detailKeranjang->variant->products->nama}}</td>
            <td class="desc">{{$detailKeranjang->variant->products->deskripsi}}</td>
            <td class="service">{{$detailKeranjang->jumlah}}x</td>
            <td class="service">{{$detailKeranjang->variant->ukuran}}</td>
            <td class="total">Rp.{{$detailKeranjang->jumlah*$detailKeranjang->variant->products->harga}}</td>
            @endforeach
          </tr>
          <tr>
          
          </tr>
          <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">Rp.{{$orders->subtotal}}</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL (INCLUDE SHIPPMENT)</td>
            <td class="grand total">Rp.{{$orders->total_harga}}</td>
          </tr>

          <tr>
            <td colspan="4" class="grand total">SHIPPMENT NUMBER</td>
            <td class="grand total">{{$orders->resi_Pengiriman}}</td>
          </tr>
        </tbody>
      </table>
         <!-- slider section -->
      </div>
      
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>