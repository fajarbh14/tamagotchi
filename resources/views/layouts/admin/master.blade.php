<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    @includeIf('layouts.admin.partials.css')
</head>

<body>
    <!-- <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> -->
    @includeIf('layouts.admin.partials.header')
    @includeIf('layouts.admin.partials.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
	<div class="modal booking-detail-box" tabindex="-1" data-form-modal>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" data-modal-title></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" data-modal-body></div>
        </div>
      </div>
    </div>
    @includeIf('layouts.admin.partials.js')
    <script>
        var formModal;

        document.querySelector("[data-form-modal]").addEventListener("hidden.bs.modal", function () {
            document.querySelector("[data-modal-title]").innerText = "";
            document.querySelector("[data-modal-body]").innerHTML = "";
        });

        $(document).on("submit", "form", function () {
            $(".form-control").removeClass("is-invalid");
            $(".invalid-feedback").remove();
        });
        
        
        $(document).on("input", ".numeric", function () {
            this.value = this.value.replace(/\D/g, '');
        });

        $(document).on("input", ".comma", function() {
            this.value = addCommas(this.value)
        });

        document.querySelectorAll("[type='file']").forEach(function(input) {
            input.addEventListener("change", function(e) {
                var file    = e.target.files[0];
                var img     = e.target.previousElementSibling;

                if (file) {
                    img.src = URL.createObjectURL(file);
                } else {
                    img.src = "";
                }
            })
        })

        function openForm(url, type = "create") {
            
            var title = {
                create: "Tambah Data",
                edit: "Edit Data",
                detail: "Detail Data",
            };

            var modalTitle = title[type] ? title[type] : "";

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $("[data-modal-title]").text(modalTitle);
                    $("[data-modal-body]").html(response);
                    formModal = new bootstrap.Modal(document.querySelector("[data-form-modal]"), {});
                    formModal.show();
                },
                error: function (reject) {
                    toastAlert("error", "Terjadi kesalahan pada server");
                    console.log(reject)
                }
            })
        }

        function deleteAlert(url) {
            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                text: "Kamu tidak bisa mengembalikan data ini lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (!result.isConfirmed) return;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (response) {
                        if (response.status_code == 500) return toastAlert("error", response
                            .message);

                        toastAlert("success", response.message);
                        dt.ajax.reload();
                    },
                    error: function (reject) {
                        toastAlert("error", "Terjadi kesalahan pada server");
                    }
                })
            })
        }

        function logout() {
            $.ajax({
                url: "{{ url('logout') }}",
                type: "GET",
                beforeSend: function () {
                    toastAlert("info", "Mencoba logout");
                },
                success: function () {
                    window.location.replace("{{ url('login') }}");
                },
                error: function (reject) {
                    console.log(reject);
                }
            })
        }

        function ItemsCarousel() {
            jQuery('.item-carousel').owlCarousel({
                loop: false,
                margin: 10,
                nav: true,
                left: true,
                autoWidth: false,
                autoplay: false,
                dots: false,
                items: 3,
                navText: ['', ''],
                breackpoint: []
            })
        }

        jQuery(window).on('load', function () {
            setTimeout(function () {
                ItemsCarousel();
            }, 1000);
        });


    </script>

</body>

</html>
