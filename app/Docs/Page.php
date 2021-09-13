<?php

namespace App\Docs;

use App\Facades\Docs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class Page implements Renderable
{
    public function __construct(
        public string $category,
        public string $page = 'readme',
        public string $subpage = 'readme'
    ) {
        //
    }

    /**
     * Get the path of the page.
     *
     * @return string
     */
    public function path(): string
    {
        return Docs::path(
            $this->category.'/'
            .$this->page
            .($this->subpage == '' ? '' : '/'.$this->subpage)
            .'.md'
        );
    }

    /**
     * Determine whether the page exists.
     *
     * @return bool
     */
    public function exists(): bool
    {
        return File::exists($this->path());
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        return [
            'category' => $this->category,
            'page'     => $this->page,
            'subpage'  => $this->subpage,
            'pages'    => $this->pages(),
            'route'    => $this->route(),
            'content'  => $this->content(),
        ];
    }

    public function pages(): ItemCollection
    {
        $pages = new ItemCollection([]);

        if ($this->page == 'readme') {
            $paths = collect(File::directories(dirname($this->path())));
        } else {
            $paths = collect(File::files(dirname($this->path())))
                ->map(fn (SplFileInfo $file) => $file->getPath().'/'.pathinfo($file->getFilename())['filename']);
        }

        foreach ($paths as $path) {
            $route = str_replace(Docs::path(), '', $path);
            $name = basename($path);

            $pages->add(
                new Item(__('docs.'.$name), $route)
            );
        }

        return $pages;
    }

    /**
     * Get the route to the page.
     *
     * @return string
     */
    public function route()
    {
        $route = '/'.$this->category;

        if ($this->page == 'readme') {
            return $route;
        }

        $route .= '/'.$this->page;

        if ($this->subpage == 'readme') {
            return $route;
        }

        return $route.'/'.$this->subpage;
    }

    /**
     * Get the content to the page.
     *
     * @return string
     */
    public function content(): string
    {
        return app('docs.parser')->parse($this->raw());
    }

    /**
     * Get the raw content of the page.
     *
     * @return string
     */
    public function raw(): string
    {
        if (! $this->exists()) {
            return '';
        }

        return File::get($this->path());
    }
}
