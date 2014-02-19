<?php

namespace Api;

use BaseController, Validator, Response, Article, ArticleRepository, View, Input;

class ArticleController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = ArticleRepository::buildQueryFromInput()->get()->toArray();                
        return Response::json(compact('articles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(Input::get('batch')) {
            
            foreach(Input::get('batch') as $data) {
                
                Input::replace($data);
                $responses[] = $this->store()->getData();
            }
            
            return Response::json(array(
                'message' => 'Articles stored',
                'result' => $responses,
            ));
            
        }


		try {
			$v = Validator::make(Input::all(), Article::$rules);

			if($v->fails()) {
				return Response::json(array(
					'message' => 'Input contains errors',
					'errors' => $v->messages(),
				));
			}

			// First try to find an existing article with the same key. If an article is found,
			// then we can update this article.
			if(Input::get('key') && ($article = ArticleRepository::findByKey(Input::get('key')))) {
				return $this->update($article);
			}


			// This is a new article. Save it with the validated input data
			$article = Article::create(Input::all());

			return Response::json(array(
				'message' => 'Article stored',
				'article' => $article->toArray(),
			));

		}
		catch(\Exception $e) {
			return Response::json(array(
				'message' => $e->getMessage())
			);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Article $article)
	{
        return Response::json($article->toArray());
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Article $article)
	{
		$v = Validator::make(Input::all(), Article::$rules);

		if($v->fails()) {
			return Response::json(array(
				'message' => 'Input contains errors',
				'errors' => $v->messages(),
			));
		}

		$article->update(Input::all());

		return Response::json(array(
			'message' => 'Article updated',
			'article' => $article->toArray(),
		));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Article $article)
	{
		$article->delete();

		return Response::json(array('message' => 'Article deleted'));
	}

}
