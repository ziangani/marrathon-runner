<?php

namespace App\Filament\Resources\RunnerResource\Pages;

use App\Filament\Resources\RunnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRunner extends ViewRecord
{
    protected static string $resource = RunnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
