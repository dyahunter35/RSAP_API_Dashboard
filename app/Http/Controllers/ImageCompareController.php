<?php

namespace App\Http\Controllers;

use App\Models\ImageCompare;
use App\Models\Patient;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use robertogallea\LaravelPython\Services\LaravelPython;

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
            $source = $request->file('file')->path();
            $service = new LaravelPython();
            $result = $service->run(Storage::path('python/fingerprint.py'), [$source]);
            if ($result != "") {
                $image = ImageCompare::where('name', $result)->first();
                if ($image != null) {
                    $patient = Patient::find($image->patient_id);
                    if ($patient != null)
                        return [
                            "isSuccess" => true,
                            "message" => "Patient Available",
                            "data" => $patient,
                        ];
                }
            }
            return [
                "isSuccess" => false,
                "message" => "No Patient Available",
                "data" => null,
            ];
        } else {
            return [
                "isSuccess" => false,
                "message" => "No File Available",
                "data" => null,
            ];
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

    public function compare()
    {
        /*
        $source = sha1_file($request->file('file'));

            $images = ImageCompare::all();

            foreach ($images as $image) {

                $image_data = sha1(Storage::get($image->url));

                if ($source == $image_data) {
                    $patient = Patient::where("id",$image->patient_id)->get();
                    return [
                        "isSuccess"=>true,
                        "message"=>"Patient Founded Successfuly",
                        "data"=>$patient,
                    ];
                }
            }
            return [
                "isSuccess"=>false,
                "message"=>"Patient Not Found",
                "data"=>null,
            ];
            */
    }
}
