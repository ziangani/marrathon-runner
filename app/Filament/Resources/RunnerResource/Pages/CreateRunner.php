<?php

namespace App\Filament\Resources\RunnerResource\Pages;

use App\Filament\Resources\RunnerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRunner extends CreateRecord
{
    protected static string $resource = RunnerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
