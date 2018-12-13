<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadFileService;
use App\Services\PaginationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use App\Services\NewsService;
use DB;
use Auth;

class NewsController extends Controller
{
    private $NewsService;
    protected $PaginationService;

    public function __construct(NewsService $NewsService,PaginationService $PaginationService)
    {
        $this->NewsService = $NewsService;
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
        $Request->status = '';
        $Request->show_date = '';
        $Request->id='';

        $Columns = array('id','title','action_date','show_date','status','content');

        $NewsContent = $this->NewsService->GetByCondition($Request,$Columns);

        $data = $this->PaginationService->page(1,$NewsContent,'5','1');

        return view('admin.news.index')->with("data",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

            $Model = $this->NewsService->create($request->all());

            DB::connection()->getPdo()->commit();

            $Content = $this->NewsService->RefleshView();
            $data=$this->PaginationService->page($request->page,$Content,'5','1');
            $html = view('admin.news.query')->with('data',$data)->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
            //\Debugbar::info($e->getMessage());
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

        $NewsContent = $this->NewsService->ById($id);

//        $html = view('admin.news.edit')->with("News",$NewsContent)->render();
//
//        return response ()->json ( compact('html'),200);

        //\Debugbar::info($NewsContent->content);
        return response()->json($NewsContent,200);


    }


    public function update(Request $request)
    {

//        $UploadService = new UploadFileService();
//
//        $Data = $UploadService->UploadFiles($request,'news');

        $Model = $this->NewsService->ById($request->id);

//        if(!empty($Data)){
//            $PhotoUrl = array();
//            $Photo = "";
//            foreach($Data as $item){
//                $Photo = $item->Url.$Photo;
//            }
//            $PhotoUrl["photo_url"] = $Photo;
//            $this->NewsService->UpdatePhoto($Model,$PhotoUrl);
//        }

        $this->NewsService->Update($Model,$request);

        $CarouselContent = $this->NewsService->RefleshView();

        $data=$this->PaginationService->page($request->page,$CarouselContent,'5','1');

//        //\Debugbar::info($data);

        $html = view('admin.news.query')->with("data",$data)->render();



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

            $Model = $this->NewsService->ById($request->id);
//            //\Debugbar::info(explode("/carousel/",$request->file_name));
            $PhotoUrlArray = explode("/carousel/",$Model->photo_url);
            $DeleteFlag = true;
            if(count($PhotoUrlArray)>1){
                $UploadService = new UploadFileService();
                $DeleteFlag = $UploadService->DeleteFiles("files","carousel",$PhotoUrlArray[1]);
            }
            //\Debugbar::info($DeleteFlag);
            if($DeleteFlag){
                $this->NewsService->Destroy($Model);
            }

            DB::connection()->getPdo()->commit();

            $CarouselContent = $this->NewsService->RefleshView();

            $data=$this->PaginationService->page($request->page,$CarouselContent,'5','1');

            $html = view('admin.carousel.query')->with("data",$data)->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
            //\Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }

    }


    public function paginate(Request $request){

        $currentPage= $request->page;
        $Request = new StdClass;
        $Request->title = '';
        $Request->status = '';
        $Request->show_date = '';
        $Request->id='';
        $Columns = array('id','title','action_date','show_date','status','content');

        $CarouselContent = $this->NewsService->GetByCondition($Request,$Columns);

        $data=$this->PaginationService->page($currentPage,$CarouselContent,'5','1');

        $html = view('admin.news.query')->with("data",$data)->render();

        return response ()->json ( compact('html'),200);
    }
}
