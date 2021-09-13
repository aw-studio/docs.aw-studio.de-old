<?php

namespace App\Docs\Parser;

abstract class MarkdownParser
{
    /**
     * Parse the given markdown.
     *
     * @param  string $markdown
     * @return string
     */
    abstract public function parse(string &$markdown): string;
}
