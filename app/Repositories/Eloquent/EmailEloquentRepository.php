<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Models\Email;
use Knoters\Repositories\EmailRepository;

class EmailEloquentRepository extends AbstractEloquentRepository implements EmailRepository
{
    protected $model;

    function __construct(Email $model)
    {
        $this->model = $model;
    }

    /**
     * returns an Email record by a given email
     *
     * @param $email
     * @return static
     */
    public function findByEmail($email)
    {
        return Email::where('email', '=', $email)->first();
    }

    /**
     * Return an project collection item by an email
     *
     * @param $key
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProjectByEmailUrl($key)
    {
        return Email::with(array('projects' => function($query) use ($key) {
            $query->wherePivot('url', $key);
        }))->get();
    }

    /**
     * Gets an email record by its email,
     * If the record doesn't exist yet,
     * then we will add it to the database
     *
     * @param $email
     * @return mixed
     */
    public function addAndGetByEmail($email)
    {
        $record = $this->findByEmail($email);
        if (!$record) {
            $record = $this->store(array(
                'email' => $email
            ));
        }
        return $record;
    }
}