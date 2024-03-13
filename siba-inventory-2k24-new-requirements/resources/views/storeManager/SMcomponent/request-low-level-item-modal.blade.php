<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalrequest">
    Order New
</button>

<!-- Your existing modal -->
<div class="modal fade" id="modalrequest" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalcancelTitle">Request New Item</h5>
                <button type="button" class="btn-accept" data-bs-dismiss="modal" aria-label="accept"></button>
            </div>
            <div class="modal-body">

                <div class="mb-3">

                  <div class="mb-3">
                    <label for="exampleDataList" class="form-label">Enter Product Name</label>
                    <input class="form-control" list="datalistOptions"  id="productlist" placeholder="key board" />
                    <datalist id="datalistOptions">
                      <option value="San Francisco"></option>
                      <option value="New York"></option>
                      <option value="Seattle"></option>
                      <option value="Los Angeles"></option>
                      <option value="Chicago"></option>
                    </datalist>
                  </div>
                  <div>
                    <label for="defaultFormControlInput" class="form-label">Enter Brand</label>
                    <input type="text" class="form-control"  id="defaultFormControlInput" placeholder="Singer , samsung etc.." aria-describedby="defaultFormControlHelp"  />
                  </div>
                  <br>
                  <div>
                    <label for="defaultFormControlInput" class="form-label">Enter Quentity</label>
                    <input type="text" class="form-control"  id="defaultFormControlInput" placeholder="10 ..." aria-describedby="defaultFormControlHelp"  />
                  </div>
                  <br>
                  <div class="mb-3">
                    <label for="comments" class="form-label">Any Special thing ?</label>
                    <textarea class="form-control" id="comments" rows="3" placeholder="Add your requrement here..."></textarea>
                  </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
