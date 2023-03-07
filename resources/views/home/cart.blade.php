<html lang="en">
<link href="home/css/cartcss.css" rel="stylesheet" />
<section class="product_section layout_padding">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Basket</title>
</head>

<body>
  <main>
    <div class="basket">
      <div class="basket-labels">
        <ul>
          <li class="item item-heading">Item</li>
          <li class="price">Price</li>
          <li class="quantity">Quantity</li>
          <li class="subtotal">Subtotal</li>
        </ul>
      </div>
      <?php $subtotal=0;?>
      <?php $totalweight=0;?>
      <?php $id_keranjang=-99;?>
      <?php $status=TRUE;?>
      
      @foreach($detailKeranjang as $detailKeranjang)
      <div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img src="products/{{$detailKeranjang->variant->products->gambar}}" alt="" class="product-frame">
          </div>
          <div class="product-details">
            <h1><strong><span class="item-quantity"></span>{{$detailKeranjang->variant->products->nama}}, Size {{$detailKeranjang->variant->ukuran}} </strong></h1>
            <p><strong></strong></p>
            <p>{{$detailKeranjang->variant->products->deskripsi}}</p>
          </div>
        </div>
        <div class="price">{{$detailKeranjang->variant->products->harga}}</div>
        @if($detailKeranjang->variant->stok < $detailKeranjang->jumlah)
          <div class="quantity">
          <h1><strong><span class="item-quantity"></span>out of stock</strong></h1>
          </div>
          <?php $status=FALSE?>
        @elseif($detailKeranjang->variant->stok >= $detailKeranjang->jumlah)
          <div class="quantity">
          <h1><strong><span class="item-quantity"></span>{{$detailKeranjang->jumlah}} </strong></h1>
          </div>
        @endif
        <div class="subtotal">{{$detailKeranjang->variant->products->harga*$detailKeranjang->jumlah}}</div>
        <div class="remove">
        <a class = "remove" href="{{url('delete_product_in_cart',$detailKeranjang->id)}}">Remove</a>
        </div>
      </div>
      <?php $subtotal=$subtotal+$detailKeranjang->variant->products->harga*$detailKeranjang->jumlah?>
      <?php $totalweight=$totalweight+$detailKeranjang->variant->products->berat*$detailKeranjang->jumlah?>
      <?php $id_keranjang=$detailKeranjang->id_keranjang?>

      @endforeach
      
      <?php $totalprice=(ceil($totalweight/1000)*8000) + $subtotal ?>

    

    @if($id_keranjang!=-99 && $status)
      </div>
          <form action="{{url('/make_order',$id_keranjang)}}" method="POST" enctype="multipart/form-data">
          <input class="subtotal-value final-value" type="hidden" name="subtotal" value={{$subtotal}} readonly="readonly" />
          <input class="subtotal-value final-value" type="hidden" name="totalharga" value={{$totalprice}} readonly="readonly" />
          
      @csrf
      <aside>
        <div class="summary">
          <div class="summary-total-items"><span class="total-items"></span> Order summary</div>
          
          <div class="summary-subtotal">
            <div class="subtotal-title">Subtotal</div>
            <label class="subtotal-value final-value" id="basket" value={{$subtotal}}>{{$subtotal}}</label>
          </div>
          <div class="summary-subtotal">
            <div class="subtotal-title">Address</div>
            <div class="alamat" id="basket-subtotal">{{$user->address}}</div>
          </div>
          <div class="summary-subtotal">
            <div class="subtotal-title">Total Weight</div>
            <div class="alamat" id="basket-subtotal"name="totalweight">{{$totalweight}} Gram</div>
          </div>
          <div class="summary-total">
            <div class="total-title">Total</div>
            <div class="total-value final-value" id="basket-total" name="totalprice">{{$totalprice}}</div>
          </div>
          <div class="summary-checkout">
            <input class="checkout-cta" type="submit" value="Order">
          </div>
        </div>
      </aside>
      </form>
      
    @endif
  </main>
</body>
</section>
</html>
