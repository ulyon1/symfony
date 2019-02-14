<?php

namespace Metinet\App;

class SimpleSlugGenerator implements SlugGenerator
{
    private const DELIMITER = '-';

    public function slugify(string $text): string
    {
        $value = transliterator_transliterate(
            'Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();',
            $text
        );
        $value = preg_replace('/[^a-zA-Z0-9]/', static::DELIMITER, $value);
        return trim($value, static::DELIMITER);
    }
}
