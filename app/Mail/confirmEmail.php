<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Order;
use App\Model\OrderAddon;
use App\Model\Addon;

class confirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $orderaddon;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $addons = DB::table('order_addons')
          ->join('addons', 'order_addons.addon_id', '=', 'addons.aid')
          ->where('order_id', '=', $oid)
          ->all();

        return $this->view('email.sendConfirmEmail')->with([
                        'addons' => $addons,
                    ]);
    }
}