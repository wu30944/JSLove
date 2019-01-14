<?php

namespace App\Listeners;

use App\Events\ContactUsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

//Send E-Mail
use App\Mail\Warning;
use Illuminate\Support\Facades\Mail;


class ContactUsListener
{

    public $request;
    public $ContactUs;

    /**
     * ContactUsListener constructor.
     */
    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    /**
     * Handle the event.
     * @param ContactUsEvent $Event
     */
    public function handle(ContactUsEvent $Event)
    {
        //
        $this->ContactUs = $Event->GetContactUs();
        $this->send();

    }


    public function send()
    {

        // 收件者務必使用 collect 指定二維陣列，每個項目務必包含 "name", "email"
        $to = collect([
            ['name' => $this->ContactUs->name, 'email' => $this->ContactUs->email]
        ]);

        // 提供給模板的參數
        $params = [
            'say' => $this->ContactUs->name.'您好，我們已收到您傳送的訊息。'
        ];

        Mail::to($to)->send(new Warning($params));
    }
}
