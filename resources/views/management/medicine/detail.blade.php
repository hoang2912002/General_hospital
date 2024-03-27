@extends('management.layout.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Thông tin chi tiết thuốc</h5>
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 text-center">
                            <img class="w-100 border-radius-lg shadow-lg mx-auto"
                                src="https://www.averroespharma.com.my/assets/images/product_image/615d67eb89de1.jpg"
                                alt="chair">
                            <div class="my-gallery d-flex mt-4 pt-2" itemscope=""
                                itemtype="http://schema.org/ImageGallery" data-pswp-uid="1">
                                <figure class="ms-2 me-3" itemprop="associatedMedia" itemscope=""
                                    itemtype="http://schema.org/ImageObject">
                                    <a href="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-thumb-1.jpg"
                                        itemprop="contentUrl" data-size="500x600">
                                        <img class="w-100 min-height-100 max-height-100 border-radius-lg shadow"
                                            src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-thumb-1.jpg"
                                            alt="Image description">
                                    </a>
                                </figure>
                            </div>


                        </div>
                        <div class="col-lg-5 mx-auto">
                            <h3 class="mt-lg-0 mt-4">{{ $medicineModel->name }}</h3>
                            <div class="rating">
                                <h4>Số lượng: {{ $medicineModel->quantity }}</h4>
                            </div>
                            <br>
                            <h6 class="mb-0 mt-3">Giá</h6>
                            <h5>{{ $medicineModel->price() }}</h5>

                            {!! html_entity_decode($medicineModel->status_detail()) !!}
                            <br>
                            <label class="mt-4">Thông tin chi tiết</label>
                            <ul>
                                <li>
                                    {!! html_entity_decode( $medicineModel->description) !!}
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script></script>
@endpush
