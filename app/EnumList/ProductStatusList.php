<?php

namespace App\EnumList;

use App\Classes\Constant;

class ProductStatusList extends ItemList
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new ItemEnum(
                key: Constant::ACTIVE,
                value: "Active"
            ),
            new ItemEnum(
                key: Constant::SEX_F,
                value: "Femme"
            ),
        ];

        $this->setItems();
    }

    protected function setItems(): void
    {
        $this->items = $this->list;
    }
}
