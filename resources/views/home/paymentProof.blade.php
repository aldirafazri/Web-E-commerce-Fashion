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
      <base href="/public">
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />

      <link rel="stylesheet" href="home/css/custorders.css" />
      <link rel="stylesheet" href="home/css/paymentProof.css" />
      
      
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
            <form action="{{url('/add_paymentProof_confirm',$orders->id_orders)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
        <label class = "text_colour" for="pname">Current Proof of Payment: </label>
        <div class="paymentProof">
            <img data-image="p1" class="active" src="/orders/{{$orders->gambar}}" alt="">
        </div>

        <label class = "text_colour" for="image">Input Proof of Payment (Transfer to BNI 12345678)</label>
        <input class = "text_colour" type="file"  name="inputimage" placeholder="Input image.." required="">
    
        <input type="submit" value="Submit">
        </form>
        </div>
            
         <!-- slider section -->
      </div>
      
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">?? 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
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