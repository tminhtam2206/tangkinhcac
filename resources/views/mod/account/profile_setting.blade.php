@extends('mod.account.index')
@section('profile_content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('mod.tai_khoan') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Tổng Quan</a>
                    </li>
                </ol>
            </nav>
        </header>
        <div class="page-section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-fluid">
                        <h6 class="card-header" style="text-transform: uppercase;">Chi Tiết Tài Khoản</h6>
                        <nav class="nav nav-tabs flex-column border-0">
                            <a href="{{ route('mod.tai_khoan.thiet_lap') }}" class="nav-link {{ ActiveLink('chap-su/tai-khoan/thiet-lap', 'active') }}">Hồ Sơ</a>
                            <a href="{{ route('mod.tai_khoan.thiet_lap.chi_tiet') }}" class="nav-link {{ ActiveLink('chap-su/tai-khoan/thiet-lap/tai-khoan', 'active') }}">Tài Khoản</a>
                            <a href="{{ route('mod.tai_khoan.thiet_lap.thanh_toan') }}" class="nav-link {{ ActiveLink('chap-su/tai-khoan/thiet-lap/thanh-toan', 'active') }}">Thanh Toán</a>
                            <a href="{{ route('mod.tai_khoan.thiet_lap.thong_bao') }}" class="nav-link {{ ActiveLink('chap-su/tai-khoan/thiet-lap/thong-bao', 'active') }}">Thông Báo</a>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-8">
                    @yield('content_setting_profile')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection