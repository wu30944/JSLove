<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/6
 * Time: 下午6:40
 */

namespace App\Services;

use Auth;
use App\Repositories\ContactUsRepository;
use App\Http\Requests;
use StdClass;

class ContactUsService {

    protected $ContactUsRepository;

    public function __construct(ContactUsRepository $ContactUsRepository){

        $this->ContactUsRepository = $ContactUsRepository;
    }

    /**
     * 資料建立
     * @param $Request
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function Create($Request)
    {
        $Data = $Request->all();
        return $this->ContactUsRepository->Create($Data);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->ContactUsRepository->ById($id);
    }

    public function getAboutContent(array $request,array $columns){

        return $this->ContactUsRepository->getAboutByCondition($request,$columns);

    }


    public function RefleshView(){

        $Request = new StdClass;
        $Request->zh_company_name = '';
        $Request->en_company_name = '';
        $Request->status = '';
        $Request->id='';

        $Columns = array('id','zh_company_name','en_company_name','status');
        $About = $this->ContactUsRepository->GetByCondition($Request,$Columns);

        return $About;
    }

    public function Destroy($Model){
        $Model->delete();
    }

}