<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadFileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;
use App\Repositories\MenuRepository;
use App\Services\MenuService;
use DB;

class MenuController extends Controller
{
    private $MenuRepository;
    private $MenuService;

    public function __construct(MenuRepository $MenuRepository,MenuService $MenuService)
    {
        $this->MenuRepository = $MenuRepository;
        $this->MenuService = $MenuService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $request = new StdClass;
        $request->menu_name = '';
        $request->prod_name = '';
        $request->status = '1';
        $request->id='';
//        $param = ['id'=>'','menu_name'=>'','prod_name'=>'','status'=>''];

        $columns = array('id','menu_name','prod_name'
        ,'prod_intro','photo','price','status');

        $dtMenu = $this->MenuService->GetByCondition($request,$columns)->get();

        $columns = array('menu_name');
        $request->menu_name='';
        $dtMenuTitle = $this->MenuRepository->GetByCondition($request,$columns)->groupBy('menu_name')->get();
//        ////\Debugbar::info($dtMenu->toArray());
//        //\Debugbar::info($dtMenuTitle->toArray());

        return view('admin.menu.index')->with('Menu',$dtMenu)
                                            ->with('Title',$dtMenuTitle);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $Columns = array('menu_name');
        $param = new StdClass;
        $param->menu_name = '';
        $param->prod_name = '';
        $param->status = '1';
        $param->id = "";

        $CreateMenuContent = $this->MenuService->GetCreateContent($param,$Columns);

//        //\Debugbar::info($EditMenuContent['Title']->count());

        $html = view('admin.menu.create')->with('Title',$CreateMenuContent['Title'])->render();
//        //\Debugbar::info($html);
        return response ()->json ( compact('html'),200);


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

            $this->MenuService->create($request->all());
            //\Debugbar::info($request->all());
            DB::connection()->getPdo()->commit();

            $Content = $this->MenuService->RefleshView();

            $html = view('admin.menu.query')->with('Title',$Content["Title"])->with('Menu',$Content["Menu"])->render();

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
        $columns = array('id','menu_name','prod_name'
        ,'prod_intro','photo','price','status');
        $param = ['id'=>$id,'store_name'=>'','local'=>'','is_hidden'=>'','status'=>''];
        $param = new StdClass;
        $param->menu_name = '';
        $param->prod_name = '';
        $param->status = '1';
        $param->id = $id;
        
        $EditMenuContent = $this->MenuService->GetEditContent($param,$columns);

//        //\Debugbar::info($EditMenuContent['Title']->count());

        $html = view('admin.menu.edit')->with('Title',$EditMenuContent['Title'])->with('Menu',$EditMenuContent['MenuContent']->first())->render();
//        //\Debugbar::info($html);
        return response ()->json ( compact('html'),200);
//        return response ()->json ( $Menu->get()->toArray()[0],200);


    }


    public function update(Request $request)
    {

        $UploadService = new UploadFileService();

        $Data = $UploadService->UploadFiles($request,'menu');

        $Model = $this->MenuService->ById($request->id);

        if(!empty($Data)){
            $PhotoUrl = array();
            $Photo = "";
            foreach($Data as $item){
                $Photo = $item->Url.$Photo;
            }
            $PhotoUrl["photo"] = $Photo;
            $this->MenuService->UpdatePhoto($Model,$PhotoUrl);
        }

        $this->MenuService->Update($Model,$request);
//        flash('修改成功')->success()->important();


        $Content = $this->MenuService->RefleshView();

        //\Debugbar::info($Content['Title']);

        $html = view('admin.menu.query')->with('Title',$Content["Title"])->with('Menu',$Content["Menu"])->render();

        return response ()->json ( compact('html'),200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try{
            DB::connection()->getPdo()->beginTransaction();
            //\Debugbar::info($request->id);

            $Model = $this->MenuService->ById($request->id);
            $this->MenuService->Destroy($Model);

            DB::connection()->getPdo()->commit();

            $Content = $this->MenuService->RefleshView();

            $html = view('admin.menu.query')->with('Title',$Content["Title"])->with('Menu',$Content["Menu"])->render();

            return response ()->json ( compact('html'),200);

        }catch (\PDOException $e)
        {
            //\Debugbar::info($e->getMessage());
            DB::connection()->getPdo()->rollBack();
            return response ()->json ( ['test'=>$e->getMessage()],404);
        }

    }
}
