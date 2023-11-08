<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class EmailController extends Controller
{
    public function sendEmails()
{
    $emails = [
        'tochuks.chris@gmail.com',
        'ugbeshefaith@gmail.com',
        'improv@gmail.com',
        'mleary@aol.com',
        'chaki@outlook.com',
        'keiser@hotmail.com',
        'pereinar@me.com',
        'cameron@outlook.com',
        'heroine@sbcglobal.net',
        'ylchang@outlook.com',
        'purvis@sbcglobal.net',
        'danny@msn.com'
    ];

    // Directory to store the PNG files
    $storagePath = public_path('qr_codes');

    if (!File::isDirectory($storagePath)) {
        File::makeDirectory($storagePath, 0755, true);
    }

    foreach ($emails as $email) {
        // Generate the QR code using the Google Charts API
        $url = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=" . urlencode($email);
        $response = Http::get($url);

        if ($response->ok()) {
            $qrCode = $response->body();

            // Define the file name: I decided to use the email as file name to make it readable
            $fileName = $email . '.png';

            // Then I proceed to save the PNG file to the public/qr_codes directory
            file_put_contents($storagePath . '/' . $fileName, $qrCode);

            // Send the email with the PNG file as an attachment to the mailer
            $data = ['email' => $email, 'qrCode' => $fileName];
            Mail::to($email)->send(new \App\Mail\EmailWithQRCode($data));
        } else {
            return "Error: An error occured";
        }
    }

    return "Emails sent with QR Codes and PNG files saved in public/qr_codes directory.";
}
}
