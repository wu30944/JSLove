<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsFiles extends Model
{
    protected $table ='news_files';
    protected $primaryKey = 'id';
    protected $fillable =['file_url','remark','news_id'];

}