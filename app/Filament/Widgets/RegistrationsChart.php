<?php

namespace App\Filament\Widgets;

use App\Models\Runner;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RegistrationsChart extends ChartWidget
{
    protected static ?string $heading = 'Registrations';

    protected function getData(): array
    {
        $data = $this->getRegistrationsPerDay();

        return [
            'datasets' => [
                [
                    'label' => 'Registrations',
                    'data' => $data['registrations'],
                    'backgroundColor' => '#33A9E0',
                    'borderColor' => '#33A9E0',
                ],
                [
                    'label' => 'Paid Registrations',
                    'data' => $data['paid'],
                    'backgroundColor' => '#28a745',
                    'borderColor' => '#28a745',
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getRegistrationsPerDay(): array
    {
        $days = 14; // Last 14 days
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        
        $registrations = [];
        $paidRegistrations = [];
        $labels = [];
        
        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            $nextDate = $date->copy()->addDay();
            
            $count = Runner::whereBetween('created_at', [$date, $nextDate])->count();
            $paidCount = Runner::whereBetween('created_at', [$date, $nextDate])
                ->where('status', 'PAID')
                ->count();
            
            $registrations[] = $count;
            $paidRegistrations[] = $paidCount;
            $labels[] = $date->format('M d');
        }
        
        return [
            'registrations' => $registrations,
            'paid' => $paidRegistrations,
            'labels' => $labels,
        ];
    }
}
