<!-- Modal -->
<div class="modal fade" id="modal_delete_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Delete Product</h1>
                <span data-bs-dismiss="modal" aria-label="Close"><span class="mdi mdi-window-close" style="cursor: pointer;"></span></span>
            </div>
            <div class="modal-body">
                <h3 id="lbl_product"></h3>
                <p>Are you sure you want to delete this product?</p>
                <form role="form" id="delete_product_form" data-id="">
                    @csrf
                    <input type="hidden" id="delete_id" value="">
                    <button type="button" class="btn btn-danger mt-4 mb-3 float-end" id="btn-delete-product" data-id="">Delete</button>
                    <button type="button" class="btn btn-secondary mt-4 mb-3 me-2 float-end" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
