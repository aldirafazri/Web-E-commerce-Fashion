<main class="container">
<link href="home/css/detailProduct.css" rel="stylesheet" />
 
  <!-- Left Column / Headphones Image -->
  <div class="left-column">
    <img data-image="p1" class="active" src="/products/{{$products->gambar}}" alt="">
  </div>
 
 
  <!-- Right Column -->
  <div class="right-column">
 
    <!-- Product Description -->
    <div class="product-description">
      <span>Product Detail</span>
      <h1>{{$products->nama}}</h1>
      <p>{{$products->deskripsi}}</p>
    </div>
 
    <form action="{{url('add_cart')}}" method="Post">
      @csrf
    <!-- Product Configuration -->
    <div class="product-configuration">
 
      <!-- Product Color -->
      <label for="size-select">Select size:</label>
      <div class="product-color">

        <select name="ukuran" id="size-select">
          	<option value="">--Please Select Size--</option>
            @foreach($variants as $variant)
            <option value="{{$variant->id_variant}}">{{$variant->ukuran}} stock: {{$variant->stok}}</option>
            @endforeach
        </select>
        
        
 
      </div>
 
      
    </div>
 
    <!-- Product Pricing -->

    <div class="product-price">
        <span>Product weight: </span> 
      <span>{{$products->berat}}</span>
    </div>
    
    <div class="product-price">
        <span>Product Price: </span> 
      <span>{{$products->harga}}</span>
    </div>

    <div class="cart-btn">
        <input type="submit" value="Add to Cart">
    </div>

  </div>
  </form>
</main>
