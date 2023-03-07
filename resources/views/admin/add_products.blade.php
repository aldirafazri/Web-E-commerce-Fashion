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
        <div class="main-panel">

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
            @endif

        <form action="{{url('/add_products_confirm')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
      <label class = "text_colour" for="pname">Product Name</label>
      <input class = "text_colour" type="text" name="nama" placeholder="Product name.." required="">
  
      <label class = "text_colour" for="pweight">Product Weight</label>
      <input class = "text_colour" type="integer" name="berat" placeholder="Product weight.." min="0" step="1">

      <label class = "text_colour" for="pprice">Product Price</label>
      <input class = "text_colour" type="integer"  name="harga" placeholder="Product price.." min="0" step="1" >

      <label class = "text_colour" for="iimage">Input Image</label>
      <input class = "text_colour" type="file"  name="gambar" placeholder="Input image.." required="">
  
      <label class = "text_colour" for="description">Description</label>
      <textarea class = "text_colour" id="description" name="deskripsi" placeholder="Describe the product.." style="height:200px" required=""></textarea>
  
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