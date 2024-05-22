<?php
    define('TITLE', 'Đăng ký');
?>

@include('partials.header')

<main class="container">
    <h4 class="text-center"><hr>Đăng Ký<hr></h4>
    
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form method="post" role="form" action="{{ route('auth.doRegister') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="usernameInput"><i class="fas fa-user"></i> Họ và tên:</label>
                    <input type="text" class="form-control" placeholder="" name="fullName" value="{{ old('fullName') }}"/>
                    @if ($errors->has('fullName'))
                        <span class="error-message">* {{ $errors->first('fullName') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label for="dateInput"><i class="fas fa-user"></i> Ngày sinh:</label>
                            <input type="date" class="form-control" placeholder="" name="date" value=""/>
                            @if ($errors->has('date'))
                                <span class="error-message">* {{ $errors->first('date') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label for="genderInput"><i class="fas fa-user"></i> Giới tính:</label>
                            <input type="text" class="form-control" placeholder="" name="gender" value="{{ old('gender') }}"/>
                            @if ($errors->has('gender'))
                                <span class="error-message">* {{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-6">
                            <label for="phoneInput"><i class="fas fa-user"></i> Số điện thoại:</label>
                            <input type="text" class="form-control" placeholder="" name="phone" value="{{ old('phone') }}"/>
                            @if ($errors->has('phone'))
                                <span class="error-message">* {{ $errors->first('phone') }}</span>
                            @endif
                        </div>

                        <div class="col-6">
                            <label for="nationalIdInput"><i class="fas fa-user"></i> Số CCCD:</label>
                            <input type="text" class="form-control" placeholder="" name="nationalId" value="{{ old('nationalId') }}"/>
                            @if ($errors->has('nationalId'))
                                <span class="error-message">* {{ $errors->first('nationalId') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="emailInput"><i class="fas fa-user"></i> Email:</label>
                    <input type="text" class="form-control" placeholder="Nhập email" name="email" value="{{ old('email') }}"/>
                    @if ($errors->has('email'))
                        <span class="error-message">* {{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="addressInput"><i class="fas fa-user"></i> Địa chỉ:</label>
                    <div class="row">
                        <div class="col-4">
                            <input type="text" class="form-control" placeholder="Tỉnh/Thành phố" name="province" value="{{ old('province') }}"/>
                            @if ($errors->has('province'))
                                <span class="error-message">* {{ $errors->first('province') }}</span>
                            @endif
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" placeholder="Quận/Huyện" name="district" value="{{ old('district') }}"/>
                            @if ($errors->has('district'))
                                <span class="error-message">* {{ $errors->first('district') }}</span>
                            @endif
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" placeholder="Xã/Phường" name="ward" value="{{ old('ward') }}"/>
                            @if ($errors->has('ward'))
                                <span class="error-message">* {{ $errors->first('ward') }}</span>
                            @endif
                        </div>                        
                    </div>

                </div>

                <div class="form-group mb-3">
                    <label for="passwordInput"><i class="fa-solid fa-lock"></i> Mật khẩu:</label>
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="passwordRegister1"/>
                    @if ($errors->has('passwordRegister1'))
                        <span class="error-message">* {{ $errors->first('passwordRegister1') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="passwordInput"><i class="fa-solid fa-lock"></i> Mật lại khẩu:</label>
                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="passwordRegister2"/>
                    @if ($errors->has('passwordRegister2'))
                        <span class="error-message">* {{ $errors->first('passwordRegister2') }}</span>
                    @endif
                </div>

                <hr class="">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-info btn-block">Đăng ký</button>
                </div>
            </form>
        </div>
        <div class="col-6"></div>
    </div>
</main>

@include('partials.footer')