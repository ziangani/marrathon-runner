<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RunnerResource\Pages;
use App\Models\Runner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RunnerResource extends Resource
{
    protected static ?string $model = Runner::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Registration Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Forms\Components\Select::make('age')
                            ->options([
                                'below 20 years' => 'Below 20 years',
                                '21 to 30 years' => '21 to 30 years',
                                '31 to 40 years' => '31 to 40 years',
                                '41 to 50 years' => '41 to 50 years',
                                '51 years and above' => '51 years and above',
                            ])
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Emergency Contact')
                    ->schema([
                        Forms\Components\TextInput::make('emergency_contact_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emergency_contact_phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Race Details')
                    ->schema([
                        Forms\Components\Select::make('t_shirt_size')
                            ->options([
                                'XS' => 'XS',
                                'S' => 'S',
                                'M' => 'M',
                                'L' => 'L',
                                'XL' => 'XL',
                                'XXL' => 'XXL',
                                'XXXL' => 'XXXL',
                            ])
                            ->required(),
                        Forms\Components\Select::make('race_category')
                            ->options(function () {
                                $options = [];
                                foreach (config('marathon.categories') as $key => $category) {
                                    $options[$category['name']] = $category['name'];
                                }
                                return $options;
                            })
                            ->required(),
                        Forms\Components\Select::make('race_category_key')
                            ->options(function () {
                                $options = [];
                                foreach (config('marathon.categories') as $key => $category) {
                                    $options[$key] = $key;
                                }
                                return $options;
                            })
                            ->required(),
                        Forms\Components\Select::make('health_condition')
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('health_condition_specify')
                            ->maxLength(255)
                            ->visible(fn (Forms\Get $get) => $get('health_condition') === 'Yes'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Select::make('how_did_you_hear_about_us')
                            ->options([
                                'Facebook' => 'Facebook',
                                'Whatsapp' => 'Whatsapp',
                                'Email' => 'Email',
                                'LinkedIn' => 'LinkedIn',
                                'Website' => 'Website',
                                'A friend/workmate/ family member' => 'A friend/workmate/ family member',
                            ])
                            ->required(),
                        Forms\Components\Select::make('exhibiting')
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                                'Maybe' => 'Maybe',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Select::make('package')
                            ->options(function () {
                                $options = [];
                                foreach (config('marathon.packages') as $key => $package) {
                                    $options[$key] = $package['name'] . ' - K' . $package['price'];
                                }
                                return $options;
                            })
                            ->required(),
                        Forms\Components\TextInput::make('package_amount')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('reference')
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('race_number')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->options([
                                'PENDING' => 'Pending',
                                'PAID' => 'Paid',
                                'CANCELLED' => 'Cancelled',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('transaction_id')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('payment_provider')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('payment_reference')
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('payment_date'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Notification Status')
                    ->schema([
                        Forms\Components\Toggle::make('email_sent')
                            ->label('Email Sent'),
                        Forms\Components\Toggle::make('sms_sent')
                            ->label('SMS Sent'),
                        Forms\Components\Toggle::make('whatsapp_sent')
                            ->label('WhatsApp Sent'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('race_category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('race_number')
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
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'PENDING' => 'Pending',
                        'PAID' => 'Paid',
                        'CANCELLED' => 'Cancelled',
                    ]),
                Tables\Filters\SelectFilter::make('race_category')
                    ->options(function () {
                        $options = [];
                        foreach (config('marathon.categories') as $key => $category) {
                            $options[$category['name']] = $category['name'];
                        }
                        return $options;
                    }),
                Tables\Filters\SelectFilter::make('package')
                    ->options(function () {
                        $options = [];
                        foreach (config('marathon.packages') as $key => $package) {
                            $options[$key] = $package['name'];
                        }
                        return $options;
                    }),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListRunners::route('/'),
            'create' => Pages\CreateRunner::route('/create'),
            'view' => Pages\ViewRunner::route('/{record}'),
            'edit' => Pages\EditRunner::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
