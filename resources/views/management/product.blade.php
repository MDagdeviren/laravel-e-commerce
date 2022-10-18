<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- Modal Add Product --}}
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <button class="btn btn-primary modal-add-pr" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" >Add Product</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addproduct" enctype="multipart/form-data">
              <select id="categorySelect" class="form-group form-select" aria-label="Default select example">
                <option selected disabled hidden>Select Category</option>
                @foreach ($categories as $category)
                <option value={{ $category->id }}>{{ $category->name }}</option>
                @endforeach
              </select>
              <select id="subSelect" name='sub_category_id' class="mt-3 form-group form-select" aria-label="Default select example">
                <option selected disabled hidden>Select Sub Category</option>
              </select>
              <div class="form-group">
                <label>Product Name</label>
                <input type="text" id='productname' class="form-control" name="name"/>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="text" id='productprice' class="form-control" name="price"/>
              </div>
              <div class="form-group input-group mt-3">
                <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" id="inputGroupFile02" name='image'>
              </div>
              <div hidden class="form-group alert alert-danger">
                <ul class="err-mess">   
                </ul>
              </div>
              <div class="form-group modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Table Product --}}
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Sub Category Name</th>
            <th scope="col">Parent Category Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead >
        <tbody class="tbody-product">
          @foreach ($products as $product)
          <tr product_id={{ $product->id }}>
            <td>{{ $product->name }}</td>
            <td>{{ $product->subCategory->name}}</td>
            <td>{{ $product->subCategory->category->name }}</td>
            <td><button class="btn btn-primary edit-product-btn" product_id={{ $product->id }} type="button" data-bs-toggle="modal" data-bs-target="#editproductmdl">Edit</button></td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
      <!-- Modal -->
<div class="modal fade" id="editproductmdl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="editproduct">
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" id="updproductname" class="form-control" name="name"/>
          </div>
          <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" name="price"/>
          </div>
          <div hidden class="form-group alert alert-danger">
            <ul class="err-mess">   
            </ul>
          </div>
          <div class="form-group modal-footer">
            <button type="submit" class="btn btn-primary updProduct ">Save changes</button>
            <button type="button" class="btn btn-danger deleteProduct" data-bs-dismiss="modal">Delete</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</x-app-layout>