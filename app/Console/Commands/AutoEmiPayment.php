<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoEmiPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loan:emi-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to do auto payment of loan EMIs';

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
            $this->info('Execution started..!');
            $currentDate = date('Y-m-d');
            $emis = \App\Models\Emi::whereDate('payment_date', '=', $currentDate)->where('is_paid', 0)->get();
            $totalEmi = $emis->count();
            $this->info('Total no of payment: '. $totalEmi);
            $i = 0;
            foreach($emis as $emi) {
                $emi->is_paid = 1;
                $emi->save();
                $i++;
            }
            if ($totalEmi)
                $this->info('Payment successful..!');
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
        
    }
}
