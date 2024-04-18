
<div class="modal fade update_prescription_detail"  id="update_prescription_detail{{$prescription_detail->id}}" tabindex="-1" role="dialog" aria-labelledby="update_prescription_detail{{$prescription_detail->id}}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md mt-8" role="document"style="align-items: center !important;flex-direction: column !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $prescription_detail->medicine->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form text-left" action="">
                <div class="modal-body">
                    <div class="row" id="div_prescription_update_infor{{ $prescription_detail->id}}">
                        <div class="col-12 col-lg-12" id="">
                            <div class="row " id="">
                                <div class="col-12 col-sm-12">
                                    <input type="hidden" value="{{ $prescription_detail->id}}" name="id" id="prescription_detail_id">
                                    <label for="">Số lượng</label>
                                    <input class="multisteps-form__input form-control" type="text" id="quantity" placeholder="Nhập số lượng" name="quantity"
                                    value="{{ $prescription_detail->quantity ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <label class="">Thông tin chi tiết</label>
                                    <p class="form-text text-muted text-xs ms-1 d-inline">
                                    (optional)
                                    </p>
                                    <div id="edit-deschiption{{ $prescription_detail->id}}" class="h-50">
                                        <p><strong>{!! html_entity_decode( $prescription_detail->note) ?? 'Vui lòng điền rõ liều lượng thuốc sử dụng' !!} </strong> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="update_prescription{{ $prescription_detail->id}}" class="btn bg-gradient-primary update_prescription" >Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>



