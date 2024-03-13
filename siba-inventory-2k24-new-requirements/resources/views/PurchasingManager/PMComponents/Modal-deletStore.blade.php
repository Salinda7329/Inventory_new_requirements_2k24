
{{-- me delet button aken store ake thiyana product delet krann plwn wenn hadanna. --}}

<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modaldeleteproduct">
    Delete
</button>

<!-- Your existing modal -->
<div class="modal fade" id="modaldeleteproduct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalcancelTitle">Delete Product ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="comments" class="form-label">Comments</label>
                    <textarea class="form-control" id="comments" rows="3" placeholder="Add your comments here..."></textarea>
                  </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete Product</button>
            </div>
        </div>
    </div>
</div>
