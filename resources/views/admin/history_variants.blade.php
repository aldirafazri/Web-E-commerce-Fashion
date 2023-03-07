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
                    <th class="th_deg">No</th>
                    <th class="th_deg">ID Admin</th>
                    <th class="th_deg">Old Stock</th>
                    <th class="th_deg">New Stock</th>
                    <th class="th_deg">Time Edited</th>
                </tr>
                <?php $no=1;?>
                @foreach($History_variants as $History_variants)
                <tr class = "product_list">
                    <td>{{$no}}</td>
                    <td>{{$History_variants ->id_admin}}</td>
                    <td>{{$History_variants ->stok_lama}}</td>
                    <td>{{$History_variants ->stok_baru}}</td>
                    <td>{{$History_variants ->waktu}}</td>
                    <?php $no=$no+1?>
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