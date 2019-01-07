<?php

namespace App\Http\Controllers\joyslove;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Repositories\AlbumRepository;
use App\Repositories\AlbumDRepository;
use App\Repositories\SystemCodeRepository;
use App\Services\AboutService;
use App\Services\CarouselService;
use App\Services\NewsService;
use App\Services\MenuService;
use App\Services\StoreInfoService;
use App\Services\GalleryService;
use App\Services\AlbumService;
use App\Http\Requests\Admin\ContactUsFormRequest;
use Validator;
use Captcha;
use App\Services\ContactUsService;

class IndexController extends Controller
{
    private $AlbumRepository;
    private $AlbumDRepository;
    private $SystemCodeRepository;
    private $AboutService;
    private $CarouselService;
    private $NewsService;
    private $MenuService;
    private $StoreInfoService;
    private $GalleryService;
    private $AlbumService;
    private $ContactUsService;

    public function __construct(AlbumRepository $AlbumRepository,
                                AlbumDRepository $AlbumDRepository,
                                SystemCodeRepository $SystemCode,
                                AboutService $AboutService,
                                CarouselService $CarouselService,
                                NewsService $NewsService,
                                MenuService $MenuService,
                                StoreInfoService $StoreInfoService,
                                GalleryService $GalleryService,
                                AlbumService $AlbumService,
                                ContactUsService $ContactUsService
    )
    {
        $this->AlbumRepository = $AlbumRepository;
        $this->AlbumDRepository = $AlbumDRepository;
        $this->SystemCodeRepository=$SystemCode;
        $this->AboutService = $AboutService;
        $this->CarouselService = $CarouselService;
        $this->NewsService = $NewsService;
        $this->MenuService = $MenuService;
        $this->StoreInfoService = $StoreInfoService;
        $this->GalleryService = $GalleryService;
        $this->AlbumService = $AlbumService;
        $this->ContactUsService = $ContactUsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $strAlbumId=$this->AlbumRepository->GetBannerAlbumId();
//        $Columns = array('id','album_id','photo_name','photo_path','photo_thumb_path','photo_virtual_path');
//        $AlbumContent = $this->AlbumDRepository->getAlbumDByCondition($strAlbumId,$Columns);

        $Carousel = $this->CarouselService->WebShow()->get();

        $About = $this->AboutService->ById(5);

        $News = $this->NewsService->WebShow()->orderBy('action_date','desc')->take(4)->get();

        $Menu = $this->MenuService->WebShow();
        $MenuName = $Menu['Title'];
        $MenuContent = $Menu['Menu'];

        $StoreInfo = $this->StoreInfoService->WebShow();

        $GalleryContent = $this->GalleryService->WebShow();
        $AlbumContent = $this->AlbumService->WebShow();
        return view('joyslove.home.home')->with('Banner',$Carousel)
                                              ->with('About',$About)
                                              ->with('News',$News)
                                              ->with('MenuTitle',$MenuName)
                                              ->with('MenuContent',$MenuContent)
                                              ->with('StoreInfo',$StoreInfo)
                                              ->with('Gallery',$GalleryContent)
                                              ->with('GalleryPhoto',$AlbumContent);
    }

    public function main()
    {
        return view('admin.indexs.main');
    }


    public function store(ContactUsFormRequest $request){

        $rules = array (
            'captcha' => 'required|captcha'
        );
        $messages = ['captcha.captcha' => '驗證碼錯誤'];

        $validator = Validator::make ( $request->all (), $rules, $messages );
        $url = route('joyslove.index').'#mail';
        if ($validator->fails ()){
            return redirect($url)
                ->withErrors($validator)
                ->withInput();
//            return viewError(trans('message.send_fail'),'joyslove.index','error');
        }else{
            $this->ContactUsService->Create($request);
        }

        return viewError(trans('message.send_successful'),'joyslove.index','send_success');
    }


}
