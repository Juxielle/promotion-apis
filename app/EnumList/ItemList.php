<?php

namespace App\EnumList;

abstract class ItemList
{
    public array $items = [];

    protected abstract function setItems() : void;

    public function item(string $key) : ItemEnum|null
    {
        $this->setItems();
        $item = null;

        foreach ($this->items as $value){
            if ($key <> $value->key) continue;
            $item = $value;
            break;
        }

        return $item;
    }

    public function values() : array
    {
        $this->setItems();
        $values = [];

        foreach ($this->items as $value){
            $values[] = $value->value;
        }

        return $values;
    }

    public function value(string $key): string
    {
        $value = null;

        foreach ($this->items as $item) {
            if ($key <> $item->key) continue;
            $value = $item->value;
            break;
        }

        return $value;
    }

    public function keys() : array
    {
        $this->setItems();
        $keys = [];

        foreach ($this->items as $value){
            $keys[] = $value->key;
        }

        return $keys;
    }

    public function data() : array
    {
        $this->setItems();
        $data = [];

        foreach ($this->items as $value){
            $data[] = $value->data;
        }

        return $data;
    }
}
