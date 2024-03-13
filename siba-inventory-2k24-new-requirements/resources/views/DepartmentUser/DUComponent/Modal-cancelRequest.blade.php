{{-- meka request aka cancel krann hadann  --}}


<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalcancel">
    Cancel
</button>

<!-- Modal -->
<div class="modal fade" id="modalcancel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalcancel">Cancel Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="itemname" class="form-label">Item Name</label>
                    <input class="form-control" type="text" id="itemname" placeholder="" readonly />
                </div>
                <div class="mb-3">
                    <label for="itemid" class="form-label">Item ID</label>
                    <input class="form-control" type="text" id="itemid" placeholder="" readonly />
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="quentity" class="form-label">Quentity</label>
                        <input type="text" id="quentity" class="form-control" placeholder="" disabled/>
                    </div>
                    <div class="col mb-0">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input"
                                disabled />
                        </div>

                    </div>
                    <div>
                        <label for="coment" class="form-label">Comment</label>
                        <textarea class="form-control" id="coment" rows="3"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-danger">cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
