<?php

class Record
{
    /** @var array  */
    public $list = [];

    /**
     * Record constructor.
     * @param array $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * @param $record
     * @return $this
     */
    public function add($record)
    {
        if (is_object($record) && !empty($record->host) && !empty($record->target)) {
            $this->list[] = [$record->host => $record->target];
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param array $list
     * @return Record
     */
    public function setList($list)
    {
        $this->list = $list;
        return $this;
    }



}
