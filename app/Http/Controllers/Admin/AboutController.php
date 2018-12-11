<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PaginationService;
use App\Repositories\AboutRepository;
use App\Services\AboutService;
use DB;

class AboutController extends Controller
{
    private $PaginationService;
    private $AboutRepository;
    private $AboutService;
    
    public function __construct(AboutRepository $AboutRepository,AboutService $AboutService)
    {
        $this->PaginationService = new PaginationService();
        $this->AboutRepository = $AboutRepository;
        $this->AboutService =  $AboutService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $dtAbout = $this->AboutRepository->getAll();
        $Columns = array('id','zh_company_name','en_company_name'
                        ,'address','fex','telephone'
                        ,'email','zh_introduction','en_introduction'
                        ,'uniform_number','status');

        $QueryResult = $this->AboutRepository->getAboutByCondition($request,$Columns);
        $data=$this->PaginationService->page(1,$QueryResult,'5','1');

        return view('admin.about.index')->with('data',$data)->with('About',$dtAbout);
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


            $this->AboutRepository->create($request);

            $Columns = array('id','zh_company_name','en_company_name'
                                ,'address','fex','telephone'
                                ,'email','zh_introduction','en_introduction'
                                ,'uniform_number','status');
            $QueryResult = $this->AboutRepository->getAboutByCondition($request,$Columns);

            $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');
//            \Debugbar::info($data);
            $Return = $this->AboutService->getPage($request->page,$data);

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
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $this->AboutService->Create($request->all());

            DB::connection()->getPdo()->commit();

            $Content = $this->AboutService->RefleshView();
            $data=$this->PaginationService->page($request->page,$Content,'5','1');

            $html = view('admin.about.query')->with('data',$data)->render();
            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
//            \Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        //
//        try{

            $dtAbout = $this->AboutRepository->getAboutById($request->id);
//        \Debugbar::info($dtAbout);
            return response ()->json ( ['Data'=>$dtAbout],200);

//        }catch (\PDOException $e)
//        {
//            DB::connection()->getPdo()->rollBack();
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try{

            $about = $this->AboutService->ById($request->id);
//            \Debugbar::info($request->zh_company_name);

            DB::connection()->getPdo()->beginTransaction();
            $about->update($request->all());
            DB::connection()->getPdo()->commit();

//            $Columns = array('id','zh_company_name');
//            $param = ['zh_company_name'=>'','en_company_name'=>''];
//            $QueryResult = $this->AboutRepository->getAboutByCondition($param,$Columns);
//
//            $data=$this->PaginationService->page($request->page,$QueryResult,'5','1');
//            \Debugbar::info($data);
//            $Return = $this->AboutService->getPage($request->page,$data);
//

            return response ()->json ( "",200);

        }catch (\PDOException $e)
        {
//            \Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        //
        //
        try{
            DB::connection()->getPdo()->beginTransaction();

            $Model = $this->AboutService->ById($request->id);
            $this->AboutService->Destroy($Model);

            DB::connection()->getPdo()->commit();

            $AboutContent = $this->AboutService->RefleshView();

            $data=$this->PaginationService->page($request->page,$AboutContent,'5','1');

            $html = view('admin.about.query')->with("data",$data)->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
//            \Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }
    }
}
