<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table ='gallery';
    protected $primaryKey = 'id';
    protected $fillable =['title','content','is_show',
        'show_date','create_user','modify_user'];


}