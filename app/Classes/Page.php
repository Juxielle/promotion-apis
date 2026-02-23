<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Collection;

class Page
{
    public Collection $models;
    public int $pageCount;
    public int $selectedPage;

    public function __construct(Collection $models, int $pageCount = 1, int $selectedPage = 1)
    {
        $this->models = $models;
        $this->pageCount = $pageCount;
        $this->selectedPage = $selectedPage;
    }
}