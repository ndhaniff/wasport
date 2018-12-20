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
    public $addons;

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
        $oid = $order->oid;

        $addons = DB::table('order_addons')
          ->join('addons', 'order_addons.addon_id', '=', 'addons.aid')
          ->where('order_id', '=', $oid)
          ->all();

        $addon = '-';

        foreach($addons as $addon) {
          $addon .= $addon->add_en. '(Size ' .$addon->a_type. ')<br>';
        }

        return $this->view('email.sendConfirmEmail')->with([
                        'addon' => $addon,
                    ]);
    }
}
