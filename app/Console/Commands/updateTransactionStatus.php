<?php

namespace App\Console\Commands;

use App\Integrations\TechPay\HostedCheckOut;
use App\Models\PaymentProviders;
use App\Models\Runner;
use App\Models\Transactions;
use Illuminate\Console\Command;

class updateTransactionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-transaction-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $transactions = Transactions::where('status', 'PENDING')->where('provider_payment_reference', '!=', null)->orderBy('id', 'desc')->get();
        $this->info("Pending transactions found: " . count($transactions));
        foreach ($transactions as $transaction) {
            try {
                $this->info("Handling transaction: $transaction->reference");
                $this->info("Transaction token: $transaction->provider_payment_reference");
                $provider = $transaction->paymentProvider;
                $client = new HostedCheckOut($provider);
                $provider_response = $client->getTransactionStatus($transaction->provider_payment_reference);
                print_r($provider_response->data);
                if ($provider_response->data->status == 101) {
                    // Payment still pending (status code 101)
                    $transaction->status = 'PENDING';
                    $transaction->provider_external_reference = $provider_response->data->transactionReference;
                    $transaction->provider_status_description = $provider_response->data->message;
                    $transaction->provider_payment_confirmation_date = date('Y-m-d H:i:s');
                    $transaction->provider_payment_date = date('Y-m-d');
                    $transaction->save();
                    $this->info("Transaction {$transaction->reference} is still PENDING");

                } elseif ($provider_response->data->status == 100) {
                    // Payment successful (status code 100)
                    $transaction->status = 'COMPLETE';
                    $transaction->provider_external_reference = $provider_response->data->transactionReference;
                    $transaction->provider_status_description = $provider_response->data->message;
                    $transaction->provider_payment_confirmation_date = date('Y-m-d H:i:s');
                    $transaction->provider_payment_date = date('Y-m-d');
                    $transaction->save();
                    $this->info("Transaction {$transaction->reference} is now COMPLETE");
                    
                    // Mark the registration as paid if not already
                    $runner = Runner::where('reference', $transaction->reference)->first();
                    if ($runner && !$runner->hasPaid()) {
                        $runner->markAsPaid($transaction->id, 'techpay', $transaction->provider_payment_reference);
                        $this->info("Runner {$runner->reference} marked as PAID");
                    }
                } elseif (in_array($provider_response->data->status, [102, 103])) {
                    // Payment failed (status codes 102, 103)
                    $transaction->status = 'FAILED';
                    $transaction->provider_external_reference = $provider_response->data->transactionReference;
                    $transaction->provider_status_description = $provider_response->data->message;
                    $transaction->provider_payment_confirmation_date = date('Y-m-d H:i:s');
                    $transaction->provider_payment_date = date('Y-m-d');
                    $transaction->save();
                    $this->info("Transaction {$transaction->reference} has FAILED");
                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }
}
