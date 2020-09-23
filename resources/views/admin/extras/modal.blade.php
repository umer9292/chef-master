<!-- Add Category Modal -->
<div class="modal fade category-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" method="POST" accept-charset="utf-8">
                    @csrf
                    <div class="form-group">
                        <label for="name">name: </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Company Modal -->
<div class="modal fade company-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="companyForm" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="form-group">
                        <label for="name">Company Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>
