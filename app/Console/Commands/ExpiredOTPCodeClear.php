<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\OTPCode;
use Illuminate\Console\Command;

class ExpiredOTPCodeClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired-otp-code:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To clean expired OTP codes.';

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
        $otps = OTPCode::get();
        $number_of_otps = $otps->count();
        $now = Carbon::now()->timestamp;

        if ($number_of_otps <= 0) {
            $this->info('There is no expired OTP code.');
            return 0;
        }

        foreach ($otps as $otp) {
            $otp->select('expire_at')->where('expire_at', '<', $now)->delete();
        }

        if ($number_of_otps == 1) {
            $this->info($number_of_otps . ' expired OTP code has been cleaned.');
        } else if ($number_of_otps > 1) {
            $this->info($number_of_otps . ' expired OTP codes have been cleaned.');
        }

        return 0;
    }
}
