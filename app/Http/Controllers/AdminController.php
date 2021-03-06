<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiTruyen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class AdminController extends Controller{
    public function __construct(){
        
    }

    public function dashboard(){
        $users = UserController::count();
        $truyen = TruyenController::count();
        $theloai = TheLoaiTruyenController::count();
        $days = Carbon::today();

        $truyen_binhthuong = TruyenController::Count_BinhThuong();
        $truyen_bikhoa = TruyenController::Count_BiKhoa();
        $truyen_bixoa = TruyenController::Count_BiXoa();
        $truyen_hoanthanh = TruyenController::Count_HoanThanh();
        $truyen_dangcapnhat = TruyenController::Count_DangCapNhat();
        $truyen_ngung = TruyenController::Count_Ngung();

        $user_thanhvien = UserController::count_ThanhVien();
        $user_chapsu = UserController::count_ChapSu();
        $user_quantri = UserController::count_QuanTri();

        $day7 = date('Y-m-d', strtotime($days));
        $day6 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day5 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day4 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day3 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day2 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day1 = date('Y-m-d', strtotime($days->addDays(-1)));

        $val_day7 = ThongKeController::get($day7);
        $val_day6 = ThongKeController::get($day6);
        $val_day5 = ThongKeController::get($day5);
        $val_day4 = ThongKeController::get($day4);
        $val_day3 = ThongKeController::get($day3);
        $val_day2 = ThongKeController::get($day2);
        $val_day1 = ThongKeController::get($day1);

        $lienhe = LienHeController::get(5);
        $phanhoi = PhanHoiController::get(5);

        return view('admin.index', compact(
            'users',
            'truyen',
            'theloai',
            'day7',
            'day6',
            'day5',
            'day4',
            'day3',
            'day2',
            'day1',
            'val_day7',
            'val_day6',
            'val_day5',
            'val_day4',
            'val_day3',
            'val_day2',
            'val_day1',
            'truyen_binhthuong',
            'truyen_bikhoa',
            'truyen_bixoa',
            'truyen_hoanthanh',
            'truyen_dangcapnhat',
            'truyen_ngung',
            'user_thanhvien',
            'user_chapsu',
            'user_quantri',
            'lienhe',
            'phanhoi',
        ));
    }

    //H??? s?? c?? nh??n
    public function Account_Profile(){
        $tusach = TruyenController::getTruyenTuSach(5);
        $truyen_dadang = TruyenController::getTruyenDaDang_DESC(5);

        return view('admin.account.overview', compact(
            'tusach',
            'truyen_dadang'
        ));
    }

    public function Account_Setting(){
        return view('admin.account.profile_setting_profile');
    }

    //Chi ti???t t??i kho???n
    public function Account_Setting_Detail(){
        return view('admin.account.profile_setting_account');
    }

    public function UpdateDetailAccount(Request $request){
        UserController::updateDetailAccount_Admin($request);
        return redirect()->route('admin.account.setting.detail');
    }

    public function getHoatDong_Account(){
        $record = UserRecordController::show(25);

        return view('admin.account.profile_diary', compact('record'));
    }

    public function getBinhLuan_Account(){
        $comment = TruyenBinhLuanController::getCommentByUser(25);

        return view('admin.account.profile_comment', compact('comment'));
    }

    public function Account_Setting_Notify(){
        return view('admin.account.profile_setting_notify');
    }

    public function Account_Setting_Billing(){
        return view('admin.account.profile_setting_billing');
    }

    public function ChangeDisplayNameAndStatus(Request $request){
        $user = User::find(Auth::user()->id);
        $user->display_name = $request->display_name;
        $user->status = $request->status;
        $user->save();
        if(!empty($request->display_name)){
            ghiLog('?????i t??n hi???n th??? t??? ['.$request->oldName.'] th??nh ['.$request->display_name.']');
        }
        if(!empty($request->status)){
            ghiLog('Thay ?????i tr???ng th??i');
        }
        return redirect()->route('admin.account.setting');
    }

    //H??? th???ng c???nh gi???i
    public function CanhGioi(){
        return view('admin.canh_gioi');
    }

    //Th??? lo???i truy???n
    public function TheLoaiTruyen(){
        $theloai_truyen = TheLoaiTruyenController::showAll();

        return view('admin.the_loai_truyen', compact('theloai_truyen'));
    }

    public function ajaxXoaTheLoaiTruyen(Request $request){
        TheLoaiTruyenController::delete($request);
    }

    public function TheLoaiTruyen_Add(Request $request){
        if(TheLoaiTruyenController::add($request)){
            ghiLog('Th??m th??? lo???i ['.$request->name.']');
            Toastr::success("Th??m th??? lo???i th??nh c??ng!");
            return redirect()->route('admin.type_story');
        }
        else{
            Toastr::error('Th??? lo???i ['.$request->name.'] ???? t???n t???i');
            return redirect()->route('admin.type_story');
        }
    }

    public function TheLoaiTruyen_Edit(Request $request){
        if(TheLoaiTruyenController::edit($request)){
            ghiLog('S???a th??? lo???i ['.$request->oldName.'] th??nh ['.$request->name.']');
            return redirect()->route('admin.type_story');
        }
        else{
            return redirect()->route('admin.type_story')->with('message', 'Th??? lo???i ['.$request->name.'] ???? t???n t???i');
        }
    }

    //Ch??nh s??ch
    public function getChinhSach(){
        $chinhsach = ThietLapWebController::getChinhSach();

        return view('admin.chinhsach', compact('chinhsach'));
    }

    public function postChinhSach(Request $request){
        ThietLapWebController::saveChinhSach($request);

        return redirect()->route('admin.policy');
    }

    //??i???u kho???n
    public function getDieuKhoan(){
        $dieukhoan = ThietLapWebController::getDieuKhoan();

        return view('admin.dieukhoan', compact('dieukhoan'));
    }

    public function postDieuKhoan(Request $request){
        ThietLapWebController::saveDieuKhoan($request);

        return redirect()->route('admin.rules');
    }

    //H?????ng d???n
    public function getHuongDan(){
        $huongdan = ThietLapWebController::getHuongDan();
        return view('admin.huongdan', compact('huongdan'));
    }

    public function postHuongDan(Request $request){
        ThietLapWebController::saveHuongDan($request);
        return redirect()->route('admin.instruct');
    }

    //Th??nh vi??n
    public function getThanhVien(){
        $thanhvien = UserController::getAll();
        return view('admin.thanhvien', compact('thanhvien'));
    }

    public function postUpdateRole(Request $request){
        UserController::updateRole($request);
        Toastr::success("C???p nh???t th??nh c??ng!");
        return redirect()->route('admin.users');
    }

    public function postKhoaTaiKhoan(Request $request){
        UserController::LockAccount($request);
        Toastr::success("C???p nh???t th??nh c??ng!");
        return redirect()->route('admin.users');
    }

    //Danh s??ch truy???n
    public function getDanhSachTruyen(){
        $truyen = TruyenController::getAll();
        return view('admin.truyen', compact('truyen'));
    }

    public function postUpdateLockTruyen(Request $request){
        TruyenController::updateLock($request);
        return redirect()->route('admin.stories');
    }

    public function ajaxDeleteTruyen(Request $request){
        TruyenController::delete($request);
    }

    //Ph???n h???i
    public function getPhanHoi(){
        $phanhoi = PhanHoiController::getAll();
        return view('admin.phanhoi', compact('phanhoi'));
    }

    //Li??n h???
    public function getLienHe(){
        $lienhe = LienHeController::getAll();
        return view('admin.lienhe', compact('lienhe'));
    }

    //C???u h??nh h??? th???ng
    public function getCauHinhHeThong(){
        $config = ConfigSystemController::getConfigSystem();
        return view('admin.cauhinh_hethong', compact('config'));
    }

    //C???p nh???t tr???ng th??i b???o tr??
    public function ajaxBaoTri(){
        ConfigSystemController::updateMaintenance();
    }

    //Craw data
    public function ajaxCrawData(){
        ConfigSystemController::updateCrawData();
    }

    //Google login
    public function ajaxGoogleLogin(){
        ConfigSystemController::updateGoogleLogin();
    }

    //Facebook login
    public function ajaxFacebookLogin(){
        ConfigSystemController::updateFacebookLogin();
    }
}
