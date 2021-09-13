<?php

namespace App\Docs;

use Illuminate\Support\Collection;

class ItemCollection extends Collection
{
    /**
     * The items contained in the collection.
     *
     * @var Item
     */
    protected $items = [];
}
