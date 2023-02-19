<?php

namespace App\UserInterface\Presenter;

use Twig\Environment;

abstract class PresenterAbstract
{
    public function __construct(
        readonly protected Environment $twig,
    ) {}
}