<?php

namespace App\Filament\Resources\RunnerResource\Pages;

use App\Filament\Resources\RunnerResource;
use App\Models\Runner;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
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
                ->form([
                    Forms\Components\Select::make('status')
                        ->label('Payment Status')
                        ->options([
                            'PENDING' => 'Pending',
                            'PAID' => 'Paid',
                            'CANCELLED' => 'Cancelled',
                            'FAILED' => 'Failed',
                        ])
                        ->required()
                        ->placeholder('Select payment status')
                        ->helperText('Select the payment status to filter runners'),
                    
                    Forms\Components\Select::make('package')
                        ->label('Package (Optional)')
                        ->options($this->getPackageOptions())
                        ->placeholder('All packages')
                        ->helperText('Leave empty to include all packages'),
                    
                    Forms\Components\DatePicker::make('date_from')
                        ->label('Registration Date From (Optional)')
                        ->placeholder('Select start date')
                        ->helperText('Filter runners registered from this date'),
                    
                    Forms\Components\DatePicker::make('date_to')
                        ->label('Registration Date To (Optional)')
                        ->placeholder('Select end date')
                        ->helperText('Filter runners registered up to this date'),
                ])
                ->action(function (array $data) {
                    return $this->exportToCsv($data);
                })
                ->modalHeading('Export Runners CSV')
                ->modalDescription('Select filters to export specific runners data')
                ->modalSubmitActionLabel('Export CSV')
                ->modalWidth('md'),
        ];
    }

    /**
     * Get package options for the filter
     */
    protected function getPackageOptions(): array
    {
        $packages = config('marathon.packages', []);
        $options = [];
        
        foreach ($packages as $key => $package) {
            $options[$key] = $package['name'] ?? ucfirst(str_replace('_', ' ', $key));
        }
        
        return $options;
    }

    /**
     * Export runners to CSV with filters
     */
    protected function exportToCsv(array $filters): StreamedResponse
    {
        // Build query with filters
        $query = Runner::query();
        
        // Status filter (mandatory)
        $query->where('status', $filters['status']);
        
        // Package filter (optional)
        if (!empty($filters['package'])) {
            $query->where('package', $filters['package']);
        }
        
        // Date range filters (optional)
        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        
        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }
        
        $runners = $query->orderBy('created_at', 'desc')->get();
        
        // Show notification about the export
        Notification::make()
            ->title('CSV Export Started')
            ->body("Exporting {$runners->count()} runners with status: {$filters['status']}")
            ->success()
            ->send();
        
        // Generate filename with filters
        $filename = $this->generateFilename($filters);
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($runners, $filters) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for proper UTF-8 encoding in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Add filter information as comments at the top
            fputcsv($file, ['# Export Filters Applied:']);
            fputcsv($file, ['# Status: ' . $filters['status']]);
            if (!empty($filters['package'])) {
                $packageName = config("marathon.packages.{$filters['package']}.name") ?? $filters['package'];
                fputcsv($file, ['# Package: ' . $packageName]);
            }
            if (!empty($filters['date_from'])) {
                fputcsv($file, ['# Date From: ' . $filters['date_from']]);
            }
            if (!empty($filters['date_to'])) {
                fputcsv($file, ['# Date To: ' . $filters['date_to']]);
            }
            fputcsv($file, ['# Export Date: ' . date('Y-m-d H:i:s')]);
            fputcsv($file, ['# Total Records: ' . $runners->count()]);
            fputcsv($file, []); // Empty row
            
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

    /**
     * Generate filename based on filters
     */
    protected function generateFilename(array $filters): string
    {
        $parts = ['runners', 'export'];
        
        // Add status to filename
        $parts[] = strtolower($filters['status']);
        
        // Add package to filename if specified
        if (!empty($filters['package'])) {
            $parts[] = strtolower(str_replace('_', '-', $filters['package']));
        }
        
        // Add date range if specified
        if (!empty($filters['date_from']) || !empty($filters['date_to'])) {
            $dateRange = [];
            if (!empty($filters['date_from'])) {
                $dateRange[] = 'from-' . $filters['date_from'];
            }
            if (!empty($filters['date_to'])) {
                $dateRange[] = 'to-' . $filters['date_to'];
            }
            $parts[] = implode('-', $dateRange);
        }
        
        // Add timestamp
        $parts[] = date('Y-m-d-H-i-s');
        
        return implode('-', $parts) . '.csv';
    }
}
