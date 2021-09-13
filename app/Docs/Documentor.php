<?php

namespace App\Docs;

use App\Docs\Parser\Parser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Documentor
{
    /**
     * Create new Documnetor instance.
     *
     * @param  Parser $parser
     * @return void
     */
    public function __construct(
        protected Parser $parser
    ) {
        //
    }

    /**
     * Returns a list of all pages.
     *
     * @return Collection
     */
    public function pages(): Collection
    {
        $pages = new Collection();

        foreach (File::directories($this->path()) as $dir) {
            $category = basename($dir);

            $page = $this->page($category);

            if ($page->exists()) {
                $pages->add($page);
            }

            foreach (File::directories($dir) as $dir) {
                $pageName = basename($dir);

                $page = $this->page($category, $pageName);

                if ($page->exists()) {
                    $pages->add($page);
                }

                foreach (File::files($dir) as $file) {
                    $subpage = pathinfo($file->getBasename())['filename'];

                    $pages->add($this->page($category, $pageName, $subpage));
                }
            }
        }

        return $pages;
    }

    /**
     * Get a collection of the categories.
     *
     * @return ItemCollection
     */
    public function categories(): ItemCollection
    {
        $categories = new ItemCollection([]);

        foreach (File::directories($this->path()) as $dir) {
            $name = basename($dir);

            $categories->add(
                new Item(__("docs.{$name}"), '/'.$name)
            );
        }

        return $categories;
    }

    public function path($path = '')
    {
        return resource_path(
            'docs'.($path ? DIRECTORY_SEPARATOR.$path : $path)
        );
    }

    /**
     * Get an instance of the page.
     *
     * @param  string $category
     * @param  string $page
     * @param  string $subpage
     * @return Page
     */
    public function page(string $category, string $page = 'readme', string $subpage = 'readme'): Page
    {
        return new Page($category, $page, $subpage);
    }
}
