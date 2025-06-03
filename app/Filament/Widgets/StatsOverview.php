<?php

namespace App\Filament\Widgets;

use App\Models\Runner;
use App\Models\Transactions;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort =1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Registrations', Runner::count())
                ->description('Total number of runners registered')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Paid Registrations', Runner::where('status', 'PAID')->count())
                ->description('Number of paid registrations')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Pending Registrations', Runner::where('status', 'PENDING')->count())
                ->description('Number of pending registrations')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Total Revenue', 'K' . number_format(Transactions::where('status', 'COMPLETE')->sum('amount'), 2))
                ->description('Total revenue collected')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}
