<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository as RepositoryContract;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Log\Logger;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

abstract class Repository extends BaseRepository implements RepositoryContract
{
    /**
     * @var Logger
     */
    protected $log;

    /**
     * Repository constructor.
     *
     * @param  Application $app
     * @param  Logger      $log
     */
    public function __construct(Application $app, Logger $log)
    {
        parent::__construct($app);

        $this->log = $log;
    }

    /**
     * Calling model's default functions.
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }

    /**
     * Retrieve the "count" result of the query.
     *
     * @param array $where
     * @param string $columns
     *
     * @return int
     */
    public function count(array $where = [], $columns = '*')
    {
        $this->applyCriteria();
        $this->applyScope();

        return $this->model->count($columns);
    }

    /**
     * Retrieve the "sum" result of the query.
     *
     * @param  string $columns
     *
     * @return int
     */
    public function sum($columns = '*')
    {
        $this->applyCriteria();
        $this->applyScope();

        return $this->model->sum($columns);
    }

    /**
     * Retrieve the "avg" result of the query.
     *
     * @param  string $columns
     *
     * @return int
     */
    public function avg($columns = '*')
    {
        $this->applyCriteria();
        $this->applyScope();

        return $this->model->avg($columns);
    }

    /**
     * Reset all criteria, scopes and model.
     *
     * @return $this
     * @throws RepositoryException
     */
    public function reset(): static
    {
        $this->resetCriteria();
        $this->resetModel();
        $this->resetScope();
        $this->boot();

        return $this;
    }

    /**
     * Make apply criteria public.
     *
     * @return Repository
     */
    public function applyCriteria(): static
    {
        parent::applyCriteria();

        return $this;
    }

    /**
     * Returns true if collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        $this->applyCriteria();
        $this->applyScope();

        return $this->count() === 0;
    }

    /**
     * Returns true if collection is not empty.
     *
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Filter query by relation field.
     *
     * @param string $relation
     * @param mixed $field
     * @param mixed  $value
     * @param string $operator
     *
     * @return Repository
     */
    public function whereRelation(string $relation, $field, $value, string $operator = '='): Repository
    {
        return $this->whereHas($relation, function (Builder $builder) use ($field, $value, $operator): Builder {
            return $builder->where($field, $operator, $value);
        });
    }

    /**
     * @param $query
     * @param $table
     * @return bool
     */
    public function isJoined($query, $table): bool
    {
        $joins = $query->getQuery()->joins;
        if ($joins == null) {
            return false;
        }

        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $Builder
     * @param $table
     * @return bool
     */
    public function hasJoin(\Illuminate\Database\Query\Builder $Builder, $table): bool
    {
        foreach ($Builder->joins as $JoinClause) {
            if ($JoinClause->table == $table) {
                return true;
            }
        }
        return false;
    }
}
