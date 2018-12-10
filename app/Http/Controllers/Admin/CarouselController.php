<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadFileService;
use App\Services\PaginationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use App\Services\CarouselService;
use DB;
use Auth;

class CarouselController extends Controller
{
    private $CarouselService;
    protected $PaginationService;

    public function __construct(CarouselService $CarouselService,PaginationService $PaginationService)
    {
        $this->CarouselService = $CarouselService;
        $this->PaginationService = $PaginationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Request = new StdClass;
        $Request->title = '';
        $Request->is_show = '';
        $Request->show_date = '';
        $Request->id='';

        $Columns = array('id','title','is_show'
        ,'show_date','photo_url');

        $CarouselContent = $this->CarouselService->GetByCondition($Request,$Columns);

        $data=$this->PaginationService->page(1,$CarouselContent,'5','1');

        \Debugbar::info($data);

        return view('admin.carousel.index')->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view('admin.carousel.create')->render();
//        \Debugbar::info($html);
        return response ()->json (compact('html'),200);

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
        try{
            DB::connection()->getPdo()->beginTransaction();

            $Model = $this->CarouselService->create($request->all());

            $UploadService = new UploadFileService();

            $Data = $UploadService->UploadFiles($request,'carousel');

            if(!empty($Data)){
                $PhotoUrl = array();
                $Photo = "";
                foreach($Data as $item){
                    $Photo = $item->Url.$Photo;
                }
                $PhotoUrl["photo_url"] = $Photo;
                $this->CarouselService->UpdatePhoto($Model,$PhotoUrl);
            }

            DB::connection()->getPdo()->commit();

            $Content = $this->CarouselService->RefleshView();
            $data=$this->PaginationService->page($request->page,$Content,'5','1');
            $html = view('admin.carousel.query')->with('data',$data)->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
            \Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        //
        $id = $request->id;

        $EditMenuContent = $this->CarouselService->ById($id);

        $html = view('admin.carousel.edit')->with("Carousel",$EditMenuContent)->render();
//        \Debugbar::info($html);
        return response ()->json ( compact('html'),200);
//        return response ()->json ( $Menu->get()->toArray()[0],200);


    }


    public function update(Request $request)
    {

        $UploadService = new UploadFileService();

        $Data = $UploadService->UploadFiles($request,'carousel');

        $Model = $this->CarouselService->ById($request->id);


        if(!empty($Data)){
            $PhotoUrl = array();
            $Photo = "";
            foreach($Data as $item){
                $Photo = $item->Url.$Photo;
            }
            $PhotoUrl["photo_url"] = $Photo;
            $this->CarouselService->UpdatePhoto($Model,$PhotoUrl);
        }

        $this->CarouselService->Update($Model,$request);

        $CarouselContent = $this->CarouselService->RefleshView();

        $data=$this->PaginationService->page($request->page,$CarouselContent,'5','1');

//        \Debugbar::info($data);

        $html = view('admin.carousel.query')->with("data",$data)->render();



        return response ()->json ( compact('html'),200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $Model = $this->CarouselService->ById($request->id);
//            \Debugbar::info(explode("/carousel/",$request->file_name));
            $PhotoUrlArray = explode("/carousel/",$Model->photo_url);
            $DeleteFlag = true;
            if(count($PhotoUrlArray)>1){
                $UploadService = new UploadFileService();
                $DeleteFlag = $UploadService->DeleteFiles("files","carousel",$PhotoUrlArray[1]);
            }
            \Debugbar::info($DeleteFlag);
            if($DeleteFlag){
                $this->CarouselService->Destroy($Model);
            }

            DB::connection()->getPdo()->commit();

            $CarouselContent = $this->CarouselService->RefleshView();

            $data=$this->PaginationService->page($request->page,$CarouselContent,'5','1');

            $html = view('admin.carousel.query')->with("data",$data)->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
            \Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }

    }


    public function paginate(Request $request){

        $currentPage= $request->page;
        $Request = new StdClass;
        $Request->title = '';
        $Request->is_show = '';
        $Request->show_date = '';
        $Request->id='';
        $Columns = array('id','title','is_show','show_date','photo_url');

        $CarouselContent = $this->CarouselService->GetByCondition($Request,$Columns);

        $data=$this->PaginationService->page($currentPage,$CarouselContent,'5','1');

        $html = view('admin.carousel.query')->with("data",$data)->render();

        return response ()->json ( compact('html'),200);
    }
}
