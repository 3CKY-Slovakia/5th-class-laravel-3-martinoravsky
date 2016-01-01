<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use DB;
class ArticlesController extends Controller
{

    /**
     * Middleware
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('articleOwner:', ['except' => ['index', 'show','unpublished','create','store','publish']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    public function unpublished(){
        return view('articles.unpublished');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $article = new Article();
        $article->title = $data['title'];
        $article->video = $data['video'];
        $article->content = $data['content'];
        $article->description = $data['description'];
        $article->user()->associate(Auth::user());
        $article->approved = 0;

        if($article->save()){
            return redirect('/')->with('message', 'Your article was successfully created.');
        }else{
            return redirect()->back()->with('message', 'Your article was not created. Please, try it again.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        return view('articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $article = Article::find($id);
        $article->title = $data['title'];
        $article->video = $data['video'];
        $article->content = $data['content'];
        $article->description = $data['description'];
        $article->user()->associate(Auth::user());

        if($article->save()){
            return redirect('/')->with('message', 'Your article was successfully created.');
        }else{
            return redirect()->back()->with('message', 'Your article was not created. Please, try it again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $article = Article::findOrFail($id);
        $article->delete();
        Mail::send('emails.article-deleted',['name'=> 'Martin'],function($message){
            $message->to(Auth::user()->email)->subject('Zmazanie clanku');
        });
        return redirect('/');
    }

    public function publish($id){
        $article = Article::findOrFail($id);
        $article->approved = 1;
        $article->save();

        $article_id = array('idecko' => $article->id);
        //dd($article_id);
        Mail::send('emails.article-creation',$article_id,function($message) use ($article_id){
            $message->to('martinoravskyjr@gmail.com')->subject('Vytvorenie clanku');
        });
        return redirect('article/unpublished');
    }

}
