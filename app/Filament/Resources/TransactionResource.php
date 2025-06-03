<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transactions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionResource extends Resource
{
    protected static ?string $model = Transactions::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Payment Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Transaction Information')
                    ->schema([
                        Forms\Components\TextInput::make('reference')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('ZMW'),
                        Forms\Components\TextInput::make('currency')
                            ->required()
                            ->maxLength(10),
                        Forms\Components\Select::make('status')
                            ->options([
                                'PENDING' => 'Pending',
                                'PAID' => 'Paid',
                                'FAILED' => 'Failed',
                                'CANCELLED' => 'Cancelled',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('provider')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('provider_reference')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('metadata')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('provider_response')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('paid_at'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('ZMW')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'COMPLETE' => 'success',
                        'PENDING' => 'warning',
                        'FAILED' => 'danger',
                        'CANCELLED' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('provider')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provider_reference')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('paid_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'PENDING' => 'Pending',
                        'PAID' => 'Paid',
                        'FAILED' => 'Failed',
                        'CANCELLED' => 'Cancelled',
                    ]),
                Tables\Filters\SelectFilter::make('provider')
                    ->options([
                        'techpay' => 'TechPay',
                        'manual' => 'Manual',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
}
