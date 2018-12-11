<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadFileService;
use Aws\Multipart\UploadState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CarouselService;


class UploadController extends Controller
{
    protected $UploadService;

    public function __construct()
    {
        $this->UploadService = new UploadFileService();
    }

    
    public function UploadFiles(Request $request)
    {

//        return response ()->json ( "",200);
        // 檔案的name預設是upload (我不知道去哪改耶XD 有人知道嗎?)
        $FileNameLong = $_FILES['upload']['name'];
        $File = $_FILES['upload']['tmp_name'];

        $Data = $this->UploadService->CkeditorUploadImage($File,$FileNameLong,"news");

        //\Debugbar::info($Data->Url);
        //
        //  作了一些對圖片的處理後
        //
//        $pathToSave = '/Users/andywu/Documents/Code/joyslove/storage/app/public/myimage.jpg';
//        move_uploaded_file($File,  $pathToSave);

        // 再做一些處理後
        // 如果上傳成功就是沒有錯誤訊息
        $errorMsg = '';
        // 這邊記得回傳給ckeditor
        echo "<script>";
        if($errorMsg==''){
            // CKEditor 的編號
            $CKEditorFuncNum = isset($_GET['CKEditorFuncNum']) ? $_GET['CKEditorFuncNum'] : 2;
            // $fileUrl是圖片網址 就自己先處理好吧
            $fileUrl = $Data->Url;
            echo "window.parent.CKEDITOR.tools.callFunction(". $CKEditorFuncNum .",'" . $fileUrl . "','');";
        } else {
            echo "alert('".$errorMsg."');";
        }
        echo "</script>";


    }

}
