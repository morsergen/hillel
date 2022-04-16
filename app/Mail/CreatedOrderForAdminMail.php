<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatedOrderForAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array|Collection|User[]|\Illuminate\Database\Eloquent\Builder[]
     */
    private array|Collection $admins;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private Order $order)
    {
        $this->subject = 'New order in shop';
        $this->admins = User::whereRoleId(Role::getAdminRole()->id)->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->admins)
            ->markdown('email.created_order_admin')
            ->with(['order' => $this->order]);
    }
}
