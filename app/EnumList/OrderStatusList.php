<?php

namespace App\EnumList;

use App\Classes\Constant;

class OrderStatusList extends ItemList
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new ItemEnum(
                key: Constant::WAITING,
                value: "En attente",
            ),
            new ItemEnum(
                key: Constant::IN_PROGRESS,
                value: "En cours"
            ),
            new ItemEnum(
                key: Constant::DELIVERED,
                value: "livrée"
            ),
        ];

        $this->setItems();
    }

    protected function setItems(): void
    {
        $this->items = $this->list;
    }
}
