<?php

namespace App\Http\Controllers\Admin;

use App\Services\PaginationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use App\Services\GalleryService;
use DB;
use Auth;

class GalleryController extends Controller
{
    private $GalleryService;
    protected $PaginationService;

    public function __construct(GalleryService $GalleryService,PaginationService $PaginationService)
    {
        $this->GalleryService = $GalleryService;
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
        $GalleryContent=$this->GalleryService->RefleshView();

        $Data = $this->PaginationService->page(1,$GalleryContent,'5','1');


        return view('admin.gallery.index')->with("data",$Data);
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

            $Model = $this->GalleryService->Create($request->all());

            DB::connection()->getPdo()->commit();

            $Content = $this->GalleryService->RefleshView();
            $Data=$this->PaginationService->page($request->page,$Content,'5','1');
            $html = view('admin.gallery.query')->with('data',$Data)->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        //
        $id = $request->id;
        $GalleryContent = $this->GalleryService->ById($id);
        return response()->json($GalleryContent,200);

    }


    public function update(Request $request)
    {

        $Model = $this->GalleryService->ById($request->id);

        $this->GalleryService->Update($Model,$request);

        $CarouselContent = $this->GalleryService->RefleshView();

        $Data=$this->PaginationService->page($request->page,$CarouselContent,'5','1');

        $html = view('admin.gallery.query')->with("data",$Data)->render();

        return response ()->json ( compact('html'),200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        try{
            DB::connection()->getPdo()->beginTransaction();

            $Model = $this->GalleryService->ById($request->id);

            $this->GalleryService->Destroy($Model);

            DB::connection()->getPdo()->commit();

            $CarouselContent = $this->GalleryService->RefleshView();

            $data=$this->PaginationService->page($request->page,$CarouselContent,'5','1');

            $html = view('admin.gallery.query')->with("data",$data)->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }

    }


    public function paginate(Request $request){

        $CarouselContent = $this->GalleryService->RefleshView();

        $Data = $this->PaginationService->page($request->page,$CarouselContent,'5','1');

        $html = view('admin.gallery.query')->with("data",$Data)->render();

        return response ()->json ( compact('html'),200);
    }

    public function keyword(Request $request){


        $KeyWord = $this->GalleryService->GetKeyWord($request->term);
        return response ()->json ($KeyWord);

    }

    public function search(Request $request){

        $Search = new StdClass;
        $Search->title = $request->title;
        $Search->is_show = '';
        $Search->show_date = '';
        $Search->id='';

        $Columns = array('id','title','is_show','show_date','content');

        $Gallery = $this->GalleryService->GetByCondition($Search,$Columns);

        $Data = $this->PaginationService->page($request->page,$Gallery,'5','1');

        $html = view('admin.gallery.query')->with("data",$Data)->render();

        return response ()->json ( compact('html'),200);
    }
}
