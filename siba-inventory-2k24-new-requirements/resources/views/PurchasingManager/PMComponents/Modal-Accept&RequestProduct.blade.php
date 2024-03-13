<!-- Button to trigger the modal -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalacceptRequest">
    Accept
</button>

<!-- Modal -->
<div class="modal fade" id="modalacceptRequest" tabindex="-1" aria-labelledby="modalacceptRequest" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust the modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalacceptRequestt">Accept New product Requet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left side of the modal -->
                    <div class="col-md-6">
                        <!-- Input field on the left side -->
                        <div class="mb-3">
                            <label class="form-label" for="productname">Product Name</label>
                            <input type="text" class="form-control" id="po-number" placeholder="" />
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="quentity">Enter quentity</label>
                            <input type="text" class="form-control" id="quentity" placeholder="" />
                        </div>

                        <!-- Dropdown menu on the left side -->
                        <div class="mb-3">
                            <label class="form-label" for="catagory">Catagory</label>
                            <select class="form-select" id="catagory" aria-label="catagory">
                                <option selected>Select an option</option>
                                <option value="electronic">Electronic</option>
                                <option value="stationary">Stationary</option>
                                <option value="cleaning">Cleaning</option>
                            </select>
                        </div>
                    </div>

                    <!-- Right side of the modal -->
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">request</button>
            </div>
        </div>
    </div>
</div>
