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
use Illuminate\Database\Query\Builder as BaseBuilder;

/**
 * Whereに固定条件を追加
 * Class FixWhere
 * @package App\Models\Traits
 */
class FixWhere implements ScopeInterface
{
    private $conditions;

    /**
     * @param array $conditions 追加する固定条件
     */
    public function __construct(array $conditions)
    {
        $this->conditions = $conditions;
    }

    public function apply(Builder $builder, Model $model)
    {
        foreach ($this->conditions as $key => $value) {
            $builder->where($model->getTable() . "." . $key, $value);
        }
    }

    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();

        $removeKeys = [];
        $removeBindingKey = [];
        $bindingKey = 0;
        foreach ((array)$query->wheres as $key => $where) {
            if ($this->hasConditions($model, $where['column'])) {
                $removeKeys[] = $key;
                $removeBindingKey[] = $bindingKey;
            }

            if (!in_array($where['type'], ['Null', 'NotNull'])) {
                $bindingKey++;
            }
        }

        $this->removeWheres($query, $removeKeys);
        $this->removeBindings($query, $removeBindingKey);
    }

    /**
     * @param Model $model
     * @param $column
     * @return bool
     */
    protected function hasConditions(Model $model, $column)
    {
        foreach ($this->conditions as $key => &$value) {
            if ($column == $model->getTable() . '.' . $key) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param BaseBuilder $query
     * @param  array $keys
     */
    protected function removeWheres(BaseBuilder $query, array $keys)
    {
        foreach ($keys as $key) {
            unset($query->wheres[$key]);
        }

        $query->wheres = array_values($query->wheres);
    }

    /**
     * @param BaseBuilder $query
     * @param  array $keys
     */
    protected function removeBindings(BaseBuilder $query, array $keys)
    {
        $bindings = $query->getRawBindings()['where'];

        foreach ($keys as $key) {
            unset($bindings[$key]);
        }

        $query->setBindings($bindings);
    }
}