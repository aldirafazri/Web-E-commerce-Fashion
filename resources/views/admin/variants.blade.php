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
                    <th class="th_deg">Size</th>
                    <th class="th_deg">Stock</th>
                    <th class="th_deg">Edit Variant</th>
                    <th class="th_deg">Delete Variant</th>
                    <th class="th_deg">History</th>
                </tr>
                @foreach($variants as $variants)
                <tr class = "product_list">
                  
                    <td>{{$variants->ukuran}}</td>
                    <td>{{$variants->stok}}</td>
                    <td>
                        <a class = "btn" href="{{url('edit_variants',$variants->id_variant)}}">Set Stock</a>
                    </td>
                    <td>
                        <a class = "btn" href="{{url('delete_variants',$variants->id_variant)}}">Delete</a>
                    </td>
                    <td>
                        <a class = "btn" href="{{url('history_variants',$variants->id_variant)}}">History</a>
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