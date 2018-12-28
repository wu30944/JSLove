<?php
namespace App\Services;

use App\Repositories\GalleryRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use stdClass;

class GalleryService
{
    protected $GalleryRepository;

    /**
     * RulesService constructor.
     * @param GalleryRepository $GalleryRepository
     */
    public function __construct(GalleryRepository $GalleryRepository)
    {

        $this->GalleryRepository = $GalleryRepository;
    }

    /**
     * 資料建立
     * @param array $Params
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function Create(array $Params)
    {
        return $this->GalleryRepository->Create($Params);
    }

    /**
     * 根據ID取得該筆資料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->GalleryRepository->ById($id);
    }

    public function GetByCondition(StdClass $request,array $columns){

        return $this->GalleryRepository->GetByCondition($request,$columns);

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

        $Columns = array('id','title','is_show','show_date','content');

        $Gallery = $this->GalleryRepository->GetByCondition($Request,$Columns);

        return $Gallery;
    }


    public function WebShow(){

        $Request = new StdClass;
        $Request->title = '';
        $Request->is_show = '1';
        $Request->show_date = date("Y-m-d");
        $Request->id='';

        $Columns = array('id','title','content');

        $Gallery = $this->GalleryRepository->GetByCondition($Request,$Columns)->first();

        return $Gallery;
    }

    public function GetKeyWord($title){

        $Request = new StdClass;
        $Request->title = $title;
        $Request->is_show = '';
        $Request->show_date ='';
        $Request->id='';

        $Columns = array('title');

        $Gallery = $this->GalleryRepository->GetKeyWord($Request,$Columns);

        $results = array();
        foreach($Gallery->get() as $index => $item){
            $results[] = ['value' => $item->title];
        }
        return $results;
    }


}