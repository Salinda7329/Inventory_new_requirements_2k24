{{-- mekedi api dapu request ake quentity aka vthrak wens krann plwn wenn hadann --}}


<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalrequest">
    Edit request
</button>

<!-- Modal -->
<div class="modal fade" id="modalrequest" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalrequest">Modal title</h5>
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
                        <input type="text" id="quentity" class="form-control" placeholder="" />
                    </div>
                    <div class="col mb-0">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input"
                                disabled />
                        </div>

                    </div>
                    <label for="comment" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment" rows="3" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">request</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
