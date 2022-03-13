@extends('layouts.home')
@section('title', 'Truyện Mới Cập Nhật | Tàng Kinh Các')
@section('content')
<div class="my-card card shadow-sm">
    <h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
        <i class="far fa-stopwatch"></i> TRUYỆN MỚI CẬP NHẬT
        <!-- <a class="float-right bgg-trang" href="#"><i class="fad fa-arrow-alt-circle-right"></i></a> -->
    </h5>
    <div class="card-body py-0 pb-3 my-pad">
        <div class="row">
            <!-- nội dung truyện hot -->
            @foreach($truyen as $val)
            <div class="col-md-2 col-6 my-2 test">
                <div class="my-card card bg-dark">
                    <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                        <div class="card-body py-0 px-0 position-relative">
                            <img src="{{ getStoryCover($val->cover) }}" class="img-fluid my-thumb">
                            <span class="the-chuong position-absolute">{{ $val->num_chaps }} chương</span>
                        </div>
                        <div class="card-footer py-1 font-roman title-truyen-home">{{ $val->name }}</div>
                    </a>
                </div>
            </div>
            @endforeach
            <!-- end nội dung truyện hot -->
        </div>
    </div>
    <div class="card-footer my-pagination mb-0 pb-0">
        {{ $truyen->links() }}
    </div>
</div>
<div class="container-fluid px-0 mt-3 banner-benduoi an-banner">
    <a href="#">
        <img class="img-fluid" src="{{ asset('public/images/banner3.jpg') }}" style="height: 61px; width: 100%;">
    </a>
</div>
<div class="phan-cach"></div>

@endsection