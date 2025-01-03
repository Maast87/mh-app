<?php

namespace App\Models\Concerns;

trait ConvertsMarkdownToHtml
{
    protected static function bootConvertsMarkdownToHtml(): void
    {
        static::saving(function (self $model) {
            $markdownData = collect(self::getMarkdownToHtmlMap())
                ->flip()
                ->map(fn ($bodyColumn) => str($model->$bodyColumn)->markdown([
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                    'max_nesting_level' => 5,
                    // these three are coming from CommonMark, which Laravel uses out of the box: https://commonmark.thephpleague.com/
                ]));

            return $model->fill($markdownData->all());
        });
    }

    protected static function getMarkdownToHtmlMap(): array
    {
        return [
            'body' => 'html',
        ];
    }
}
