<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkField extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    /**
     * 編集中の日誌があるか
     * @param Builder $query
     * @return mixed
     */
    public function scopeHasEditing(Builder $query)
    {
        return $query->whereNotNull('active_work_diary_id');
    }

    /**
     * 編集中の日誌がないか
     * @param Builder $query
     * @return mixed
     */
    public function scopeHasNotEditing(Builder $query)
    {
        return $query->whereNull('active_work_diary_id');
    }
}
