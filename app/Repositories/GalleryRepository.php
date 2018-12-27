<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Validator;
use Response;
use Auth;

class GalleryRepository
{
    private $GalleryRepository;

    public function __construct(Gallery $data)
    {
        $this->GalleryRepository = $data;
    }

    public function getAll()
    {
        return $this->GalleryRepository->orderBy('created_at', 'desc')->paginate(5);
    }


    public function Create(array $params){

        return Gallery::create($params);
    }

    public function Destroy($id)
    {
        return $this->GalleryRepository->find($id)->delete();
    }


    public function GetByCondition($Request,$Columns){

        return $this->GalleryRepository->select($Columns)
            ->where(function($SubQuery) use ($Request) {
                $SubQuery->where('id','=',$Request->id )
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->id]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('is_show','<',$Request->is_show)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->is_show]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('show_date','<',$Request->show_date)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->show_date]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('title','like','%'.$Request->title.'%');
            });

    }


    public function GetKeyWord($Request,$Columns){

        return $this->GalleryRepository->select($Columns)
            ->where(function($SubQuery) use ($Request) {
                $SubQuery->where('title','like','%'.$Request->title.'%');
            });

    }

    /**
     * 取得該筆資料
     * @param $id
     * @return mixed|static
     */
    public function ById($id)
    {
        return Gallery::find($id);
    }

}