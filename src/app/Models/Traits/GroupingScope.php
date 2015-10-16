<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/10/14
 * Time: 23:01
 */

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

/**
 * WhereにグループIDを追加
 * Class FixWhere
 * @package App\Models\Traits
 */
class GroupingScope implements ScopeInterface
{
    private $groupId;

    public function __construct($groupId = null)
    {
        $this->groupId = $groupId;
    }

    public function apply(Builder $builder, Model $model)
    {
        $builder->where($this->getColumn($model), $this->groupId);
    }

    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();

        $bindingKey = 0;
        foreach ($query->wheres as $key => $where) {
            if ($where['column'] === $this->getColumn($model)) {
                unset($query->wheres[$key]);
                $query->wheres = array_values($query->wheres);

                $bindings = $query->getRawBindings()['where'];
                unset($bindings[$bindingKey]);
                $query->setBindings($bindings);

                return;
            }

            if (!in_array($where['type'], ['Null', 'NotNull'])) {
                $bindingKey++;
            }
        }
    }

    protected function getColumn(Model $model)
    {
        return $model->getTable() . ".group_id";
    }
}