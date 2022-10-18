<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container-sm">
        <div class="card">
        <h5 class="card-header">Category Management</h5>
        <div class="card-body">
          <h5 class="card-title">Main Categories</h5>
          <h5 class="card-title">Sub Categories</h5>
          <a href="{{ route('category.index') }}" class="btn btn-primary">Category Management</a>
        </div>
      </div>
      <div class="card">
        <h5 class="card-header">Product Management</h5>
        <div class="card-body">
          <h5 class="card-title">Products</h5>
          <a href="{{ route('product.index') }}" class="btn btn-primary">Product Management</a>
        </div>
      </div>
    </div>
    <div class="d-grid gap-2 col-2 mx-auto">
      <a href="#" class="btn btn-primary">Show All Products</a>
      
    </div>
    
</x-app-layout>
