
<!-- Your existing modal -->
<div class="modal fade" id="processModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalissueTitle">Process Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createProductsForm" class="mb-3" method="POST" action="#">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="process" id="process1" value="option1">
                        <label class="form-check-label" for="process1">
                            Process Request
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="process" id="process2" value="option2">
                        <label class="form-check-label" for="process2">
                            Release Request
                        </label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" id="createNewProduct" class="btn btn-primary">Submit
                        </button>
                    </div>
                    @csrf
                </form>
            </div>

        </div>
    </div>
</div>
