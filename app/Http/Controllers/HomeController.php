<?php

namespace App\Http\Controllers;

use App\PostCategories;
use App\Posts;
use Illuminate\Http\Request;
use App\GeneralSettings;
use App\ContactSettings;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        // Schema::create('sessions', function ($table) {
        //     $table->string('id')->unique();
        //     $table->unsignedInteger('user_id')->nullable();
        //     $table->string('ip_address', 45)->nullable();
        //     $table->text('user_agent')->nullable();
        //     $table->text('payload');
        //     $table->integer('last_activity');
        // });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $posts = Posts::orderBy('id', 'DESC')->paginate(3);
        $post_cate = PostCategories::all();
        $general = GeneralSettings::first();
        $contact = ContactSettings::first();
        $new_post = Posts::limit(2)->orderBy('id', 'DESC')->get();
        $recent_post = Posts::limit(5)->orderBy('id', 'DESC')->inRandomOrder()->get();

        $data = array('posts' => $posts, 'post_cate' => $post_cate, 'general' => $general, 'contact' => $contact, 'new_posts' => $new_post, 'recent_post' => $recent_post);
        return view('home', $data);
    }
}