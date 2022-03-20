<!-- <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail() {
        $to_name = 'THU HTET TUN';
        $to_email = 'thuhtettun.dev@gmail.com';
        $data = array('name'=>"HPM", "body" => "How r you?");
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('HPM Blog Newsletter');
        $message->from('htetphonemo26@gmail.com', 'no reply');
        });

        dd('Successfully sent!');
    }
} -->
