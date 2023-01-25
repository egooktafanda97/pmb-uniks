<!-- Modal -->
<div aria-hidden="true"
     class="modal fade"
     id="filter"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">FILTER</h5>
                <button aria-label="Close"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        type="button"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select aria-label="Default select example"
                            class="form-select">
                        <option selected="">Seluruh Data</option>
                        <option class="text-warning"
                                value="1">Pending</option>
                        <option class="text-success"
                                value="2">Valid</option>
                        <option class="text-danger"
                                value="3">Invalid</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Pendaftaran</label>
                    <select aria-label="Default select example"
                            class="form-select">
                        <option selected="">Seluruh Data</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Tahun Ajaran</label>
                    <select aria-label="Default select example"
                            class="form-select">
                        <option selected="">Seluruh Data</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="">Program Studi</label>
                    <select aria-label="Default select example"
                            class="form-select">
                        <option selected="">Seluruh Data</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        type="button">Close</button>
                <button class="btn btn-primary"
                        type="button">Save changes</button>
            </div>
        </div>
    </div>
</div>
