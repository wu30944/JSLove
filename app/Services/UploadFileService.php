<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/11/1
 * Time: 9:54 PM
 */

namespace App\Services;
use Storage;
use Imagecow\Image;
use Response;
use StdClass;
use URL;
use Validator;

use App\Repositories\AlbumDRepository;
use Auth;

class UploadFileService
{
    private $Files=[];
    private $AlbumPath;
    private $AlbumName;
    private $FullAlbumPath;
    private $EntityStoragePath;
    private $VirtualStoragePath;

    public function __construct(){
        $this->EntityStoragePath=$this->getEntitiyStoragePath();
    }

    private function getEntitiyStoragePath(){
        return Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
    }

    public function CreateFolder($FolderName=null){

        $StoragePath = $this->GetAWSStoragePath($FolderName);

        if($FolderName==null)
        {
            Storage::makeDirectory($this->VirtualStoragePath);

        }else{
            Storage::makeDirectory('public/'.config('app.files').'/'.$FolderName);
        }

    }

    public function UploadFiles($request,$FolderName){

        $HasFiles = $this->CheckFiles($request->file("fileupload"));
        $data=[];

        $Prefix = date("YmdHis");
        $FileCount = 1;

        if($HasFiles) {
            /*
             *  取得存在AWS的位置
             * */
            $StoragePath = $this->GetAWSStoragePath($FolderName);

            foreach($this->Files as $file) {

//                $FileName = $file->getClientOriginalName();
                $FileName = $Prefix.$FileCount.".jpg";

                /*
                 * 2017/12/22   使用Laravel內建儲存檔案的方法
                 *              此處會將檔案存到指定路徑下(storage下)，
                 *              第一個參數是完整資料夾
                 *              第二個參數是圖片檔案
                 * */

                $uploadFlag = Storage::put(
                    $StoragePath . '/' . $FileName,
                    file_get_contents($file->getRealPath())
                );

                $UploadState = new StdClass;
                $UploadState->FileName = $FileName;
                $UploadState->Flag = $uploadFlag;
                $UploadState->Url = str_replace(" ","",$this->GetFileUrl('files',$FolderName,$FileName));
                //\Debugbar::info($UploadState->Url);

                $data[]=$UploadState;

                $FileCount++;
            }
        }
        //\Debugbar::info($data);
        return $data;
    }

    private function CheckFiles($Files){

        $rules = array('fileupload'  => 'image');
        if(empty($Files)){
            return false;
        }else{
            foreach($Files as $item){

                $data = array('image' => $item);
                // Validation
                $validation = Validator::make($data, $rules);

                if ($validation->fails())
                {
                    return false;
                    throw new Exception($validation->messages()->all()); // 丟出一個測試用的例外
                }
            }
        }
        $this->Files=$Files;
        return true;


    }


    private function GetAWSStoragePath($Folder){
        return 'public/files/'.$Folder;
    }

    /**
     * 取得檔案的URL
     *
     */
    private function GetFileUrl($Type,$Folder,$FileName){

        return urldecode(URL::to(Storage::url('public/'.$Type.'/'.$Folder.'/'.$FileName)));

    }

    public function DeleteDirectory(){

        Storage::deleteDirectory($this->VirtualStoragePath);

    }

    public function DeleteFiles($Type,$Folder,$FileName){
       return  Storage::delete("public/".$Type."/".$Folder."/".$FileName);
    }

    public function CkeditorUploadImage($File,$FileName,$FolderName){

        $data=[];
        /*
         *  取得存在AWS的位置
         * */
        $StoragePath = $this->GetAWSStoragePath($FolderName);


        /*
         * 2017/12/22   使用Laravel內建儲存檔案的方法
         *              此處會將檔案存到指定路徑下(storage下)，
         *              第一個參數是完整資料夾
         *              第二個參數是圖片檔案
         * */

        $uploadFlag = Storage::put(
            $StoragePath . '/' . $FileName,
            file_get_contents($File)
        );

        $UploadState = new StdClass;
        $UploadState->FileName = $FileName;
        $UploadState->Flag = $uploadFlag;
        $UploadState->Url = str_replace(" ","",$this->GetFileUrl('files',$FolderName,$FileName));

        return $UploadState;
    }


    public function UploadPhoto($request,$FolderName){

        $HasFiles = $this->CheckFiles($request->file("fileupload"));
        $data=[];
        $Prefix = date("YmdHis");
        $Id = $request->album_id;

        $Path = 'album/'.$FolderName;

        if($HasFiles) {
            /*
             *  取得存在AWS的位置
             * */
            $StoragePath = $this->GetAWSStoragePath($Path);

            foreach($this->Files as $index=> $file) {

                $FileName = $Prefix.'_'.$index.".jpg";

                /*
                 * 2017/12/22   使用Laravel內建儲存檔案的方法
                 *              此處會將檔案存到指定路徑下(storage下)，
                 *              第一個參數是完整資料夾
                 *              第二個參數是圖片檔案
                 * */
                $uploadFlag = Storage::put(
                    $StoragePath . '/' . $FileName,
                    file_get_contents($file->getRealPath())
                );

                $photo_path = str_replace(" ","",$this->GetFileUrl('files',$Path,$FileName));

                $UploadState = new StdClass;
                $UploadState->photo_name = $FileName;
                $UploadState->flag = $uploadFlag;
                $UploadState->album_id = $Id;
                $UploadState->photo_path = $photo_path;
                $UploadState->url = $photo_path;
                $UploadState->thumbnailUrl = $photo_path;
                $UploadState->deleteUrl = $photo_path;
                $UploadState->delete_method = 'GET';
                $UploadState->size = filesize($file->getRealPath());
                $UploadState->error = null;
                $data[]=$UploadState;

//                $FileCount++;
            }
        }
        return $data;
    }

    public function DeleteFile($DeleteFileList){

        foreach($DeleteFileList as $index => $item)
        {

            Storage::delete($item);
        }

    }
}