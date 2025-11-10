<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\CertificateResource;
use App\Http\Resources\NoteResource;
use App\Models\Certificate;
use App\Models\Note;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certs = Certificate::orderBy('id')->paginate(15);
        return CertificateResource::collection($certs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCertificateRequest $request)
    {
        $cert = Certificate::create($request->validated());
        return (new CertificateResource($cert))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        return new CertificateResource($certificate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /*
     *  get notes by cert
     */
    public function notes(Certificate $certificate)
    {
        $notes = Note::where('model_type', 'Certificate')
            ->where('model_id', $certificate->id)
            ->latest()
            ->paginate(15);

        return NoteResource::collection($notes);
    }

    /*
     * store note for cert
     */
    public function storeNote(StoreNoteRequest $request, Certificate $certificate)
    {
        $note = Note::create([
            'model_type' => 'Certificate',
            'model_id'   => $certificate->id,
            'note'       => $request->validated()['note'],
        ]);

        return (new NoteResource($note))
            ->response()
            ->setStatusCode(201);
    }


}
