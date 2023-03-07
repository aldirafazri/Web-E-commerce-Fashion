<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/public">
    @include('admin.css')
    
    <link rel="stylesheet" href="home/css/orders.css" />
    <link rel="stylesheet" href="home/css/add_product.css" />
  </head>
  <body>
    <div class="container-scroller">
     <!-- Partial sidebar -->
     @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
       <div class = "main-panel">
            <div class="container">
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
   
      </div>
            </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>