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
            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
            @endif
            <table class ="center">
                <tr class = "product_list">
                    <th class="th_deg">Name</th>
                    <th class="th_deg">Weight</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Description</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Delete</th>
                    <th class="th_deg">View Variants</th>
                    <th class="th_deg">New Variants</th>
                </tr>
                @foreach($products as $products)
                <tr class = "product_list">
                    <td>{{$products->nama}}</td>
                    <td>{{$products->berat}}</td>
                    <td>{{$products->harga}}</td>
                    <td>{{$products->deskripsi}}</td>
                    <td>
                        <img class="img_size" src="/products/{{$products->gambar}}">
                    </td>
                    <td>
                        <a class = "btn btn-danger" href="{{url('delete_product',$products->id_produk)}}">Delete</a>
                    </td>
                    <td>
                        <a class = "btn btn-success" href="{{url('variants',$products->id_produk)}}">Variants</a>
                    </td>
                    <td>
                        <a class = "btn btn-success" href="{{url('add_variants',$products->id_produk)}}">Add Variants</a>
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