<?php

namespace App\Filament\Resources\RunnerResource\Pages;

use App\Filament\Resources\RunnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRunners extends ListRecords
{
    protected static string $resource = RunnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
