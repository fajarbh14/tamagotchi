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

        function populateErrorMessage(errors) {
            var ObjToArray = Object.entries(errors);
            ObjToArray.forEach((value) => {
                var input = $(`[name='${value[0]}']`);
                var feedback = `<div class='invalid-feedback'>${value[1][0]}</div>`;


                if (input.length > 1) {
                    $(`[data-input='${value[0]}']`).append(
                        `<p class='d-block invalid-feedback text-danger' style='margin-top: 0.25rem; font-size: 0.875em'>${value[1][0]}</p>`
                        );
                } else {
                    input.addClass("is-invalid");
                    input.after(feedback);
                }
            });
        }

        $(document).on("input", ".numeric", function () {
            this.value = this.value.replace(/\D/g, '');
        });

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
                loop: true,
                margin: 10,
                nav: true,
                center: true,
                autoWidth: true,
                autoplay: true,
                dots: false,
                items: 4,
                navText: ['', ''],
                breackpoint: []
            })
        }

        jQuery(window).on('load', function () {
            setTimeout(function () {
                ItemsCarousel();
            }, 1000);
        });

        function handleTabs() {
            $('#add-order-content,#place-order').css("display", "none");
            $('#add-order').on('click', function () {
                $('#add-order-content').css("display", "block");
                $('#home-counter').css("display", "none");
            })
            $('#place-order-tab').on('click', function () {
                $('#place-order').css("display", "block");
                $('#add-order-content').css("display", "none");
            })
            $('#place-order-cancel').on('click', function () {
                $('#place-order').css("display", "none");
                $('#add-order-content').css("display", "block");
            })
            $('#home-counter-tab').on('click', function () {
                $('#home-counter').css("display", "block");
                $('#add-order-content').css("display", "none");
            })
        }
        handleTabs();

    </script>

</body>

</html>
