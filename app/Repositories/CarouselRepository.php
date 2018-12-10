<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Carousell;
use Validator;
use Response;
use Auth;

class CarouselRepository
{
    private $CarousellRepository;

    public function __construct(Carousell $data)
    {
        $this->CarousellRepository = $data;
    }

    public function getAll()
    {
        return $this->CarousellRepository->orderBy('created_at', 'desc')->paginate(5);
    }


    public function getAllTest($column)
    {
        return $this->CarousellRepository->select($column)->get();
    }



    public function Create(array $params){

        return Carousell::create($params);
    }

    public function destroy($id)
    {
        return $this->CarousellRepository->find($id)->delete();
    }


    public function GetByCondition($Request,$Columns){

        return $this->CarousellRepository->select($Columns)
            ->where(function($SubQuery) use ($Request) {
                $SubQuery->where('id','=',$Request->id )
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->id]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('title','=',$Request->title)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->title]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('is_show','=',$Request->is_show)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->is_show]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('show_date','<',$Request->show_date)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->show_date]);
            });

    }

    /**
     * 取得該筆資料
     * @param $id
     * @return mixed|static
     */
    public function ById($id)
    {
        return Carousell::find($id);
    }


}