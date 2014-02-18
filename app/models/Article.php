<?php

class Article extends Eloquent
{
	protected $table = 'article';

	protected $fillable = array('title', 'user_id', 'channel_id', 'teaser', 'key', 'markdown', 'html', 'metadata');

	protected $guarded = array('id');

	public static $rules = array(
		'title' => 'required',
		'markdown' => 'required',
	);

	public static $sluggable = array(
		'build_from' => 'title',
		'save_to'    => 'slug',
		'on_update'  => true,
	);
    
    public function getMetadataAttribute($value)
    {
        return (array) json_decode($value, true);
    }
        
    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);
    }
    
	/**
	 * @return Channel
	 */
	public function channel()
	{
		return $this->belongsTo('Channel');
	}

	/**
	 * @return User
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}
}
