<!-- Button to trigger the modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalupdateproduct">
    Update
</button>

<!-- Modal -->
<div class="modal fade" id="modalupdateproduct" tabindex="-1" aria-labelledby="modalupdateproduct" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust the modal size as needed -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalupdateproduct">Update Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left side of the modal -->
                    <div class="col-md-6">
                        <!-- Input field on the left side -->
                        <div class="mb-3">
                            <label class="form-label" for="po-number">PO Number</label>
                            <input type="text" class="form-control" id="po-number" placeholder="" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="productnamer">Product Name</label>
                            <input type="text" class="form-control" id="productname" placeholder="" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="quentity">quentity</label>
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
                        <!-- Input field on the right side -->
                        <div class="mb-3">
                            <label for="datetime" class="form-lable">Datetime</label>
                                <input class="form-control" type="datetime-local" value="2021-06-18T12:30:00"
                                    id="html5-datetime-local-input" />
                        </div>

                        <!-- Dropdown menu on the right side -->
                        <div class="mb-3 row">
                            <div class="col-md-10">
                                <label for="uploadDocument" class="form-label">Select a document:</label>
                                <input type="file" class="form-control" id="uploadDocument" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-10">
                                <textarea class="form-control" id="comment" placeholder="Enter your comment here"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
