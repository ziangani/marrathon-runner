<?php

namespace App\Filament\Resources\RunnerResource\Pages;

use App\Filament\Resources\RunnerResource;
use App\Models\Runner;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListRunners extends ListRecords
{
    protected static string $resource = RunnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('exportCsv')
                ->label('Export Runners CSV')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    return $this->exportToCsv();
                }),
        ];
    }

    /**
     * Export runners to CSV
     */
    protected function exportToCsv(): StreamedResponse
    {
        $runners = Runner::orderBy('created_at', 'desc')->get();
        
        $filename = 'runners-export-' . date('Y-m-d-H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($runners) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for proper UTF-8 encoding in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV Headers
            fputcsv($file, [
                'ID',
                'Full Name',
                'Email Address',
                'Phone Number',
                'Age',
                'Gender',
                'Race Category',
                'Race Number',
                'Package',
                'Package Amount (ZMW)',
                'Payment Status',
                'Emergency Contact Name',
                'Emergency Contact Phone',
                'T-Shirt Size',
                'Health Condition',
                'Health Condition Details',
                'How Did You Hear About Us',
                'Exhibiting',
                'Reference Number',
                'Transaction ID',
                'Payment Provider',
                'Payment Reference',
                'Payment Date',
                'Email Sent',
                'SMS Sent',
                'WhatsApp Sent',
                'Registration Date',
                'Last Updated',
            ]);

            // CSV Data
            foreach ($runners as $runner) {
                fputcsv($file, [
                    $runner->id,
                    $runner->name ?? '',
                    $runner->email ?? '',
                    $runner->phone ?? '',
                    $runner->age ?? '',
                    $runner->gender ?? '',
                    $runner->race_category ?? '',
                    $runner->race_number ?? '',
                    $runner->package ? (config("marathon.packages.{$runner->package}.name") ?? $runner->package) : '',
                    $runner->package_amount ? number_format($runner->package_amount, 2) : '',
                    $runner->status ?? '',
                    $runner->emergency_contact_name ?? '',
                    $runner->emergency_contact_phone ?? '',
                    $runner->t_shirt_size ?? '',
                    $runner->health_condition ?? '',
                    $runner->health_condition_specify ?? '',
                    $runner->how_did_you_hear_about_us ?? '',
                    $runner->exhibiting ? ucfirst($runner->exhibiting) : '',
                    $runner->reference ?? '',
                    $runner->transaction_id ?? '',
                    $runner->payment_provider ?? '',
                    $runner->payment_reference ?? '',
                    $runner->payment_date ? $runner->payment_date->format('Y-m-d H:i:s') : '',
                    $runner->email_sent ? 'Yes' : 'No',
                    $runner->sms_sent ? 'Yes' : 'No',
                    $runner->whatsapp_sent ? 'Yes' : 'No',
                    $runner->created_at ? $runner->created_at->format('Y-m-d H:i:s') : '',
                    $runner->updated_at ? $runner->updated_at->format('Y-m-d H:i:s') : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
