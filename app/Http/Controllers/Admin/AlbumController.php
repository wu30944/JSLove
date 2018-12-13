<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\SystemCodeRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\AlbumDRepository;

use DB;
use App\Services\AlbumService;
use Response;
use App\Services\PaginationService;
use StdClass;
use App\Services\UploadFileService;

class AlbumController extends Controller
{

    private $objAlbum;
    private $objAlbumD;
    private $AlbumService;
    private $PaginationService;
    private $SystemCode;
    private $UploadFileService;

    public function __construct(AlbumRepository $AlbumRepository,
                                AlbumDRepository $AlbumDRepository,
                                SystemCodeRepository $SystemCode,
                                AlbumService $AlbumService,
                                UploadFileService $UploadFileService
    )
    {
        $this->objAlbum = $AlbumRepository;
        $this->objAlbumD = $AlbumDRepository;
        $this->AlbumService = $AlbumService;
        $this->PaginationService = new PaginationService();
        $this->SystemCode=$SystemCode;
        $this->UploadFileService = $UploadFileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
//        $dtAlbum = $this->objAlbum->getOrderByPageing(10);
//
//        $Columns = array('id','album_name','status','created_at');
//
//        $QueryResult = $this->objAlbum->getAlbumByCondition($request,$Columns);
//
//        $data=$this->PaginationService->page('',$QueryResult,'5','1');

        $AlbumType=$this->SystemCode->getWhere('album_type','')->pluck('zh_code_val','code_id')->toArray();


        $CarouselContent = $this->AlbumService->RefleshView();

        $data=$this->PaginationService->page(1,$CarouselContent,'5','1');


        return view('admin.album.index')->with('data',$data)->with('AlbumType',$AlbumType);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {

            DB::connection()->getPdo()->beginTransaction();

            $this->AlbumService->CreateAlbum($request->album_name);

            $this->objAlbum->create($request);

            $Columns = array('id','album_name','status','created_at');
            $QueryResult = $this->objAlbum->getAlbumByCondition($request,$Columns);

            $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');
//            \Debugbar::info($data);
            $Return = $this->AlbumService->getPage($request->page,$data);

            DB::connection()->getPdo()->commit();

            return response ()->json ( $Return,200);

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( $e,404);
//            return view('errors.503');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
//            xdebug_var_dump($request);

            DB::connection()->getPdo()->beginTransaction();

            $this->AlbumService->CreateAlbum($request);

            DB::connection()->getPdo()->commit();

            $Content = $this->AlbumService->RefleshView();
            $data=$this->PaginationService->page($request->page,$Content,'5','1');

            $html = view('admin.album.query')->with("data",$data)->render();

            return response ()->json ( $html,200);

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( $e,404);
//            return view('errors.503');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     *
     */
    public function edit(Request $request)
    {
        try{

            $Columns = array('id','album_id','photo_name','photo_path','photo_thumb_path','photo_virtual_path');
            $AlbumContent = $this->AlbumService->GetByCondition($request,$Columns);
            $data = $this->PaginationService->page('1',$AlbumContent,'9','1');
            $AlbumType=$this->SystemCode->getWhere('album_type','')->pluck('zh_code_val','code_id')->toArray();
            $Album = $this->AlbumService->whereIn($request->album_id)->first();

            $html = view('admin.album.partial_edit')->with('Album',$Album)->with("data",$data)->with('AlbumType',$AlbumType)->render();
            return response ()->json ( compact('html'),200);

        }catch(\PDOException $e){
            return view('errors.503');
        }

    }

    public function LoadOriginItem(Request $request){
//        \Debugbar::info($request);
//        $strAlbumId=$this->objAlbum->GetAlbumId($strAlbumName);
//        $strImages=$this->objAlbumD->GetAlbumInfo($strAlbumId);
//        $data=$this->AlbumService->GetAlbumContent($strImages);
        return Response::json(array('files'=>NULL));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function DestroyAlbum(Request $request)
    {
        //
        try {

            DB::connection()->getPdo()->beginTransaction();

            $AlbumName = $this->AlbumService->GetAlbumName($request->album_id);

            $DeletePhotoPath = 'public/files/album/'.$AlbumName.'/';

            $Columns = array('photo_name');
            $Condition = new StdClass();
            $Condition->album_id = [$request->album_id];
            $Condition->id = $request->id;

            $DeletePhotoNameList = $this->AlbumService->GetByCondition($Condition,$Columns)->get();

            $DeleteFileList = [];

            foreach($DeletePhotoNameList as $index => $item){
                $DeleteFileList[$index] = $DeletePhotoPath.$item->photo_name;
            }
            $this->UploadFileService->DeleteFile($DeleteFileList);
            $this->AlbumService->DeleteAlbum($Condition->album_id);

            DB::connection()->getPdo()->commit();

            $AlbumContent = $this->AlbumService->RefleshView();
            $data = $this->PaginationService->page($request->page,$AlbumContent,'5','1');
            $html = view('admin.album.query')->with("data",$data)->render();

            return response ()->json ( compact('html'),200);

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }

    public function DestroyPhoto(Request $request)
    {
        try {

            DB::connection()->getPdo()->beginTransaction();

            //取出要刪除哪一本相簿中的照片
            $AlbumName = $this->AlbumService->GetAlbumName($request->album_id);

            $DeletePhotoPath = 'public/files/album/'.$AlbumName.'/';

            $Columns = array('photo_name');
            $Condition = new StdClass();
            $Condition->album_id = [$request->album_id];
            $Condition->id = $request->id;

            $DeletePhotoNameList = $this->AlbumService->GetByCondition($Condition,$Columns)->get();

            $DeleteFileList = [];

            foreach($DeletePhotoNameList as $index => $item){
                $DeleteFileList[$index] = $DeletePhotoPath.$item->photo_name;
            }

            $this->UploadFileService->DeleteFile($DeleteFileList);
            $this->AlbumService->DeletePhoto($Condition->id);
            DB::connection()->getPdo()->commit();


            $Columns = array('id','album_id','photo_name','photo_path');
            $Condition->id = [''];

            $AlbumContent = $this->AlbumService->GetByCondition($Condition,$Columns);

            $AlbumContentPaging = $this->PaginationService->page('1',$AlbumContent,'9','1');

            $Html = view('admin.album.edit_collapse_two')->with("data",$AlbumContentPaging)->render();

//            \Debugbar::info("刪除完成");

            return Response::json(array('html'=>$Html));

        }catch(\PDOException $e){
            DB::connection()->getPdo()->rollBack();
            return view('errors.503');
        }

    }

    /*
     * 上傳照片會跑來此function
     * 他會先去呼叫上傳照片的Class
     * 要先初始該類別，必須傳入相簿名稱、並且給予要上傳的照片
     * 當照片確認放入實體位置後，類別會回傳照片資訊回來，
     * 最後，再將這些相關資訊存入album_d這個table
     * */
    public function upload(Request $request){
        try{
            // Path for guest upload
//            DB::connection()->getPdo()->beginTransaction();
//            $files=$request;
//            $this->AlbumService->SetAlbumName($request->AlbumName);
//            $this->AlbumService->SetFiles($files);
//            $strAlbumId = $this->objAlbum->GetAlbumId($request->AlbumName);
//            $data=$this->AlbumService->UploadAlbum($strAlbumId);
//            DB::connection()->getPdo()->commit();
//
//            return Response::json(array('files'=>$data));
            $Data = $this->UploadFileService->UploadPhoto($request,$request->AlbumName);

            DB::connection()->getPdo()->beginTransaction();
            if(!empty($Data)){
                foreach($Data as $index => $item){
                    if($item->flag){
                        $InsertData = json_decode( json_encode($item),true);
                        $this->AlbumService->CreateAlbumD($InsertData);
                    }

                }
            }
            DB::connection()->getPdo()->commit();

            $Columns = array('id','album_id','photo_name','photo_path');

            $Condition = new StdClass();
            $Condition->album_id = [$request->album_id];
            $Condition->id = [''];

            $AlbumContent = $this->AlbumService->GetByCondition($Condition,$Columns);
            $AlbumContentPaging = $this->PaginationService->page('1',$AlbumContent,'9','1');

            $Html = view('admin.album.edit_collapse_two')->with("data",$AlbumContentPaging)->render();

            return Response::json(array('files'=>$Data,'html'=>$Html));


        }catch (Exception $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json (['Message'=>$e->getMessage()],403);
        }
    }

    /*
     * 根據使用者點選畫面上的分頁
     * 到後端取得資料在吐回給使用者
     * 使用Ajax方法
     * */
    public function getPage(Request $request){

        $Columns = array('id','album_name','status','created_at');

        $QueryResult = $this->objAlbum->getAlbumByCondition($request,$Columns);

        $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');

        $Return = $this->AlbumService->getPage($request->page,$data);
//        \Debugbar::info($Return);

        return response ()->json ( $Return,200);
    }

    public function getPageD(Request $request){

        $Columns = array('id','album_id','photo_name','photo_path');
        $Condition = new StdClass();
        $Condition->album_id = [$request->album_id];
//        $Condition->album_id = [$request->album_id];
        $Condition->id = [''];
        $AlbumContent = $this->AlbumService->GetByCondition($Condition,$Columns);
        $AlbumContentPaging = $this->PaginationService->page($request->page,$AlbumContent,'9','1');

        $html = view('admin.album.edit_collapse_two')->with("data",$AlbumContentPaging)->render();


        return response ()->json ( compact('html'),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_new()
    {
        $html = view('admin.album.create')->render();
//        \Debugbar::info($html);
        return response ()->json (compact('html'),200);

    }


    public function paginate(Request $request){

        $AlbumContent = $this->AlbumService->RefleshView();

        $data=$this->PaginationService->page($request->page,$AlbumContent,'5','1');

        $html = view('admin.album.query')->with("data",$data)->render();

        return response ()->json ( compact('html'),200);
    }

}
