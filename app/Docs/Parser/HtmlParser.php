<?php

namespace App\Docs\Parser;

abstract class HtmlParser
{
    /**
     * Parse the given html.
     *
     * @param  string $markdown
     * @return string
     */
    abstract public function parse(string &$html): string;
}
