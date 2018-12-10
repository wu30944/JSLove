<?php
namespace App\Services;

use App\Repositories\NewsRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use stdClass;

class NewsService
{
    protected $NewsRepository;

    /**
     * RulesService constructor.
     * @param NewsRepository $NewsRepository
     */
    public function __construct(NewsRepository $NewsRepository)
    {

        $this->NewsRepository = $NewsRepository;
    }

    /**
     * 資料建立
     * @param array $Params
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function Create(array $Params)
    {
        return $this->NewsRepository->Create($Params);
    }

    /**
     * 根據ID取得該筆資料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->NewsRepository->ById($id);
    }

    public function GetByCondition(StdClass $request,array $columns){

        return $this->NewsRepository->GetByCondition($request,$columns);

    }

    public function Update($Ｍodel,$Request){

        $Datas = $Request->all();

        $Ｍodel->update($Datas);

    }

    public function Destroy($Model){
        $Model->delete();
    }

    public function UpdatePhoto($model,$PhotoUrl){

        $model->update($PhotoUrl);
    }



    public function RefleshView(){

        $Request = new StdClass;
        $Request->title = '';
        $Request->status = '';
        $Request->show_date = '';
        $Request->id='';

        $Columns = array('id','title','action_date','show_date','status','content');

        $News = $this->NewsRepository->GetByCondition($Request,$Columns);

//        $Return=["News"=>$News];

        return $News;
    }

    public function GetEditContent(stdClass $Param,array $Columns){

        $MenuContent = $this->NewsRepository->GetByCondition($Param,$Columns)->get();

        $Columns = array('menu_name');
        $Param->id="";
        $MenuTitle = $this->NewsRepository->GetByCondition($Param,$Columns)->groupBy('menu_name')->get();

        $Return=["MenuContent"=>$MenuContent,"Title"=>$MenuTitle];

        return $Return;
    }

    public function GetCreateContent(stdClass $Param,array $Columns){


        $MenuTitle = $this->NewsRepository->GetByCondition($Param,$Columns)->groupBy('menu_name')->get();

        $Return=["Title"=>$MenuTitle];

        return $Return;
    }

    public function GetFilesUrl($Model){
        return $Model->GetFiles();
    }

    public function WebShow(){

        $Request = new StdClass;
        $Request->title = '';
        $Request->status = '1';
        $Request->show_date =date("Y-m-d");
        $Request->action_date = '';
        $Request->id='';

        $Columns = array('id','title','action_date','action_time','action_position','content');

        $News = $this->NewsRepository->GetByCondition($Request,$Columns);

        return $News;
    }


}