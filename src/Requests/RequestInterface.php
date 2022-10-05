<?php

namespace MouradA\Blog\Requests;

use Exception as ExceptionAlias;

interface RequestInterface
{
    /**
     * @return bool
     * @throws ExceptionAlias
     */
    public function validate():bool;
}