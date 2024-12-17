<?php

namespace Ravols\EverifinPhp\Helpers\DataHelper\Traits;

trait DataConversion
{
    public function toJson(): string
    {
        return json_encode($this->getNonNullProperties());
    }

    public function toArray()
    {
        $result = [];
        foreach ($this as $key => $value) {
            $result[$key] = (is_array($value) || is_object($value)) ? $this->toArray($value) : $value;
        }

        return $result;
    }

    public function getNonNullProperties()
    {
        return array_filter($this->toArray(), fn ($item) => ! is_null($item));
    }
}
