<?php

namespace App\Support\Api\Crud;

trait WithCrud
{
    use WithIndex, WithForm, WithStore, WithUpdate, WithDestroy;
}
