<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Warning extends Mailable
{
    use Queueable, SerializesModels;

    public $params;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        //
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 透過 with 把參數指定給 view
        return $this->subject("就是愛已成功接收到您填寫的內容")
            ->view('admin.email.warning')
            ->with([
                'params' => $this->params,
            ]);
//        return $this->view('view.name');
    }
}
