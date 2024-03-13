<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <h5 class="card-header">Not Returned Items</h5>
                <div class="card-body">
                    <div class="row">
                        <!-- Left side -->
                        <div class="col-md-6">

<br><br>
                            <label class="form-check-label" for="inlineCheckbox1">Sort by Date</label>
                            <br><br>
                            <div class="mb-3 row">
                                <label for="html5-date-input" class="col-md-2 col-form-label">Start Date</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="html5-month-input" class="col-md-2 col-form-label">End Date</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="month" value="2021-06" id="html5-month-input" />
                                </div>
                            </div>
                        </div>




                        <!-- Right side -->
                        <div class="col-md-6">
                        </div>
                    </div>
                    <br><br>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                          <thead>
                            <tr class="text-nowrap">
                              <th>NO</th>
                              <th>Requested Date</th>
                              <th>Epf/No</th>
                              <th>Item Name</th>
                              <th>Item code</th>
                              <th>Requested by</th>
                              <th>Department</th>
                              <th>  </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>Table cell</td>
                              <td>Table cell</td>
                              <td>Table cell</td>
                              <td>Table cell</td>
                              <td>Table cell</td>
                              <td>Table cell</td>
                              <td>
                                @include('storeManager.SMcomponent.cancel-button-modal-request-table')
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="/edit-customer-details">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delet</a>
                              </div></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
