<?php

namespace App\Filament\Widgets;

use App\Models\Runner;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestRegistrations extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Runner::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('race_category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package')
                    ->formatStateUsing(fn (string $state): string => config("marathon.packages.{$state}.name") ?? $state),
                Tables\Columns\TextColumn::make('package_amount')
                    ->money('ZMW')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'PAID' => 'success',
                        'PENDING' => 'warning',
                        'CANCELLED' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([

            ]);
    }
}
