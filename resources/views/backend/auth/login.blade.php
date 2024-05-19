<?php
    define('TITLE', 'Đăng nhập');
?>

@include('partials.header')

<main class="container">
    <h4 class="text-center"><hr>Đăng Nhập<hr></h4>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-5 d-flex justify-content-center">
            <img class="rounded" src="img/login.jpg" alt="">
        </div>
        <div class="col-5 mt-5">
            <form method="post" role="form" action="{{ route('auth.doLogin') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="usernameInput"><i class="fas fa-user"></i> Email:</label>
                    <input type="text" class="form-control" placeholder="Nhập email" name="emailLogin" />
                    @if ($errors->has('emailLogin'))
                        <span class="error-message">* {{ $errors->first('emailLogin') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="passwordInput"><i class="fa-solid fa-lock"></i> Mật khẩu:</label>
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="passwordLogin"/>
                    @if ($errors->has('passwordLogin'))
                        <span class="error-message">* {{ $errors->first('passwordLogin') }}</span>
                    @endif
                </div>

                <div class="form-group form-check col-md-6">
                    <input type="checkbox" class="form-check-input">
                    <label class="form-check-label">Ghi nhớ đăng nhập</label>
                </div>
                <hr class="">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-info btn-block">Đăng nhập</button>
                </div>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
</main>

@include('partials.footer')