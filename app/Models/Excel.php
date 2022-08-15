<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Excel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'line'
    ];

    /**
     *
     *
     * @param int $id
     *
     * @return string
     */
    public function getLine($id)
    {
        $excelLine = DB::table('excel')->where('id', $id)->value('line');
        return $excelLine;
    }

    public function updateLine($id, $line)
    {
        $excel = DB::table('excel')->where('id', $id)->update(array('line' => $line));
        return $excel;
    }
}
