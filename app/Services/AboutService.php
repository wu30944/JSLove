<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/6
 * Time: 下午6:40
 */

namespace App\Services;

use Auth;
use App\Repositories\AboutRepository;
use App\Http\Requests;
use StdClass;

class AboutService {

    protected $AboutRepository;

    public function __construct(AboutRepository $AboutRepository){

        $this->AboutRepository = $AboutRepository;
    }

    /**
     * 資料建立
     * @param array $Params
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function Create(array $Params)
    {
        return $this->AboutRepository->Create($Params);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->AboutRepository->ById($id);
    }

    public function getAboutContent(array $request,array $columns){

        return $this->AboutRepository->getAboutByCondition($request,$columns);

    }

    /*
     * 將分頁內容在下方function組成畫面內容
     * $CurrentPage:目前畫面正在第幾頁
     * $data:要顯示在畫面上的內容
     *
     * */
    public function getPage($CurrentPage,$data){

        $page = $CurrentPage;
        $res = '';

        foreach($data['data'] as $val){
            $res .= '<tr class="item'.$val->id.'">';
            $res .='<td align="center" style="width:20%"><p id="company_name'.$val->id.'">'.$val->zh_company_name.'</p></td>';
            $res .='<td style="width:20%" align="center">';
            if(Auth::guard('admin')->user()->hasRule('admin.about.edit')){
                $res .='<button class="edit-modal btn btn-success" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-edit"></span>'.trans('default.edit').
                    '</button>';
            }
            if(Auth::guard('admin')->user()->hasRule('admin.about.destroy')){
                $res .=' <button class="delete-modal btn btn-danger" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-trash"></span>'.trans('default.delete').
                    '</button>';
            }
            $res .='</td>';
            $res .='</tr>';
        }

        $pagination='';
        $pagination .='<div class="page">';
        $pagination .='<!-------分页---------->' ;
        if($data['count'] > 5){
            $pagination .= '<ul class="pagination">';
            if($page != 1){
                $pagination .='<li>';
                $pagination .='<a href="javascript:void(0)" onclick="page('.$data['prev'].')"><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }else{
                $pagination .='<li class="disabled">';
                $pagination .='<a href="javascript:void(0)" ><span class="glyphicon glyphicon-chevron-left"></span></a>';
                $pagination .='</li>';
            }
            foreach($data['pages'] as $k=>$v){
                if($v == $data['page']){
                    $pagination .='<li class="active"><span>'.$v.'</span></li>';

                }else{
                    $pagination .='<li>' ;
                    $pagination .='<a href="javascript:void(0)" onclick="page('.$v.')">'.$v.'</a>' ;
                    $pagination .='</li>' ;
                }

            }
            if($page != $data['sums']){
                $pagination .= '<li>';
                $pagination .= '<a href="javascript:void(0)" onclick="page('.$data['next'].')"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }else{
                $pagination .= '<li class="disabled">';
                $pagination .= '<a href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a>' ;
                $pagination .= '</li>';
            }
            $pagination .='</ul>';
        }

        $Return=array('page_content'=>$res,'page'=>$pagination);

        return $Return;

    }


    public function RefleshView(){

        $Request = new StdClass;
        $Request->zh_company_name = '';
        $Request->en_company_name = '';
        $Request->status = '';
        $Request->id='';

        $Columns = array('id','zh_company_name','en_company_name','status');
        $About = $this->AboutRepository->GetByCondition($Request,$Columns);

        return $About;
    }

    public function Destroy($Model){
        $Model->delete();
    }

}