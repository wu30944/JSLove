<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table ='carousel';
    protected $primaryKey = 'id';
    protected $fillable =['title','description','photo_url',
        'is_show','show_date','button_title','button_url','sort','created_user','modify_user'];


}