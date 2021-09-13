<?php

namespace App\Facades;

use App\Docs\Page;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Page page(string $category, string $page = 'readme', ?string $subpage = null)
 * @method static string path(string $path = '')
 */
class Docs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'docs';
    }
}
