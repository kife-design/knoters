<?php

namespace Knoters\Services\Sources;


interface SourceContract
{
    public function getId($url);
}