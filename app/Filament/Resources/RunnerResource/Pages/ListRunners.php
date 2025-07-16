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
            Actions\ExportAction::make()
                ->label('Export Runners')
                ->modifyQueryUsing(fn ($query) => $query->withFilters())
                ->exports([
                    Tables\Export\ExcelExport::make()
                        ->withColumns([
                            Tables\Columns\TextColumn::make('name'),
                            Tables\Columns\TextColumn::make('email'),
                            Tables\Columns\TextColumn::make('phone'),
                            Tables\Columns\TextColumn::make('age'),
                            Tables\Columns\TextColumn::make('gender'),
                            Tables\Columns\TextColumn::make('race_category'),
                            Tables\Columns\TextColumn::make('race_number'),
                            Tables\Columns\TextColumn::make('package')
                                ->formatStateUsing(fn (string $state): string => config("marathon.packages.{$state}.name") ?? $state),
                            Tables\Columns\TextColumn::make('package_amount')
                                ->money('ZMW'),
                            Tables\Columns\TextColumn::make('status'),
                            Tables\Columns\TextColumn::make('emergency_contact_name'),
                            Tables\Columns\TextColumn::make('emergency_contact_phone'),
                            Tables\Columns\TextColumn::make('t_shirt_size'),
                            Tables\Columns\TextColumn::make('health_condition'),
                            Tables\Columns\TextColumn::make('how_did_you_hear_about_us'),
                            Tables\Columns\TextColumn::make('exhibiting'),
                            Tables\Columns\TextColumn::make('reference'),
                            Tables\Columns\TextColumn::make('transaction_id'),
                            Tables\Columns\TextColumn::make('payment_provider'),
                            Tables\Columns\TextColumn::make('payment_reference'),
                            Tables\Columns\TextColumn::make('payment_date'),
                        ])
                        ->withFilterColumns([
                            'status',
                            'package',
                        ]),
                ]),
        ];
    }
}
