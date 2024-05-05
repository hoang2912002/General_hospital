<div class="modal fade " id="update_note"  role="dialog" aria-labelledby="update_note" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mt-8" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Phiếu cập nhật dặn dò</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="{{ route('medical_record.update_note',$medical_recordModel) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label>Dặn dò:</label>
                    <div class="input-group mb-3">
                      <textarea class="form-control" name="note" id="" cols="10" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn bg-gradient-primary">Lưu</button>
                  </form>
            </div>

        </div>
    </div>
</div>

