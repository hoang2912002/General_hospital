<div class="modal fade " id="modal-waiting-patient"  role="dialog" aria-labelledby="modal-waiting-patient" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-waiting-patient-room-name"></h5>
                <input type="hidden" id="room_id">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 col-lg-12">

                        <div class="col-12 col-lg-12">
                            <div class="row mx-3">
                                <table class="table" id="waiting-patient-table">
                                    <thead>
                                        <tr>
                                            <th>Số thứ tự</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-12 col-sm-12 d-flex" style="justify-content: space-around;">
                    <ul class="pagination custom-pagination"></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-success" id="create_waiting_patient">Thêm số thứ tự</button>
            </div>
        </div>
    </div>
</div>
