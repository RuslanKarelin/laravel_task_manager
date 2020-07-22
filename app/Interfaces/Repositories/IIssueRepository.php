<?php

namespace App\Interfaces\Repositories;

interface IIssueRepository
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param int $limit
     * @return mixed
     */
    public function getAllWithPaginate(int $limit);

    /**
     * @return mixed
     */
    public function getBuilder();

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id);

    /**
     * @return mixed
     */
    public function getStatisticData();

    /**
     * @return mixed
     */
    public function getCount();

    /**
     * @param $builder
     * @param $field
     * @param $firstValue
     * @param $lastValue
     * @return mixed
     */
    public function whereBetween($builder, $field, $firstValue, $lastValue);

    /**
     * @param $builder
     * @param $field
     * @param $value
     * @return mixed
     */
    public function where($builder, $field, $value);

    /**
     * @param $builder
     * @param $limit
     * @return mixed
     */
    public function paginate($builder, $limit);
}