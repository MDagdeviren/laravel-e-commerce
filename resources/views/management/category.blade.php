<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>
    <div class="d-grid gap-1 d-md-flex justify-content-md-end">
      <button class="btn btn-primary me-md-2" type="button" id="addpar" data-bs-toggle="modal" data-bs-target="#parentmodal">Add Parent</button>
      <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#subModal">Add Sub</button>
    </div>
      <div class="modal fade" id="parentmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Parent</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
              <form id="addForm" >
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" id='categoryname' class="form-control" name="name"/>
                </div>
                <div hidden class="form-group alert alert-danger">
                  <ul class="err-mess">   
                  </ul>
                </div>
                <div class="form-group modal-footer">
                  <button type="submit" class="btn btn-primary btn-block add-parent">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="subModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Sub</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="addsubcategory" >
                <select name='select' id="selectcategory" class="form-group form-select" aria-label="Default select example">
                  <option selected disabled hidden >Open this select menu</option>
                  @foreach ($categories as $category)
                  <option value={{ $category->id }}>{{ $category->name }}</option>
                  @endforeach
                </select>
                <div class="form-group">
                  <label>Sub Category Name</label>
                  <input type="text" id='subcategoryname' class="form-control" name="name"/>
                </div>
                <div hidden class="form-group alert alert-danger">
                  <ul class="err-mess">   
                  </ul>
                </div>
                <div class="form-group modal-footer">
                  <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {{-- <div hidden class="alert alert-danger">
        <ul class="err-mess">   
        </ul>
    </div> --}}
    <table class="table">
        <thead>
          <tr>
            
            <th scope="col">Sub Category Name</th>
            <th scope="col">Parent Category Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="tbody-category">
           @foreach ($sub_categories as $sub_category)
          <tr sub_category_id={{ $sub_category->id }} >
            <td>{{ $sub_category->name}}</td>
            <td category_id={{ $sub_category->category->id }}>{{ $sub_category->category->name }}</td>
            <td><button class="btn btn-primary edit-button" sub_category_id={{ $sub_category->id }} category_id={{ $sub_category->category->id }} type="button" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
            {{-- Edit Modal --}}
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body ">
                    <div class="d-grid gap-2 d-md-block group-button">
                      <button class="btn btn-primary e-ctgry" type="button">Edit Category</button>
                      <button class="btn btn-primary e-sbctgry" type="button">Edit Sub Category</button>
                      <form class="editparent" >
                        <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" id="updatecategoryname" class="form-control" name="name"/>
                        </div>
                        <div hidden class="form-group alert alert-danger">
                          <ul class="err-mess">   
                          </ul>
                        </div>
                        <div class="form-group modal-footer">
                          <button type="submit" class="btn btn-primary btn-block getId">Save changes</button>
                          <button type="button" id="deleteMain" data-bs-dismiss="modal" class="btn btn-danger ">Delete</button>
                        </div>
                      </form>
                      <form class="editsub">
                        <div class="form-group">
                          <label>Sub Category Name</label>
                          <input type="text" id="updatesubname" class="form-control" name="name"/>
                        </div>
                        <div hidden class="form-group alert alert-danger">
                          <ul class="err-mess">   
                          </ul>
                        </div>
                        <div class="form-group modal-footer">
                          <button type="submit"class="btn btn-primary btn-block updSub">Save changes</button>
                          <button type="button" data-bs-dismiss="modal" class="btn btn-danger deleteSub" >Delete</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="form-group modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
</x-app-layout>

