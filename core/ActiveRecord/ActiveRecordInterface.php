<?php

namespace core\ActiveRecord;

interface ActiveRecordInterface
{
    public function getTableName();
    
    public function getPrimaryKey();
}
