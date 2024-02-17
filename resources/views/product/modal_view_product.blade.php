<div class="modal fade" id="modal_view_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Product</h1>
                <span data-bs-dismiss="modal" aria-label="Close"><span class="mdi mdi-window-close" style="cursor: pointer;"></span></span>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <h6 class="fw-bold mb-0">Title</h6>
                            <p id="lbl_title">-</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold mb-0">Description</h6>
                            <p id="lbl_description" style="text-align: justify;">-</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold mb-0">Category</h6>
                            <div id="categoryContainer"></div>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold ">Price</h6>
                            <p id="lbl_price">-</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="" alt="" srcset="" id="product-img-preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('#table-product tbody').on('click', '.btn-view', function(e) {
        var id = $(this).data('id');
        let link = "{{ route('product.get',':id') }}"
        getRequest(link.replace(':id', id), function(response) {

            $('#lbl_title').text(response.name)
            $('#lbl_description').text(response.description)

            // console.log(response.categories)
            var badge = ""
            $.each(response.categories, function(index, category) {
                // Create a Bootstrap badge for each category
                badge += "<span class='badge badge-sm border border-info text-info bg-info'>" + category.category + "</span>";
            });
            $('#categoryContainer').html(badge);

            $('#lbl_category').text(response.category_ids)

            $('#lbl_price').text("₱ "+parseFloat(response.price).toFixed(2))
            $('#product-img-preview').attr('src', response.photo);
            $('#modal_view_product').modal('show')


        }, function(xhr, status, error) {
            showToast(error, 2)
        });
    });
</script>