<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-scheme="navy">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <title>Login </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts [ OPTIONAL ] -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.css') }}">

    <!-- Nifty CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/nifty.css') }}"">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



</head>

<body class="">

    <!-- PAGE CONTAINER -->
    <div id="root" class="root front-container">

        <!-- CONTENTS -->
        <section id="content" class="content">
            <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="content__wrap">

                    <!-- Login card -->
                    <div class="card shadow-none" style="min-width: 400px; width: 100%; max-width: 500px;">
                        <div class="card-body p-5">

                            <div class="text-center">
                                <h1 class="h3">Account Login</h1>
                                <p>Sign In to your account</p>
                            </div>

                            <form class="mt-4" id="formLogin">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Username" autofocus
                                        name="username" id="username">
                                </div>

                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        id="password">
                                </div>

                                <div class="d-grid mt-5">
                                    <button type="submit" type="submit" id="submitBtn"
                                        class="btn btn-primary rounded-pill">
                                        <span class="spinner-border spinner-border-sm mx-1 d-none" role="status"
                                            aria-hidden="true"></span>
                                        <span class="button-text">Login</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- END : Login card -->

                </div>
            </div>

        </section>
        <!-- END - CONTENTS -->
    </div>
    <!-- END - PAGE CONTAINER -->

    <script>
        var audio = new Audio('{{ asset('audio/notification.ogg') }}');

        $(document).ready(function() {
            function refreshCsrfToken(callback) {
                $.get('{{ route('refresh.csrf') }}', function(data) {
                    $('meta[name="csrf-token"]').attr('content', data.token);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': data.token
                        }
                    });
                    if (typeof callback === 'function') callback();
                });
            }

            $('#formLogin').on('submit', function(e) {
                e.preventDefault();

                let form = this;

                refreshCsrfToken(function() {
                    let url = '{{ route('admin.loginPost') }}';
                    let formData = new FormData(form);

                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    let submitBtn = $('#submitBtn');
                    let spinner = submitBtn.find('.spinner-border');
                    let btnText = submitBtn.find('.button-text');

                    spinner.removeClass('d-none');
                    btnText.text('Masuk...');
                    submitBtn.prop('disabled', true);

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            window.location.href = res.redirect;
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                audio.play();
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, val) {
                                    let input = $('#' + key);
                                    input.addClass('is-invalid');
                                    input.after(
                                        '<span class="invalid-feedback" role="alert"><strong>' +
                                        val[0] + '</strong></span>'
                                    );
                                });

                                spinner.addClass('d-none');
                                btnText.text('Login');
                                submitBtn.prop('disabled', false);
                            }
                            else{

                                spinner.addClass('d-none');
                                btnText.text('Login');
                                submitBtn.prop('disabled', false);

                            }
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
