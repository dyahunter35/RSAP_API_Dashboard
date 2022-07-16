<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientsFilesRequest;
use App\Http\Requests\UpdatePatientsFilesRequest;
use App\Models\Patient;
use App\Models\PatientsFiles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Prophecy\Util\StringUtil;

class PatientsFilesController extends Controller
{

    public function index()
    {
        //return PatientsFiles::all();
        return redirect()->back();
        //return view('patientsfiles.index');
    }

    public function create(Request $request)
    {
        $patient = Patient::find($request->input('p'));
        return view("patientsfiles.create", compact('patient'));
    }

    public function store(StorePatientsFilesRequest $request)
    {
        $exention = $request->file->extension();
        $fileName = $request->name . '.' . $exention;
        $fileName = preg_replace('/\s+/', '_', $fileName);

        $fileNameWithID = $request->patient_id . '_' . $fileName;

        $type = (in_array($request->file->extension(), ['png', 'jpg', 'jpeg'])) ? 'image' : 'doc';
        $size = $request->file->getSize();

        $path = $request->file('file')->storeAs('file/' . $request->patient_id, $fileNameWithID);

        $file = PatientsFiles::create(
            [
                'patient_id' => $request->patient_id,
                'name' => $fileName,
                'check_date' => $request->check_date,
                'size' => $size,
                'type' => $type,
                'exention' => $exention,
                'url' => $path
            ]
        );

        if ($file) {
            return redirect()->route('patients.show', $request->patient_id)->with('success', 'File ( ' . $fileName . ' ) Uploaded successfully');
        } else
            return redirect()->route('patients.show', $request->patient_id)->with('failed', 'Failed Upload File');
    }

    public function show($id)
    {
        return redirect()->back();

        //return $files =  PatientsFiles::pFile($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientsFiles  $patientsFiles
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientsFiles $patientsFiles)
    {
        return redirect()->back();
    }


    public function update(UpdatePatientsFilesRequest $request, PatientsFiles $patientsFiles)
    {
        return redirect()->back();
    }


    public function destroy($id)
    {
        $file = PatientsFiles::find($id);
        $pID = $file->patient_id;

        if ($file->delete()) {
            return redirect()->route('patients.show', $pID)->with('success', 'File Delete successfully');
        } else
            return redirect()->route('patients.show', $pID)->with('error', 'File Delete successfully');
    }
}
