<?php

namespace App\Docs\Index;

use App\Docs\Page;
use App\Models\Section;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class Indexer
{
    /**
     * Levels.
     *
     * @var array
     */
    protected $levels = ['<h1>', '<h2>', '<h3>', '<h4>'];

    /**
     * Make index for the given page.
     *
     * @param  Page $page
     * @return void
     */
    public function makeFor(Page $page)
    {
        $this->page = $page;

        $content = $page->content();

        $this->forLevel($this->levels[0], $content);
    }

    protected function forLevel($level, $content, $breadcrump = [])
    {
        $nextLevel = $this->getNextLevel($level);

        if (! str_contains($content, $level)) {
            return;
        }

        $sections = collect(explode($level, $content))
            ->map(function ($part) use ($level, $breadcrump) {
                $closing = $this->getClosingLevel($level);

                $title = $this->title(Str::before($part, $closing));

                $breadcrump[] = $title;

                return new Section([
                    'title'      => $title,
                    'content'    => Str::after($part, $closing),
                    'breadcrump' => implode(' > ', $breadcrump),
                    'path'       => $this->path($this->page->route()),
                    'route'      => $this->page->route(),
                    'level'      => array_search($level, $this->levels) + 1,
                ]);
            })
            ->filter(function ($section) {
                return $section->title;
            });

        if ($nextLevel) {
            $sections->each(function ($section) use ($nextLevel) {
                $breadcrump[] = $section->title;

                $this->forLevel($nextLevel, $section->content, $breadcrump);
            });

            foreach ($sections as $section) {
                $section->content = $this->content(Str::before($section->content, $nextLevel));
            }
        }

        try {
            $sections->each->save();
        } catch (QueryException $e) {
            //
        }
    }

    protected function getClosingLevel($level)
    {
        return str_replace('<', '</', $level);
    }

    protected function getNextLevel($level)
    {
        $key = array_search($level, $this->levels) + 1;

        if ($key >= count($this->levels)) {
            return;
        }

        return $this->levels[$key];
    }

    protected function title($title)
    {
        return str_replace("\n", '', strip_tags($title));
    }

    protected function content($content)
    {
        return str_replace("\n", '', strip_tags($content));
    }

    protected function path($route)
    {
        if (Str::startsWith($route, '/')) {
            $route = Str::replaceFirst('/', '', $route);
        }

        $path = explode('/', $route);
        array_pop($path);

        return implode(' > ', $path);
    }
}
