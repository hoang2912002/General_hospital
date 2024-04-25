<div class="modal fade " id="modal-medical-record" tabindex="-1"  role="dialog" aria-labelledby="modal-medical-record" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bệnh nhân: {{ ($medical_recordModel->user->first_name . ' ' . $medical_recordModel->user->last_name) ?? '' }}</h5>
            </div>
            <form action="{{ route('prescription.update_medical_record',$medical_recordModel) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Chiều cao</label>
                            <input type="hidden" name="medical_record_id" value="{{ $medical_recordModel->id }}">
                            <input class="multisteps-form__input form-control" type="text" placeholder="160cm" name="height" value="{{ $medical_recordModel->height ?? old('height')  }}">

                        </div>
                        <div class="col-12 col-sm-6">
                            <label>Cân nặng</label>
                            <input class="multisteps-form__input form-control" type="text" placeholder="50kg" name="weight" value="{{$medical_recordModel->weight ?? old('weight')  }}">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <label>Tĩnh mạch</label>
                            <input class="multisteps-form__input form-control" type="text" placeholder="100mHg" name="vessel" value="{{ $medical_recordModel->vessel ?? old('vessel')  }}">

                        </div>
                        <div class="col-12 col-sm-6">
                            <label>Huyết áp</label>
                            <input class="multisteps-form__input form-control" type="text" placeholder="100mHg" name="blood_pressure" value="{{$medical_recordModel->blood_pressure ?? old('blood_pressure')  }}">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <label>Nhiệt độ</label>
                            <input class="multisteps-form__input form-control" type="text" placeholder="37*C" name="temperature" value="{{ $medical_recordModel->temperature ?? old('temperature')  }}">

                        </div>
                        <div class="col-12 col-sm-6">
                            <label>Nguyên nhân</label>
                            <input class="multisteps-form__input form-control" type="text" placeholder="" name="reason" value="{{$medical_recordModel->reason ?? old('reason')  }}">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <label>Ca khám</label>
                            <select class="form-control" name="shift_id" id="choices-manufacturer" >
                                <option value="">Chọn giờ khám ...</option>
                                @foreach ($shift as $item)
                                    <option value="{{ $item->id }}" @if ($medical_recordModel->shift_id === $item->id)
                                        @selected(true)
                                    @endif>{{ $item->shift() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Ngày khám</label>
                            <input class="multisteps-form__input form-control" type="date" placeholder="" name="exam_date" value="{{$medical_recordModel->exam_date ?? old('exam_date')  }}">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-12">
                            <label>Bệnh lý</label>
                            <input class="multisteps-form__input form-control" type="text" placeholder="" name="disease" value="{{ $medical_recordModel->disease ?? old('disease')  }}">

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

