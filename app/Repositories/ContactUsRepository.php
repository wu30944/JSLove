<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use Validator;
use Response;
use Auth;

class ContactUsRepository
{
    private $ContactUsRepository;

    public function __construct(ContactUs $ContactUs)
    {
        $this->ContactUsRepository=$ContactUs;
    }

    /**
     * 根据id获取权限的详细信息
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->ContactUsRepository->find($id);
    }


    public function getAll()
    {
        return $this->ContactUsRepository->orderBy('created_at', 'desc')->paginate(5);
    }


    public function store(Request $request)
    {
        //\Debugbar::info($request);
        $data = $this->ContactUsRepository->find($request->id);
        $data->zh_company_name = $request->zh_company_name;
        $data->en_company_name = $request->en_company_name;
        $data->address = $request->address;
        $data->fex = $request->fex;
        $data->telephone = $request->telephone;
        $data->email = $request->email;
        $data->zh_introduction = $request->zh_introduction;
        $data->en_introduction=$request->en_introduction;
        $data->uniform_number=$request->uniform_number;
        $data->status=$request->status;
        $data->save ();
    }

    public function Create($params){

        return ContactUs::create($params);
    }

    public function destroy($id)
    {
        $this->ContactUsRepository->find($id)->delete();
    }


    public function GetByCondition($request,$columns){

        return $this->ContactUsRepository->select($columns)
            ->where(function($SubQuery) use ($request) {
                $SubQuery->where('id','=',$request->id)
                    ->orwhereRaw("''=IFNULL(?,'')", [$request->id]);
            })->where(function($SubQuery) use ($request) {
                $SubQuery->where('zh_company_name','=',$request->zh_company_name)
                    ->orwhereRaw("''=IFNULL(?,'')", [$request->zh_company_name]);
            })->where(function($SubQuery) use ($request) {
                $SubQuery->where('en_company_name','=',$request->en_company_name )
                    ->orwhereRaw("''=IFNULL(?,'')", [$request->en_company_name]);
            })->where(function($SubQuery) use ($request) {
                $SubQuery->where('status','=',$request->status )
                    ->orwhereRaw("''=IFNULL(?,'')", [$request->status]);
            });

    }

}