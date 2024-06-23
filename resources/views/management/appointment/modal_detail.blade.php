<div class="modal fade " id="modal-detail-appointment" role="dialog" aria-labelledby="modal-detail-appointment"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"
        style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_assignment_detail">Lịch hẹn chi tiết</h5>

            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row mx-3">
                            <ul class="list-unstyled mx-auto">
                                <li class="d-flex">
                                    <p class="mb-0">Họ và tên:</p>
                                    <span class="ms-auto" id="name"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Giới tính:</p>
                                    <span class="ms-auto" id="gender"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Ngày sinh:</p>
                                    <span class="ms-auto" id="dob"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Email:</p>
                                    <span class="ms-auto" id="email"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Số điện thoại:</p>
                                    <span class="ms-auto" id="phone_number"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">CMND/CCCD:</p>
                                    <span class="ms-auto" id="patient_identification_code"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Bác sĩ khám:</p>
                                    <span class="ms-auto" id="doctor_uuid"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Trạng thái lịch hẹn:</p>
                                    <span class="ms-auto" id="status"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Ngày khám:</p>
                                    <span class="ms-auto" id="date"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Ca khám:</p>
                                    <span class="ms-auto" id="shift_id"></span>
                                </li>
                                <li>
                                    <hr class="horizontal dark">
                                </li>
                                <li class="d-flex">
                                    <p class="mb-0">Ghi chú lịch hẹn:</p>
                                    <span class="ms-auto" id="note"></span>
                                </li>

                                <li>
                                    <hr class="horizontal dark">
                                </li>

                            </ul>
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
                <input type="hidden" id="number_id" >
                <button type="submit" class="btn bg-gradient-secondary" id="sequence-number" style="display: flex">
                    Lấy số thứ tự
                </button>
                <input type="hidden" id="appointment_id" >
                <button type="submit" class="btn btn-default" id="send_mail" style="display: flex">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/4e/Gmail_Icon.png" alt="Gmail Logo" width="20" height="20" class="mx-2">
                    Gửi Mail
                </button>
            </div>
        </div>
    </div>
</div>
