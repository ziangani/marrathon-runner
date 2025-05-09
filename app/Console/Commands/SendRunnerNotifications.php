<?php

namespace App\Console\Commands;

use App\Models\Runner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendRunnerNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'runners:send-notifications {--limit=50 : Maximum number of runners to process} {--debug : Enable verbose output}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to runners who have paid but not been notified';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $limit = (int) $this->option('limit');
            $debug = $this->option('debug');
            
            // Get all paid runners who haven't been fully notified
            $query = Runner::where('status', 'PAID')
                ->where(function($query) {
                    $query->where('email_sent', false)
                        ->orWhere('sms_sent', false)
                        ->orWhere('whatsapp_sent', false);
                })
                ->orderBy('payment_date', 'asc')
                ->limit($limit);
            
            $runners = $query->get();
            
            if ($debug) {
                $this->info(count($runners) . ' runners found that need notifications (limit: ' . $limit . ')');
            } else {
                Log::info('SendRunnerNotifications: ' . count($runners) . ' runners found that need notifications');
            }

            $successCount = 0;
            $failCount = 0;

            foreach ($runners as $runner) {
                $this->info("Processing notifications for runner: {$runner->name} (ID: {$runner->id})");
                
                try {
                    $result = $runner->sendPaymentNotifications();
                    
                    if ($result) {
                        if ($debug) {
                            $this->info("Successfully sent notifications to {$runner->name}");
                        }
                        Log::info("Successfully sent notifications to runner ID: {$runner->id}, name: {$runner->name}");
                        $successCount++;
                    } else {
                        if ($debug) {
                            $this->warn("Partially sent notifications to {$runner->name}");
                        }
                        Log::warning("Partially sent notifications to runner ID: {$runner->id}, name: {$runner->name}");
                        $failCount++;
                    }
                } catch (\Exception $e) {
                    if ($debug) {
                        $this->error("Error sending notifications to {$runner->name}: " . $e->getMessage());
                    }
                    Log::error("Error sending notifications to runner ID: {$runner->id}, name: {$runner->name}. Error: " . $e->getMessage());
                    $failCount++;
                }
            }

            $message = "Notification process completed. Success: $successCount, Failed/Partial: $failCount";
            if ($debug) {
                $this->info($message);
            }
            Log::info("SendRunnerNotifications: " . $message);
            return 0;
        } catch (\Exception $e) {
            $message = "Command failed: " . $e->getMessage();
            if ($debug) {
                $this->error($message);
            }
            Log::error("SendRunnerNotifications command failed: " . $e->getMessage());
            return 1;
        }
    }
}