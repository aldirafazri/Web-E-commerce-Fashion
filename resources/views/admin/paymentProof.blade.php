<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/public">
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
                <form action="{{url('/admin_paymentProof_confirm',$orders->id_orders)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <label class = "text_colour" for="pname">Current Proof of Payment: </label>
                <div class="paymentProof">
                    <img data-image="p1" class="active" src="/orders/{{$orders->gambar}}"alt="">
                </div>

                <label class = "text_colour" for="ukuran">Check</label>
                <select class = "text_colour" id="ukuran" name="status">
                    <option class = "text_colour" value="Orders valid">Valid</option>
                    <option class = "text_colour" value="Payment not valid">Not valid</option>
                </select>
                
                <input type="submit" value="Validate">
                </form>
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