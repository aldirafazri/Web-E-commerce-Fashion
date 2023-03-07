<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
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
            <table class ="center">
                <tr class = "product_list">
                
                    <th class="th_deg">No</th>
                    <th class="th_deg">Address</th>
                    <th class="th_deg">Total Price</th>
                    <th class="th_deg">Shippment Number</th>
                    <th class="th_deg">Status</th>
                    <th class="th_deg">View Orders</th>
                    <th class="th_deg">Proof of Payment</th>
                </tr>
                <?php $no=1;?>
                @foreach($keranjang as $keranjang)
                <tr class = "product_list">
                    <td>{{$no}}</td>
                    <td>{{$keranjang->user->address}}</td>
                    <td>{{$keranjang->orders->total_harga}}</td>
                    <td>{{$keranjang->orders->resi_Pengiriman}}</td>
                    <td>{{$keranjang->orders->status}}</td>
                    <?php $no=$no+1?>
                    <td>
                        <a class = "btn" href="{{url('orderscustdetail',$keranjang->orders->id_orders)}}">View</a>
                    </td>
                    <td>
                        <a class = "btn" href="{{url('add_paymentProof',$keranjang->orders->id_orders)}}">View</a>
                    </td>

                </tr>
                @endforeach
            </table>
            <div>
               <a class = "btn2" href="{{url('orderscustdetail')}}">View</a>
            </div>
            
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