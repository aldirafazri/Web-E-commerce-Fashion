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
        <div class="main-panel">

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
            @endif

        <form action="{{url('/add_shippment_confirm',$orders->id_orders)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
  
      <label class = "text_colour" for="pweight">Input Shippment Number</label>
      <input class = "text_colour" type="integer" name="resi_Pengiriman" placeholder="Shippment Number.." min="0" step="1">
  
      <input type="submit" value="Submit">
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