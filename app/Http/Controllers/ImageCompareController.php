<?php

namespace App\Http\Controllers;

use App\Models\ImageCompare;
use App\Models\Patient;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageCompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patientsfiles.compare');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_file($request->file('file'))) {

            $source = sha1_file($request->file('file'));

            //echo $source;

            $images = ImageCompare::all();

            foreach ($images as $image) {
                //$image_data = sha1_file(($image->url)));
                $image_data = sha1(Storage::get($image->url));

                //echo $image_data . "<br/>";

                if ($source == $image_data) {
                    return Patient::where("id",$image->patient_id)->get();
                }
            }
            return 'no match';
        } else {
            return ' no file';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageCompare  $imageCompare
     * @return \Illuminate\Http\Response
     */
    public function show(ImageCompare $imageCompare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageCompare  $imageCompare
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageCompare $imageCompare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageCompare  $imageCompare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageCompare $imageCompare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageCompare  $imageCompare
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageCompare $imageCompare)
    {
        //
    }
}
