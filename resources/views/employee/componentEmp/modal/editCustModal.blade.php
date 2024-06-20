<div class="modal fade" id="editCustModal_{{$customer->customer_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" role="form" action="{{ route('editCust', ['customer_id' => $customer]) }}">
                @csrf
                <div class="modal-header green-bg">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white">Chỉnh sửa thông tin khách hàng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="usernameInput"><i class="fa-solid fa-signature"></i></i> Họ và tên:</label>
                        <input type="text" class="form-control" placeholder="" name="fullName" value="{{ $customer->fullname }}"/>
                        @if ($errors->has('fullName'))
                            <span class="error-message">* {{ $errors->first('fullName') }}</span>
                        @endif
                    </div>
    
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="dateInput"><i class="fa-solid fa-calendar-days"></i> Ngày sinh:</label>
                                <input type="date" class="form-control" placeholder="" name="date" value="{{ $customer->date_of_birth }}"/>
                                @if ($errors->has('date'))
                                    <span class="error-message">* {{ $errors->first('date') }}</span>
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="genderInput"><i class="fa-solid fa-venus-mars"></i> Giới tính:</label>
                                <input type="text" class="form-control" placeholder="" name="gender" value="{{ $customer->gender }}"/>
                                @if ($errors->has('gender'))
                                    <span class="error-message">* {{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="phoneInput"><i class="fa-solid fa-phone"></i> Số điện thoại:</label>
                                <input type="text" class="form-control" placeholder="" name="phone" value="{{ $customer->phone }}"/>
                                @if ($errors->has('phone'))
                                    <span class="error-message">* {{ $errors->first('phone') }}</span>
                                @endif
                            </div>
    
                            <div class="col-6">
                                <label for="nationalIdInput"><i class="fa-solid fa-id-card"></i> Số CCCD:</label>
                                <input type="text" class="form-control" placeholder="" name="nationalId" value="{{ $customer->national_id }}"/>
                                @if ($errors->has('nationalId'))
                                    <span class="error-message">* {{ $errors->first('nationalId') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group mb-3">
                        <label for="emailInput"><i class="fa-solid fa-envelope"></i> Email:</label>
                        <input type="text" class="form-control" placeholder="Nhập email" name="email" value="{{ $customer->email }}"/>
                        @if ($errors->has('email'))
                            <span class="error-message">* {{ $errors->first('email') }}</span>
                        @endif
                    </div>
    
                    <div class="form-group mb-3">
                        <label for="addressInput"><i class="fa-solid fa-location-dot"></i> Địa chỉ:</label>
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Xã/Phường" name="ward" value="{{ $customer->ward }}"/>
                                @if ($errors->has('ward'))
                                    <span class="error-message">* {{ $errors->first('ward') }}</span>
                                @endif
                            </div>  

                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Quận/Huyện" name="district" value="{{ $customer->district }}"/>
                                @if ($errors->has('district'))
                                    <span class="error-message">* {{ $errors->first('district') }}</span>
                                @endif
                            </div>  

                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="Tỉnh/Thành phố" name="province" value="{{ $customer->province }}"/>
                                @if ($errors->has('province'))
                                    <span class="error-message">* {{ $errors->first('province') }}</span>
                                @endif
                            </div>                    
                        </div>
                    </div>
    
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="passwordInput"><i class="fa-solid fa-lock"></i> Mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password1"/>
                                @if ($errors->has('password1'))
                                    <span class="error-message">* {{ $errors->first('password1') }}</span>
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <label for="passwordInput"><i class="fa-solid fa-lock"></i> Mật lại khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="password2"/>
                                @if ($errors->has('password2'))
                                    <span class="error-message">* {{ $errors->first('password2') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>