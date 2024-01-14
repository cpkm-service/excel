<?php

namespace Cpkm\Excel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelImport extends Model
{
    use HasFactory;
    use \App\Traits\ObserverTrait;
    protected $fillable = [
        'status',
        'name',
        'path',
        'error',
        'model',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * 列表SQL
     * @param  array $where
     * @return $query
     * @version 1.0
     * @author Henry
     */
    public function listQuery(array $where) {
        $query = $this->where($where);
        if(isset($this->withs) && $this->withs) {
            $query = $query->with($this->withs);
        }
        if(isset($this->detail) && $this->detail) {
            $query = $query->select($this->detail);
        }
        return $query;
    }
    
}
