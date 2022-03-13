@extends('layouts.member')
@section('title', 'Sửa Chương')
@section('mycss')
<link rel="stylesheet" href="{{ asset('public/assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/tributejs/tribute.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/at.js/css/jquery.atwho.min.css') }}">
@endsection
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('member.dashboard.my_story.list_chapter', ['name_slug'=>$truyen->name_slug]) }}">
                            <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Danh Sách Chương
                        </a>
                    </li>
                </ol>
            </nav>
            <h1 class="page-title" style="text-transform: uppercase;">SỬA CHƯƠNG ({{ $truyen->name }})</h1>
        </header>
        <div class="page-section">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('member.post_edit_chapter') }}">
                        @csrf
                        <input type="text" name="id" value="{{ $chuong->id }}" hidden>
                        <input type="text" name="truyen_id" value="{{ $truyen->id }}" hidden>
                        <input type="text" name="truyen_name_slug" value="{{ $truyen->name_slug }}" hidden>
                        <fieldset>
                            <div class="form-group">
                                <label for="numchap" style="width: 100%;">Số Chương
                                    <abbr title="Required">(*)</abbr>
                                    <div class="float-right">
                                        <a href="{{ $prev_chuong }}" class="btn btn-primary {{ $prev_chuong }}"><i class="fas fa-chevron-left"></i></a>
                                        <a href="{{ $next_chuong }}" class="btn btn-primary {{ $next_chuong }}"><i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </label>
                                <div class="custom-number">
                                    <input type="number" class="form-control" id="numchap" name="numchap" min="1" step="1" value="{{ $chuong->numchap }}" placeholder="Số chương..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ten_chuong">Tên Chương <abbr title="Required">(*)</abbr></label>
                                <input type="text" class="form-control" maxlength="{{ tbl_fields['chuong']['name'] }}" id="ten_chuong" name="name" value="{{ $chuong->name }}" placeholder="VD: Ta Cười Người Nhìn Không Thấu" autocomplete="off" autofocus required>
                                <small class="form-text text-muted">Tên chương không nên quá dài, tối đa {{ tbl_fields['chuong']['name'] }} ký tự.</small>
                            </div>
                            <div class="form-group">
                                <label for="tf6">Nội Dung</label>
                                <textarea class="form-control ckeditor" id="content" name="content">{{ $chuong->content }}</textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="submit" value="save_and_edit" class="btn btn-warning mr-2"><i class="fas fa-save"></i> Lưu Và Sửa</button>
                                <button type="submit" name="submit" value="save_and_exit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu Và Thoát</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('public/assets/vendor/handlebars/handlebars.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/tributejs/tribute.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/jquery.caret/jquery.caret.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/at.js/js/jquery.atwho.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/zxcvbn/zxcvbn.js') }}"></script>
<script src="{{ asset('public/assets/vendor/vanilla-text-mask/vanillaTextMask.js') }}"></script>
<script src="{{ asset('public/assets/vendor/text-mask-addons/textMaskAddons.js') }}"></script>
<script src="{{ asset('public/assets/javascript/theme.min.js') }}"></script>
<script src="{{ asset('public/assets/javascript/pages/select2-demo.js') }}"></script>
<script src="{{ asset('public/assets/javascript/pages/typeahead-demo.js') }}"></script>
<script src="{{ asset('public/assets/javascript/pages/atwho-demo.js') }}"></script>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
@endsection