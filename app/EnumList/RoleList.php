<?php

namespace App\EnumList;

use App\Classes\Constant;

class RoleList extends ItemList
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new ItemEnum(
                key: Constant::SELLER,
                value: "Vendeur"
            ),
            new ItemEnum(
                key: Constant::CUSTOMER,
                value: "Client"
            ),
            new ItemEnum(
                key: Constant::ADMIN,
                value: "Administrateur"
            ),
            new ItemEnum(
                key: Constant::SUPER_ADMIN,
                value: "Super Administrateur"
            ),
            new ItemEnum(
                key: Constant::ROOT,
                value: "Racine"
            ),
        ];

        $this->setItems();
    }

    protected function setItems(): void
    {
        $this->items = $this->list;
    }
}
