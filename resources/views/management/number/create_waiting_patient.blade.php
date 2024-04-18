<div class="modal fade " id="create-waiting-patient"  role="dialog" aria-labelledby="create-waiting-patient" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-waiting-patient-room-name"></h5>
                <input type="hidden" id="create_waiting_patient_room_id">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="{{ route('number.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                            <div class="col-12 col-sm-3  mt-3 mt-sm-0">
                                <label>Số thứ tự</label>
                            </div>
                            <div class="col-12 col-sm-9  mt-3 mt-sm-0">
                                <input id="number" class="form-control" type="number" placeholder="+40 735 631 620" name="phone_number" value="{{ old('phone_number') ?? '' }}">
                                <input id="status" class="form-control" type="hidden" placeholder="+40 735 631 620" name="status" value="{{ old('status') ?? '' }}">

                            </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-success" id="create_waiting_patient">Thêm số thứ tự</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

