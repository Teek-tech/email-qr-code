<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQRCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:qrcodes';

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
        $emails = [
            'tochukwuodeme@gmail.com',
            'tochuks.chris@gmail.com',
            'tochukwuodoeme@yahoo.com',
            'iamtochukwu.dev@gmail.com'
        ];
        foreach ($emails as $email) {
            $qrCode = QrCode::format('png')->generate($email);
            file_put_contents(public_path('qr_codes/' . $email . '.png'), $qrCode);
        }
    }
}
