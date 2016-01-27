<?php

namespace Knoters\Services\Mailers;


interface MailerContract
{

    /**
     * The view that will be mailed to the contact
     *
     * @return mixed
     */
    public function getView();

    /**
     * The data that is needed in the view
     *
     * @return mixed
     */
    public function getData();

    /**
     * The subject of the mail
     *
     * @return mixed
     */
    public function getSubject();
}