<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products List') }}
        </h2>
    </x-slot>
<div class="container">
  <div class="row justify-content-between">
    <div class="col-md-2 ">
      <a href={{route('products.index')}} class="btn btn-secondary">All Product</a>
  </div>
  <div class="col-md-6">
      <input class="form-control search-key" placeholder='Search'  type="text">
  </div>
  </div>
  <div class="row mt-3">
    <div class="col-md-3">
      <ul>
        @foreach ($categories as $category)
        <li>
          <input type="checkbox" class="option" name="short" id="short">
          <label for="short">{{ $category->name }}</label>
          <ul>
            @foreach ($category->subCategories as $subCategory)
            <li>
              <input type="checkbox" name="short-1" class="sub-option" id="{{$subCategory->id}}">
              <label for="short-1">{{ $subCategory->name }}</label>
            </li>
            @endforeach
          </ul>
        </li>
        @endforeach
      </ul>
    </div>
    <div class="col-md-9 row row-cols-3">
      @foreach ($products as $product) 
      <div class="col product-card" >
        <div class="card" style="width: 17rem;">
          <img src="{{ asset('Image/'.$product->image)}}" style="height: 250px" class="card-img-top" alt="{{ $product->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">${{ $product->price }}</p>
            <button type="button" class="btn btn-primary add-to-cart" data-id="{{ $product->id }}" >Add To Cart</button>
          </div>
        </div>
      </div>
        @endforeach
    </div>
  </div>
</div>

</x-app-layout>
<script>/*
  let params = new URLSearchParams(document.location.search);
  var id = params.get("sub_categories_id");
  console.log(id);
  
if (id === null || id == '') {
    
  } else {
    const dizi = id.split(",")
  
      dizi.forEach(element => {
          $('.sub-option#'+element).prop("checked",true)
          // $('.sub-option#'+element).parent().parent().parent().children()[0].indeterminate = true
          // console.log($('.sub-option#'+element).parent().parent().children().length);
          // if(dizi.length >= $('.sub-option#'+element).parent().parent().children().length){
          //  $('.sub-option#'+element).parent().parent().parent().children()[0].checked = true
          //  $('.sub-option#'+element).parent().parent().parent().children()[0].indeterminate = false
            
          // }
      });
  }
  */
</script>