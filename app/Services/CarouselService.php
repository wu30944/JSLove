<?php
namespace App\Services;

use App\Repositories\CarouselRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use stdClass;

class CarouselService
{
    protected $CarouselRepository;

    /**
     * RulesService constructor.
     * @param CarouselRepository $CarouselRepository
     */
    public function __construct(CarouselRepository $CarouselRepository)
    {

        $this->CarouselRepository = $CarouselRepository;
    }

    /**
     * 資料建立
     * @param array $Params
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function Create(array $Params)
    {
        return $this->CarouselRepository->Create($Params);
    }

    /**
     * 根據ID取得該筆資料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->CarouselRepository->ById($id);
    }

    public function GetByCondition(StdClass $request,array $columns){

        return $this->CarouselRepository->GetByCondition($request,$columns);

    }

    public function Update($Model,$Request){

        $Datas = $Request->all();

        $Model->update($Datas);

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
        $Request->is_show = '';
        $Request->show_date = '';
        $Request->id='';

        $Columns = array('id','title','is_show'
        ,'show_date','photo_url');

        $Carousel = $this->CarouselRepository->GetByCondition($Request,$Columns);

//        $Return=["Carousel"=>$Carousel];

        return $Carousel;
    }

    public function GetEditContent(stdClass $Param,array $Columns){

        $MenuContent = $this->CarouselRepository->GetByCondition($Param,$Columns)->get();

        $Columns = array('menu_name');
        $Param->id="";
        $MenuTitle = $this->CarouselRepository->GetByCondition($Param,$Columns)->groupBy('menu_name')->get();

        $Return=["MenuContent"=>$MenuContent,"Title"=>$MenuTitle];

        return $Return;
    }

    public function GetCreateContent(stdClass $Param,array $Columns){


        $MenuTitle = $this->CarouselRepository->GetByCondition($Param,$Columns)->groupBy('menu_name')->get();

        $Return=["Title"=>$MenuTitle];

        return $Return;
    }


    public function WebShow(){

        $Request = new StdClass;
        $Request->title = '';
        $Request->is_show = '1';
        $Request->show_date = date("Y-m-d");;
        $Request->id='';

        $Columns = array('id','title','description','button_title','photo_url','button_url');

        $Carousel = $this->CarouselRepository->GetByCondition($Request,$Columns);

//        $Return=["Carousel"=>$Carousel];

        return $Carousel;
    }

}