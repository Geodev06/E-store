  <!-- Modal -->
  <div class="modal fade" id="modal_edit_category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Category</h1>
                  <span data-bs-dismiss="modal" aria-label="Close"><span class="mdi mdi-window-close" style="cursor: pointer;"></span></span>
              </div>
              <div class="modal-body">
                  <form role="form" id="edit_category_form" data-id="">
                      @csrf
                      <div class="mb-3">
                          <label>Category</label>
                          <input type="text" class="form-control" name="category" placeholder="Enter category" id="txt_category">
                          <span class="label_error error_category"></span>
                      </div>
                      <div class="mb-3">
                          <label>Description</label>
                          <textarea placeholder="Enter your description" cols="52" class="textarea-x" rows="4" name="category_description" id="txt_desc"></textarea>
                          <span class="label_error error_category_description "></span>
                      </div>
                      <button type="submit" class="btn btn-dark mt-4 mb-3 float-end" id="btn-save">Save</button>

                  </form>
              </div>

          </div>
      </div>
  </div>