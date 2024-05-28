<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('frontend::index');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function aboutUs()
    {
        return view('frontend::pages/about-us');
    }


     /**
     * Show the specified resource.
     * @return Renderable
     */
    public function news()
    {
        return view('frontend::pages/news');
    }


    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function resource()
    {
        return view('frontend::pages/resource');
    }


    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function achievement()
    {
        return view('frontend::pages/achievement');
    }


     /**
     * Show the specified resource.
     * @return Renderable
     */
    public function caseStory()
    {
        return view('frontend::pages/case-story');
    }


     /**
     * Show the specified resource.
     * @return Renderable
     */
    public function event()
    {
        return view('frontend::pages/events');
    }


     /**
     * Show the specified resource.
     * @return Renderable
     */
    public function contact()
    {
        return view('frontend::pages/contact');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('frontend::show');
    }


}
