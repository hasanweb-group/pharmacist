<?php

namespace App\Filament\Resources\DrugResource\Pages;

use App\Filament\Resources\DrugResource;
use App\Traits\HasResourceIndexRedirect;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDrug extends CreateRecord
{
    use HasResourceIndexRedirect;

    protected static string $resource = DrugResource::class;
}
