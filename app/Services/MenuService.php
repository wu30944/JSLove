<?php
namespace App\Services;


use App\Repositories\MenuRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use stdClass;

class MenuService
{
    protected $MenuRepository;

    /**
     * RulesService constructor.
     * @param MenuRepository $MenuRepository
     */
    public function __construct(MenuRepository $MenuRepository)
    {

        $this->MenuRepository = $MenuRepository;
    }

    /**
     * 创建权限数据
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->MenuRepository->create($params);
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->MenuRepository->ById($id);
    }

    public function GetByCondition(StdClass $request,array $columns){

        return $this->MenuRepository->GetByCondition($request,$columns);

    }


    /*
     * 將畫面上view的內容組起來
     * */
    public function getPageContent(array $data)
    {
        $res = '';
        $page= $data['page'];

        foreach($data['data'] as $val){
            $res .= '<tr class="item'.$val->id.'">';
            $res .='<td align="center"  style="width:30%"><p id="company_name'.$val->id.'">'.$val->store_name.'</p></td>';
            $res .='<td align="center">';
            if(Auth::guard('admin')->user()->hasRule('admin.store_info.edit')){
                $res .='<button class="edit-modal btn btn-info" data-info="'.$val->id.'">
                                <span class="glyphicon glyphicon-edit"></span>'.trans('default.edit').
                    '</button>';
            }
            if(Auth::guard('admin')->user()->hasRule('admin.store_info.destroy')){
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

        $Return=array('page_content'=>$res,'page'=>$pagination,'page_num'=>$page);

        return $Return;
    }


    public function Update($model,$request){

        $datas = $request->all();

        $model->update($datas);

    }

    public function UpdatePhoto($model,$PhotoUrl){

        $model->update($PhotoUrl);
    }

    public function RefleshView(){

        $request=new stdClass();
        $request->menu_name = '';
        $request->prod_name = '';
        $request->status = '1';
        $request->id='';

        $columns = array('id','menu_name','prod_name'
        ,'prod_intro','photo','price','status');

        $dtMenu = $this->MenuRepository->GetByCondition($request,$columns)->get();

        $columns = array('menu_name');
        $request->menu_name='';
        $dtMenuTitle = $this->MenuRepository->GetByCondition($request,$columns)->groupBy('menu_name')->get();

        $Return=["Menu"=>$dtMenu,"Title"=>$dtMenuTitle];

        return $Return;
    }

    public function GetEditContent(stdClass $Param,array $Columns){

        $MenuContent = $this->MenuRepository->GetByCondition($Param,$Columns)->get();

        $Columns = array('menu_name');
        $Param->id="";
        $MenuTitle = $this->MenuRepository->GetByCondition($Param,$Columns)->groupBy('menu_name')->get();

        $Return=["MenuContent"=>$MenuContent,"Title"=>$MenuTitle];

        return $Return;
    }

    public function GetCreateContent(stdClass $Param,array $Columns){


        $MenuTitle = $this->MenuRepository->GetByCondition($Param,$Columns)->groupBy('menu_name')->get();

        $Return=["Title"=>$MenuTitle];

        return $Return;
    }

    public function Destroy($Model){
        $Model->delete();
    }

    public function WebShow(){

        $request=new stdClass();
        $request->menu_name = '';
        $request->prod_name = '';
        $request->status = '1';
        $request->id='';

        $columns = array('id','menu_name','prod_name'
        ,'prod_intro','photo','price','status');

        $dtMenu = $this->MenuRepository->GetByCondition($request,$columns);

        $Menu = $dtMenu->get();

        $dtMenuName = $dtMenu->select('menu_name')->distinct('menu_name')->get();
//
        $Return=["Menu"=>$Menu,"Title"=>$dtMenuName];

        return $Return;
    }

}