<?php

class ArticleRepository
{
	/**
	 * @return Illuminate\Database\query\Builder;
	 */
	public static function buildQueryFromInput()
	{
		$q = Article::query();
		$q->take(100);

		foreach(Input::all() as $key => $value) {

			switch($key) {

				case 'with':

					$with = explode(',', $value);

					foreach($with as $relation) {

						$relation = trim($relation);
						$allowed = array('channel', 'user');
						if(!in_array($relation, $allowed)) {
							continue;
						}

						$q->with($relation);
					}
					break;

				case 'q':
				case 'search':
					$parts = explode(' ', $value);

					foreach($parts as $part) {

						$part = trim($part);
						$prefix = substr($part, 0, 1);

						switch($prefix) {

							// Search for a user
							case '@':
								$username = substr($part, 1);
								$q->orWhereHas('user', function($q) use($username) {
									$q->where('username', $username);
								});
								break;

							// Search for a tag
							case '#':
								break;

							// Search for a channel
							case '$':
								$channel = substr($part, 1);
								$q->orWhereHas('channel', function($q) use($channel) {
									$q->where('slug', $channel);
								});
								break;

							// Global search terms
							default:
                                $q->where(function($q) use($part) {
                                    $q->where('title', 'LIKE', "%$part%")
                                      ->orWhere('markdown', 'LIKE', "%$part%");
                                });

						}

					}

					break;

				case 'offset':
					$q->skip($value);
					break;

				case 'limit':
					$q->take($value);
					break;

			}
		}

		return $q;
	}

	/**
	 * @param $id
	 * @return Article
	 */
	public static function findById($id)
	{
		return static::buildQueryFromInput()->whereId($id)->firstOrFail();
	}

	/**
	 * @param $slug
	 * @return Article
	 */
	public static function findBySlug($slug)
	{
		return static::buildQueryFromInput()->whereSlug($slug)->firstOrFail();
	}

	/**
	 * @param $key
	 * @return Article
	 */
	public static function findByKey($key)
	{
		return Article::query()->whereKey($key)->first();
	}

}