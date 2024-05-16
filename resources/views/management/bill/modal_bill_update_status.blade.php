<div class="modal fade" id="bill_update_status" tabindex="-1" role="dialog" aria-labelledby="bill_update_status"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mt-8" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Phiếu cập nhật tình trạng hóa đơn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" action="{{ route('bill.update_status',$billModel) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label>Giới tính</label>
                    <select class="form-control" name="status" id="bill-status" >
                        <option value="">Chọn trạng thái hóa đơn ...</option>
                        <option value="0">Chưa thanh toán</option>
                        <option value="1">Đã thanh toán</option>
                    </select>
                    <button type="submit" class="btn bg-gradient-primary">Lưu</button>
                  </form>
            </div>

        </div>
    </div>
</div>
