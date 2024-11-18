<?php

namespace App\Exceptions;

use Exception;

class DocumentException extends Exception
{
    public function render()
    {
        abort($this->getCode(), $this->getMessage());
    }
}
