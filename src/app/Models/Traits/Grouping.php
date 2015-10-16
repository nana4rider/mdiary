<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/10/14
 * Time: 23:00
 */

namespace App\Models\Traits;

use Auth;
use Illuminate\Database\Eloquent\Model;

trait Grouping
{
    public static function bootGrouping()
    {
        $groupId = Auth::User()->id;

        static::addGlobalScope(new FixWhere(['group_id' => $groupId, 'po1' => 1]));

        static::creating(function (Model $model) use ($groupId) {
            $model->setAttribute('group_id', $groupId);
        });
    }

    public static function allGroups()
    {
        $groupId = Auth::User()->id;

        return (new static)->newQueryWithoutScope(new FixWhere([]));
    }
}