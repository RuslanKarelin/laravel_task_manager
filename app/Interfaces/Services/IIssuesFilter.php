<?php

namespace App\Interfaces\Services;


interface IIssuesFilter
{
    /**
     * @return mixed
     */
    public function build();

    /**
     * @return mixed
     */
    public function status();

    /**
     * @return mixed
     */
    public function project();

    /**
     * @return mixed
     */
    public function date();

    /**
     * @return mixed
     */
    public function afterBuild();
}