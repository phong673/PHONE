@extends('Layout_user')
@section('title')
    Register
@endsection
@section('content')
    <!-- Main Container -->
    <div class="main-container col1-layout">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <article class="col-main">
                        <div class="account-login">
                            <div class="page-title">
                                <h2>ĐĂNG NHẬP HOẶC ĐĂNG KÍ TÀI KHOẢN</h2>
                            </div>
                            <fieldset class="col2-set">
                                <div class="col-1 new-users"><strong>ĐĂNG NHẬP</strong>
                                    <div class="content">
                                        <p>Tạo tài khoản để có thể tiến hành mua và thanh toán sản phẩm</p>
                                        <div class="buttons-set">
                                            <button onclick="window.location='{{ route('login.index') }}';"
                                                class="button create-account" type="button"><span>Đăng nhập</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 registered-users"><strong>Đăng Kí</strong>
                                    <form action="{{ route('logout.store') }}" method="post">
                                        @csrf
                                        <div class="content">
                                            <p>Nếu bạn chưa có tài khoản hãy đăng kí ở bên dưới.</p>
                                            <ul class="form-list">
                                                <li>
                                                    <label for="email">Họ và tên <span
                                                            class="required">*</span></label>
                                                    <input type="text" title="Email Address"
                                                        class="input-text required-entry" id="name"
                                                        value="{{ old('name_re') }}" name="name_re">
                                                </li>
                                                <li>
                                                    <label for="email">Tên tài khoản <span
                                                            class="required">*</span></label>
                                                    <input type="text" title="Email Address"
                                                        class="input-text required-entry" id="username"
                                                        value="{{ old('username_re') }}" name="username_re">
                                                </li>
                                                <li>
                                                    <label for="email">Email <span
                                                            class="required">*</span></label>
                                                    <input type="text" title="Email Address"
                                                        class="input-text required-entry" id="email"
                                                        value="{{ old('email_re') }}" name="email_re">
                                                </li>
                                                <li>
                                                    <label for="pass">Mật khẩu<span class="required">*</span></label>
                                                    <input type="password" title="Password" id="pass"
                                                        class="input-text required-entry validate-password"
                                                        name="password_re">
                                                </li>
                                            </ul>
                                            <div class="buttons-set">
                                                <button id="send2" name="send" type="submit"
                                                    class="button login"><span>Đăng kí</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </fieldset>
                        </div>
                    </article>
                    <!--	///*///======    End article  ========= //*/// -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main Container End -->
@endsection
@section('js')
<script>
    @if($errors->any())
        @foreach($errors->all() as $err)
            toastr.error('{{$err}}', 'Notification',{timeOut: 7000});
        @endforeach
    @endif
</script>
@endsection
