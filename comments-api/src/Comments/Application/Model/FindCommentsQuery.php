<?php

declare(strict_types=1);

namespace App\Comments\Application\Model;

class FindCommentsQuery
{
    private string $externalContentId;

    public function __construct(string $externalContentId)
    {
        $this->externalContentId = $externalContentId;
    }

    public function getExternalContentId(): string
    {
        return $this->externalContentId;
    }
}
