<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkDiary extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    protected $fillable = ['remarks'];

    protected $casts = ['archive' => 'boolean'];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return sprintf('%s (%s)', $this->view_id, $this->workField->name);
    }

    public function  getViewIdAttribute()
    {
        return sprintf('%s%08d', 'D', $this->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workRecords()
    {
        return $this->belongsToMany(WorkRecord::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workField()
    {
        return $this->belongsTo(WorkField::class);
    }
}
