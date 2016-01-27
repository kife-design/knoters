<?php

namespace Knoters\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Knoters\Events\SourceWasCreated;
use Knoters\Services\Mailers\Mailer;
use Knoters\Services\Mailers\SourceCreatedMailer;

class NotifyUsers
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param SourceCreatedMailer $mailer
     */
    public function __construct(SourceCreatedMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param SourceWasCreated $event
     * @return string
     */
    public function handle(SourceWasCreated $event)
    {
        $project = $event->project;

        $this->mailUsers($this->getUsers($project));

        return 'ok';
    }

    /**
     * Mail all the users
     *
     * @param $users
     */
    private function mailUsers($users)
    {
        foreach($users as $user) {
            $this->mailer->mail($user);
        }
    }

    /**
     * Get all the users from a project
     *
     * @param $project
     * @return mixed
     */
    protected function getUsers($project)
    {
        return $project->users;
    }
}
