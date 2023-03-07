<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
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
            <table class ="center">
                <tr class = "product_list">
                    <th class="th_deg">No</th>
                    <th class="th_deg">Address</th>
                    <th class="th_deg">Total Price</th>
                    <th class="th_deg">Shipment Number</th>
                    <th class="th_deg">Status</th>
                    <th class="th_deg">View Orders</th>
                    <th class="th_deg">Proof of Payment</th>
                    <th class="th_deg">Input Shipment</th>
                </tr>
                <?php $no=1;?>
                @foreach($orders as $orders)
                <tr class = "product_list">
                    <td>{{$no}}</td>
                    <td>{{$orders->keranjang->user->address}}</td>
                    <td>{{$orders->total_harga}}</td>
                    <td>{{$orders->resi_Pengiriman}}</td>
                    <td>{{$orders->status}}</td>
                    <?php $no=$no+1?>
                    <td>
                        <a class = "btn" href="{{url('ordersDetail',$orders->id_orders)}}">View</a>
                    </td>
                    <td>
                        <a class = "btn" href="{{url('admin_paymentProof',$orders->id_orders)}}">View</a>
                    </td>
                    <td>
                        <a class = "btn" href="{{url('add_shippment',$orders->id_orders)}}">Input</a>
                    </td>

                </tr>
                @endforeach
            </table>
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