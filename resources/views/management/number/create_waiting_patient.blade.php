<div class="modal fade " id="create-waiting-patient" tabindex="-1"  role="dialog" aria-labelledby="create-waiting-patient" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_create_waiting_patient"></h5>
            </div>
            <form action="{{ route('number.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label>Số thứ tự</label>
                            <input type="hidden" name="room_id" id="room_id_tbl_number" value="">
                            <input class="multisteps-form__input form-control" type="text" placeholder="" name="number" id="patient_number">
                            <input type="hidden" name="role" value="benh-nhan" id="role">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label>CCCD/CMND</label>
                            <input class="multisteps-form__input form-control" id="patient_identification_code" type="text" placeholder="" name="patient_identification_code">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <label>Họ</label>
                            <input class="multisteps-form__input form-control" id="last_name_patient" type="text" placeholder="Nguyễn Văn" name="last_name">

                        </div>
                        <div class="col-12 col-sm-6">
                            <label>Tên</label>
                            <input class="multisteps-form__input form-control" id="first_name_patient" type="text" placeholder="A" name="first_name">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <label>Giới tính</label>
                            <select class="form-control" name="gender" id="choices-gender-patient" >
                                <option value="">Chọn giới tính ...</option>
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label>Ngày sinh</label>
                            <input class="multisteps-form__input form-control" type="date" placeholder="" name="dob" id="dob_patient">

                        </div>
                    </div>
                    <div class="row mt-3">


                        <div class="col-12 col-sm-6">
                            <label>Email</label>
                            <input class="multisteps-form__input form-control" type="email" placeholder="" name="email" id="email_patient">

                        </div>

                        <div class="col-12 col-sm-6">
                            <label>Số điện thoại</label>
                            <input class="multisteps-form__input form-control" type="text" placeholder="" name="phone_number_patient" id="phone_number_patient">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-success" id="patient_medical_record_update">Thêm thông tin</button>
                </div>
            </form>
        </div>
    </div>
</div>

