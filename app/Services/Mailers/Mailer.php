<?php

namespace Knoters\Services\Mailers;


class Mailer
{
    protected $user;
    /**
     * @var
     */
    private $mailer;


    public function __construct(\Illuminate\Contracts\Mail\Mailer $mailer)
    {

        $this->mailer = $mailer;
    }

    /**
     * Mail a message(view)
     * @param $user
     */
    public function mail($user)
    {
        $this->user = $user;
        $this->mailer->send($this->getView(), $this->getData(), function ($m) use ($user) {
            $m->to($user->email)->subject($this->getSubject());
        });
    }
}
