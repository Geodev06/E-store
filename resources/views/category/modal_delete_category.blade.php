<!-- Modal -->
<div class="modal fade" id="modal_delete_category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Delete Category</h1>
                <span data-bs-dismiss="modal" aria-label="Close"><span class="mdi mdi-window-close" style="cursor: pointer;"></span></span>
            </div>
            <div class="modal-body">
                <h3 id="lbl_category"></h3>
                <p>Are you sure you want to delete this category?</p>
                <form role="form" id="delete_category_form" data-id="">
                    @csrf
                    <input type="hidden" id="delete_id" value="">
                    <button type="button" class="btn btn-danger mt-4 mb-3 float-end" id="btn-delete-category" data-id="">Delete</button>
                    <button type="button" class="btn btn-secondary mt-4 mb-3 me-2 float-end" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
