<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQRCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qr:generate {nip}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QR code for the given NIP';

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
        $nip = $this->argument('nip');
        $qrCodePath = public_path('qrcodes/'.$nip.'.png');
        QrCode::format('png')->size(300)->generate($nip, $qrCodePath);

        $this->info('QR code generated successfully at: ' . $qrCodePath);
    }
}
