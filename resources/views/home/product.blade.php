<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">
               @foreach($products as $product)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{ url('view_product',$product->id_produk) }}"class="option1">
                           View
                           </a>
                          
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="products/{{$product->gambar}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product->nama}}
                        </h5>
                        <h6>
                           {{$product->harga}}
                        </h6>
                     </div>
                  </div>
               </div>

               @endforeach
               
         </div>
         <div class="btn-box">
               <a href="{{ url('view_all_product') }}">
               View All products
               </a>
            </div>
      </section>