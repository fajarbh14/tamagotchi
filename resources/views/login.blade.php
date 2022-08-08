@extends('layouts.auth.master')

@push('css')

@endpush

@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Masuk ke akun kamu</h4>
                                <form onsubmit="return false;" data-form>
                                    {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="mb-1">Username</label>
                                            <input type="text" class="form-control" name="username" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1">Password</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-block" type="submit" data-submit-btn>Masuk</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
        $(document).ready(function() {
            $("[data-form]").submit(function(e) {
                $.ajax({
                    url: "{{ url('/login') }}",
                    type: "POST",
                    data: new FormData(this),
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        toastAlert("info", "Mencoba masuk");
                        $("[data-submit-btn]").attr("disabled", true);
                    },
                    success: function(response) {
                        $("[data-submit-btn]").attr("disabled", false);
                        if (response.status_code == 500) return toastAlert("error", response.message);
                        
                        toastAlert("success", response.message);
                        setTimeout(function() {
                            window.location.replace(response.redirect_to);
                        }, 1500);
                    },
                    error: function(reject) {
                        $("[data-submit-btn]").attr("disabled", false);
                        toastAlert("error", "Terjadi kesalahan pada server");
                    }
                })    
            })
        })
</script>
@endpush
@endsection