<?php

namespace App\Filament\Resources\RunnerResource\Pages;

use App\Filament\Resources\RunnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRunner extends EditRecord
{
    protected static string $resource = RunnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
