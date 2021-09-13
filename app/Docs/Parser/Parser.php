<?php

namespace App\Docs\Parser;

use ParsedownExtra;

class Parser extends ParsedownExtra
{
    /**
     * List of the parser in the correct order.
     *
     * @var array
     */
    protected array $parser = [
        //
    ];

    /**
     * Parse markdown to html.
     *
     * @param  string $text
     * @return string
     */
    public function parse($text)
    {
        $parser = collect($this->parser)
            ->map(fn ($class) => app($class));

        // Parse markdown.
        $parser
            ->filter(fn ($p) => $p instanceof MarkdownParser)
            ->each(fn ($p)   => $p->parse($text));

        $text = $this->text($text);

        // Parse html.
        $parser
            ->filter(fn ($p) => $p instanceof HtmlParser)
            ->each(fn ($p)   => $p->parse($text));

        return $text;
    }
}
