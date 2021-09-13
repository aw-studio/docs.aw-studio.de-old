<?php

namespace App\Http\Controllers;

use App\Docs\Page;
use App\Facades\Docs;
use Inertia\Inertia;

class DocsController extends Controller
{
    /**
     * Render a docs page.
     *
     * @param  string            $category
     * @param  string            $page
     * @param  string            $subpage
     * @return \Inertia\Response
     */
    public function show($category = 'guidelines', $page = 'readme', $subpage = '')
    {
        $page = $this->getPage($category, $page, $subpage);

        return Inertia::render('Docs/Show', [
            'categories' => Docs::categories(),
            'category'   => $category,
            'page'       => $page,
            'subpage'    => $subpage,
            'page'       => $page->render(),
        ]);
    }

    /**
     * Get the page instance.
     *
     * @param  string $category
     * @param  string $page
     * @param  string $subpage
     * @return Page
     */
    protected function getPage($category, $pageName, $subpage)
    {
        $page = Docs::page($category, $pageName, $subpage);

        if ($page->exists()) {
            return $page;
        }

        if ($subpage == '') {
            $subpage = 'readme';
        } else {
            abort(404);
        }

        $page = Docs::page($category, $pageName, $subpage);

        if (! $page->exists()) {
            abort(404);
        }

        return $page;
    }
}
