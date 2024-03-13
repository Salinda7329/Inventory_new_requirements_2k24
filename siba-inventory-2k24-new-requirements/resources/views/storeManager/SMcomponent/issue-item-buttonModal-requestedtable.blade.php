<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalissue">
    Issue
</button>

<!-- Your existing modal -->
<div class="modal fade" id="modalissue" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalissueTitle">Issue an Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xxl">
                    <!-- ... (your existing form content) ... -->
                    <div class="row">
                        <!-- Left side -->
                        <div class="col-md-7">
                            <!-- ... (your existing form content) ... -->
                            <div class="col-md-7">
                                <!-- Your first input field -->
                                <div class="mb-3">
                                  <label for="itemcode" class="form-label">Enter Item Code</label>
                                  <input type="text" class="form-control" id="itemcode" placeholder="Item code ..">
                                </div>
                                <!-- Your second input field -->
                                <div class="mb-3">
                                  <label for="quentity" class="form-label">Enter Quantity</label>
                                  <input type="text" class="form-control" id="quentity" placeholder="Enter quantity ..">
                                </div>

                                <!-- Dropdown menu -->
                                <div class="mb-3">
                                  <label for="departmentDropdown" class="form-label">Choose Department</label>
                                  <select class="form-select" id="departmentDropdown">
                                    <option value="it">I.T</option>
                                    <option value="management">Management</option>
                                    <option value="dancing">Dancing</option>
                                    <option value="english">English</option>
                                    <option value="buddhist">Buddhist & Pali</option>
                                  </select>
                                </div>
                                <div class="mb-3    ">
                                    <label for="epf" class="form-label">Enter EPF Number</label>
                                    <input type="text" class="form-control" id="epf" placeholder="Enter EPF number ..">
                                  </div>
                              </div>
                        </div>

                        <!-- Right side -->
                        <div class="col-md-5">
                            <!-- ... (your existing form content) ... -->
                            <div class="col-md-5">
                                <!-- Your third input field -->
                                <div class="mb-3">
                                  <label for="displayquentity1" class="form-label">Display Quantity 1</label>
                                  <input type="text" class="form-control" id="displayquentity1" placeholder="">
                                </div>
                                <!-- Your fourth input field -->
                                <div class="mb-3">
                                  <label for="displayquentity2" class="form-label">Display Quantity 2</label>
                                  <input type="text" class="form-control" id="displayquentity2" placeholder="">
                                </div>

                                <div class="mb-3">
                                  <label for="statusDropdown" class="form-label">Status</label>
                                  <select class="form-select" id="statusDropdown">
                                    <option value="issue">Issue</option>
                                    <option value="return">Return</option>
                                  </select>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="comments" class="form-label">Comments</label>
                    <textarea class="form-control" id="comments" rows="3" placeholder="Add your comments here..."></textarea>
                  </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
