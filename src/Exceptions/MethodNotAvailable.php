<?php

declare(strict_types=1);

namespace Lipit146\FilesystemSirv\Exceptions;

use Exception;

class MethodNotAvailable extends Exception
{
    public static function throw(string $methodName): static
    {
        return new static("The method `{$methodName}` is not available for Sirv Images.");
    }

    public function render(\Illuminate\Http\Request $request): \Illuminate\Http\Response
    {
        return response(['error' => $this->getMessage()], 400);
    }
}
