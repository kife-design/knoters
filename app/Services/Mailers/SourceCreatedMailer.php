<?php namespace Knoters\Services\Mailers;


use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Mail\Mailer;
use Knoters\Services\Mailers\Mailer as AbstractMailer;

class SourceCreatedMailer extends AbstractMailer implements MailerContract
{

    /**
     * @var Encrypter
     */
    private $encrypter;
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(Mailer $mailer, Encrypter $encrypter)
    {
        parent::__construct($mailer);

        $this->encrypter = $encrypter;
        $this->mailer = $mailer;
    }

    /**
     * The view that will be mailed to the contact
     *
     * @return mixed
     */
    public function getView()
    {
        return $this->user->pivot->is_host ? 'emails.sourceCreated.host' : 'emails.sourceCreated.receiver';
    }

    /**
     * The data that is needed in the view
     *
     * @return mixed
     */
    public function getData()
    {
        $params = [
            'project' => $this->user->pivot->project_id,
            'user' => $this->user->id
        ];

        $userHash = $this->encrypter->encrypt($params);
        $url = env('BASE_URL', 'http://knoters.com') . '/editor/' . $userHash;


        return [
            'url' => $url
        ];
    }

    /**
     * The subject of the mail
     *
     * @return mixed
     */
    public function getSubject()
    {
        return $this->user->pivot->is_host ?
            'Your item has been successfully created' :
            'Someone created an item, go check it out!';
    }
}
