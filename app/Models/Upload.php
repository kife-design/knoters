<?php namespace Knoters\Models;

class Upload extends BaseModel
{

    /**
     * The table that represents the table
     *
     * @var string
     */

    protected $table = 'uploads';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
  //  protected $timestamps = true;

    /**
     * Indicates wether the item should be deleted from the database
     * or just get the deleted_at timestamp updated
     *
     * @var bool
     */
    protected $softDelete = true;

    /**
     * The emails that are used with this
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function emails()
    {
        return $this->belongsToMany('Knoters\Models\Email',
            'upload_emails')->withPivot(array('url', 'isHost'));
    }

    /**
     * The status of the Upload
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('Knoters\Models\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets()
    {
        return $this->hasMany('Knoters\Models\Asset');
    }

    /**
     * The snapshots that were created for this upload
     * (only in case of a video)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function snapshots()
    {
        return $this->hasMany('Knoters\Models\Asset')
            ->whereHas('parameters',
                function ($q) {
                    $q->where('name', '=', 'type')
                        ->where('value', '=', 'snapshot');
                }
            );
    }

    /**
     * The sequences that were created for this upload
     * (only in case of a video)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sequences()
    {
        return $this->hasMany('Knoters\Models\Asset')
            ->whereHas('parameters',
                function ($q) {
                    $q->where('name', '=', 'type')
                        ->where('value', '=', 'sequence');
                }
            );
    }

    /**
     * Gets all the traffic that has happened for this upload
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traffic()
    {
        return $this->hasMany('Knoters\Models\Traffic');
    }

    /**
     * Gets all the notes that were attached to this download
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('Knoters\Models\Note');
    }

    /**
     * Gets all the persons that are involved in the upload (and not the creator)
     * @return mixed
     */
    public function receivers()
    {
        return $this->belongsToMany('Knoters\Models\Email',
            'upload_emails')->withPivot(array('host'))->where('host', '=', 0);
    }

    /**
     * Gets the creator of the upload
     *
     * @return mixed
     */
    public function sender()
    {
        return $this->belongsToMany('Knoters\Models\Email',
            'upload_emails')->withPivot(array('host'))->where('host', '=', 1);
    }

    /**
     * Gets the uploadpath on the filesystem
     *
     * @return string
     */
    public function uploadPath()
    {
        return public_path() . '/uploads/' . $this->key;
    }

    /**
     * Gets the path file that is attached to this upload on the filesystem
     *
     * @return string
     */
    public function filePath()
    {
        return public_path() . '/uploads/' . $this->key . '/original/' . $this->name;
    }
}