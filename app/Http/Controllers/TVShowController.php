<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\TVShow;
class TVShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $TVShow =  DB::table('t_v_shows')->get();
         return view('welcome', ['tvshow'=>$TVShow]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

        $TVShow = new TVShow([
          "season" => $request->get('season'),
          "episode"=> $request->get('episode'),
          "quote"=> $request->get('quote')



        ]);
        $TVShow->save();
        return "successfullt create the record!";}
        catch(Exception $e ){
            echo $e;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   try{
            $TVShow = TVShow::find($request->get('id'));
            $TVShow->season = $request->get('season');
            $TVShow->episode = $request->get('episode');
            $TVShow->quote =$request->get('quote');
            $TVShow->save();
            return "successfullt update the record!";}
        catch(Exception $e ){
                echo $e;
            }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $id = $request->get('id');
        TVShow::where('id',$id)->delete();
        return "successfullt delete the record!";
    }


    
}
