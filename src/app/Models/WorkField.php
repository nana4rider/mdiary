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

    protected $casts = [
        'archive' => 'boolean',
    ];

    public function workDiaries()
    {
        return $this->hasMany(WorkDiary::class);
    }

    /**
     * アクティブな日誌があるか
     * @param Builder $query
     * @param $cropId
     * @return Builder|static
     */
    public function scopeHasActiveDiary(Builder $query, $cropId = null)
    {
        return $query->whereHas('workDiaries', function ($query) use ($cropId) {
            $query->where('archive', false);

            if (!is_null($cropId)) {
                $query->where('crop_id', $cropId);
            }
        });
    }

    /**
     * アクティブな日誌がないか
     * @param Builder $query
     * @return Builder|static
     */
    public function scopeDoesntHaveActiveDiary(Builder $query)
    {
        return $query->whereDoesntHave('workDiaries', function ($query) {
            $query->where('archive', false);
        });
    }
}
