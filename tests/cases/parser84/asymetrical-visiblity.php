<?php

class Book
{
    public private(set) string $isbn;
    protected public(set) string $invalid;

    public function __construct(
        public private(set) string $title,
        public protected(set) string $author,
        public public(set) string $invalidPromotion,
        public string $bar,
    ) {}
}
