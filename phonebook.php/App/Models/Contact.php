<?php

namespace App\Models;
use App\Models\Contracts\MysqlBaseModel;

class Contact extends MysqlBaseModel
{
    protected $table = 'contacts';
    protected int $pageSize = 10;

    public function __construct()
    {
        parent::__construct();
    }

    public function getPageSize() {
        return $this->pageSize;
    }

}