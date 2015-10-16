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
        $user = Auth::User();

        if (is_null($user)) {
            return;
        }

        $groupId = $user->group_id;

        static::addGlobalScope(new GroupingScope($groupId));

        static::creating(function (Model $model) use ($groupId) {
            // 登録時、グループIDが指定されていない場合はログインユーザのグループIDを設定
            if (is_null($model->getAttribute('group_id'))) {
                $model->setAttribute('group_id', $groupId);
            }
        });
    }

    /**
     * 全グループのエンティティを取得
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function allGroups()
    {
        return (new static)->newQueryWithoutScope(new GroupingScope);
    }

    /**
     * 自身のグループとその他のグループを取得
     * @param $groups
     * @return
     */
    public static function orGroup(... $groups)
    {
        $groups[] = Auth::User()->group_id;

        return self::allGroups()->whereIn('group_id', $groups);
    }
}