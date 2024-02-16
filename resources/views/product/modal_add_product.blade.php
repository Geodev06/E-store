  <!-- Modal -->
  <div class="modal fade" id="modal_add_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
                  <span data-bs-dismiss="modal" aria-label="Close"><span class="mdi mdi-window-close" style="cursor: pointer;"></span></span>
              </div>
              <div class="modal-body">
                  <form role="form" id="add_product_form" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label>Product Name</label>
                                  <input type="text" class="form-control" name="name" placeholder="Enter Product Name">
                                  <span class="label_error error_name"></span>
                              </div>
                              <div class="mb-3">
                                  <label>Category</label>
                                  <select multiple id="category_ids" name="category_ids[]">
                                      @foreach($categories as $item)
                                      <option value="{{$item->id}}">{{$item->category}}</option>
                                      @endforeach
                                  </select>
                                  <span class="label_error error_category_ids "></span>

                              </div>
                              <div class="mb-3">
                                  <label>Description</label>
                                  <textarea class="textarea-x" placeholder="Enter description" cols="30" rows="4" name="description"></textarea>
                                  <span class="label_error error_description "></span>
                              </div>

                              <div class="mb-3">
                                  <label>Price</label>
                                  <input type="text" placeholder="Enter Price" class="form-control" name="price"></input>
                                  <span class="label_error error_price "></span>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <div class="mb-3">
                                  <label>Cover Image</label>
                                  <input type="file" class="form-control" name="photo" id="product-input" accept=".jpg, .jpeg, .png">
                                  <div id="product-preview"></div>
                                  <span class="label_error error_photo "></span>
                              </div>
                              <div class="mb-3">
                                  <label>Book file</label>
                                  <input type="file" class="form-control" name="file"  accept=".pdf">
                                  <span class="label_error error_file "></span>
                              </div>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-dark mt-4 mb-3 float-end" id="btn-save">Save</button>

                  </form>
              </div>

          </div>
      </div>
  </div>