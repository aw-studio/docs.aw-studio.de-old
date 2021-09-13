<?php

namespace App\Docs;

use App\Facades\Docs;
use Illuminate\Contracts\Support\Arrayable;

class Item implements Arrayable
{
    /**
     * Create new Item instance.
     *
     * @param  string $title
     * @param  string $route
     * @return void
     */
    public function __construct(
        public string $title,
        public string $route,
    ) {
        //
    }

    /**
     * Get the sub items.
     *
     * @return ItemCollection
     */
    public function subItems(): ItemCollection
    {
        return Docs::subItems($this);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'title' => $this->title,
            'route' => $this->route,
        ];
    }
}
