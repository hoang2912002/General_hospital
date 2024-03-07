@push('css')
    <link id="pagestyle" href="{{ asset('asset/admin') }}/css/argon-dashboard.min.css?v=2.0.5" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>
@endpush



@push('js')

    <script src="{{ asset('asset/admin') }}/js/plugins/multistep-form.js"></script>
    <script src="{{ asset('asset/admin') }}/js/plugins/choices.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        if (document.getElementById('choices-gender')) {
          var gender = document.getElementById('choices-gender');
          const example = new Choices(gender);

        }
        if (document.getElementById('choices-role')) {
          var role = document.getElementById('choices-role');
          const example = new Choices(role);

        }
        if (document.getElementById('choices-group')) {
          var role = document.getElementById('choices-group');
          const example = new Choices(role);

        }
        if (document.getElementById('choices-manufacturer')) {
          var role = document.getElementById('choices-manufacturer');
          const example = new Choices(role);

        }
        if (document.getElementById('choices-type')) {
          var role = document.getElementById('choices-type');
          const example = new Choices(role);

        }
        if (document.getElementById('choices-user')) {
          var user = document.getElementById('choices-user');
          const example = new Choices(user);

        }
        if (document.getElementById('choices-doctor')) {
          var doctor = document.getElementById('choices-doctor');
          const example = new Choices(doctor);

        }
        if (document.getElementById('shift')) {
          var shift = document.getElementById('shift');
          const example = new Choices(shift);

        }
        if (document.getElementById('choices-medicine')) {
          var skills = document.getElementById('choices-medicine');
          const example = new Choices(skills, {
            delimiter: ',',
            editItems: true,
            maxItemCount: 10,
            removeItemButton: true,
            addItems: true
          });
        }
        if (document.getElementById('choices-shift-medicine')) {
          var skills = document.getElementById('choices-shift-medicine');
          const example = new Choices(skills, {
            delimiter: ',',
            editItems: true,
            maxItemCount: 10,
            removeItemButton: true,
            addItems: true
          });
        }
        function visible() {
            var elem = document.getElementById('profileVisibility');
            if (elem) {
                if (elem.innerHTML == "Activated") {
                elem.innerHTML = "UnActivated"
                } else {
                elem.innerHTML = "Activated"
                }
            }
        }
        //Format VNĐ price
        $('input[name^="price"]').on('input', function(e){
            $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
        }).on('keypress',function(e){
                if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
        }).on('paste', function(e){
                var cb = e.originalEvent.clipboardData || window.clipboardData;
                if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
        });
        function formatCurrency(number){
            var n = number.split('').reverse().join("");
            var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
            return  n2.split('').reverse().join('') + 'VNĐ';
        }

    </script>
    <script>

    </script>
@endpush


