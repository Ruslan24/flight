<?php

namespace App\Repositories\Contracts;

interface Repository
{
    /**
     * Retrieve the "count" result of the query.
     *
     * @param array $where
     * @param string $columns
     * @return int
     */
    public function count(array $where = [], $columns = '*');

    /**
     * Retrieve the "sum" result of the query.
     *
     * @param  string  $columns
     * @return int
     */
    public function sum($columns = '*');

    /**
     * Retrieve the "avg" result of the query.
     *
     * @param  string  $columns
     * @return int
     */
    public function avg($columns = '*');

    /**
     * Reset all criteria, scopes and model.
     *
     * @return $this
     */
    public function reset();

    /**
     * Returns true if collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Returns true if collection is not empty.
     *
     * @return bool
     */
    public function isNotEmpty(): bool;
}
