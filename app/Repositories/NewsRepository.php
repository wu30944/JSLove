<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\News;
use Validator;
use Response;
use Auth;

class NewsRepository
{
    private $NewsRepository;

    public function __construct(News $data)
    {
        $this->NewsRepository = $data;
    }

    public function getAll()
    {
        return $this->NewsRepository->orderBy('created_at', 'desc')->paginate(5);
    }


    public function getAllTest($column)
    {
        return $this->NewsRepository->select($column)->get();
    }



    public function Create(array $params){

        return News::create($params);
    }

    public function destroy($id)
    {
        return $this->NewsRepository->find($id)->delete();
    }


    public function GetByCondition($Request,$Columns){

        return $this->NewsRepository->select($Columns)
            ->where(function($SubQuery) use ($Request) {
                $SubQuery->where('id','=',$Request->id )
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->id]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('title','=',$Request->title)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->title]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('action_date','<',$Request->show_date)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->show_date]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('show_date','<',$Request->show_date)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->show_date]);
            })->where(function($SubQuery) use ($Request) {
                $SubQuery->where('status','=',$Request->status)
                    ->orwhereRaw("''=IFNULL(?,'')", [$Request->status]);
            });

    }

    /**
     * 取得該筆資料
     * @param $id
     * @return mixed|static
     */
    public function ById($id)
    {
        return News::find($id);
    }

}