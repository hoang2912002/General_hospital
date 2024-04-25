<div class="modal fade " id="modal-re-exam-date" tabindex="-1"  role="dialog" aria-labelledby="modal-re-exam-date" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thông tin ngày tái khám</h5>
            </div>
            <form action="{{ route('prescription.update_re_exam_date',$medical_recordModel) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-12 col-sm-12">
                            <label>Ngày tái khám</label>
                            <input class="multisteps-form__input form-control" type="date" placeholder="" name="re_exam_date" value="{{ $medical_recordModel->re_exam_date ?? old('re_exam_date')  }}">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-12">
                            <label for="note" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="note" rows="5" name="note">{{ $medical_recordModel->note ?? old('note') }}</textarea>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-success" id="patient_medical_record_update">Sửa thông tin</button>
                </div>
            </form>
        </div>
    </div>
</div>

