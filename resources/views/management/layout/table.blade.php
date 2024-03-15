@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/datatables/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset/admin') }}/css/datatables/buttons.bootstrap4.min.css">
    <style>
        .table td, .table th {
            padding: 12px 30px 12px 24px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            font-size: 14px;

        }
        .page-item.active .page-link {
            color: white !important;

        }

    </style>
@endpush

@push('js')
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/datatables.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="{{ asset('asset/admin') }}/js/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/jszip.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/pdfmake.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/vfs_fonts.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/buttons.html5.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/buttons.print.min.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/datatables/buttons.colVis.min.js"></script> --}}
    <script src="{{ asset('asset/admin') }}/js/plugins/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>

        function renderTable(url, columns, totalprice) {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "orderable": false,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                "processing": true,
                "serverSide": true,
                //"bDestroy": true,

                ajax: url,
                columns: columns,
                // "order": [
                //     [1, 'desc']
                // ],
                // "columnDefs": [
                //     {"className": "dt-center", "targets": "_all"}
                // ],
                language: {
                    'paginate': {
                    'previous': '<span class="far prev-icon"><i class="fas fa-solid fa-angle-left"></i></span>',
                    'next': '<span class="far next-icon"><i class="fas fa-solid fa-angle-right"></i></span>'
                    }
                },
                footerCallback: function (row, data, start, end, display) {
                    if(totalprice === 1){
                        var api = this.api();
                        var total = 0;
                        var arr = [];
                        data.forEach(element => {
                            total += parseInt($(element.price).attr('id'))
                            return total
                        });
                        // Update footer
                        $(api.column(5).footer()).html( new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(total));
                    }
                },

            });
        }
    </script>

    <script>
        function deleteItem(url){
            console.log(url);
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    console.log(value);
                    $.ajax({
                        type: "delete",
                        url: url,
                        success: function (response) {
                            if(response == 1){
                                toastr.success('Deleted successfully!');
                                $('#dataTable').DataTable().clear().draw(true);
                            }
                            else{
                                toastr.error('Can not deleted');
                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush

