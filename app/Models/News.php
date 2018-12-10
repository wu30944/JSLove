<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table ='news';
    protected $primaryKey = 'id';
    protected $fillable =['title','action_date','action_time',
        'action_position','content','photo','youtube','show_date','status'];

    public function files(){
        return $this->hasMany("App\Models\NewsFiles","news_id");
    }

}