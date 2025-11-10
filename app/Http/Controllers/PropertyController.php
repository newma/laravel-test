<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\CertificateResource;
use App\Http\Resources\NoteResource;
use App\Models\Property;
use App\Models\Note;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     * added filter GET /property?min_certificates=5
     */
    public function index()
    {
//        $props = Property::withCount('certificates')
//            ->orderBy('id')
//            ->paginate(15);
//
//        return PropertyResource::collection($props);

        //should add validation
        $min = request()->integer('min_certificates'); // null if not provided

        $query = Property::withCount('certificates');

        // Apply filter only if a number is passed
        if (!is_null($min)) {
            $query->having('certificates_count', '>=', $min);
        }

        return PropertyResource::collection(
            $query->paginate(20)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $property = Property::create($request->validated());
        return (new PropertyResource($property))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->loadCount('certificates');
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $property->update($request->validated());
        return new PropertyResource($property->fresh()->loadCount('certificates'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }

    /*
     * get certs by property id
     */
    public function certificates(Property $property)
    {
        $certs = $property->certificates()->orderBy('id')->paginate(15);
        return CertificateResource::collection($certs);
    }

    /*
     * get notes by property id
     */
    public function notes(Property $property)
    {
        $notes = Note::where('model_type', 'Property')
            ->where('model_id', $property->id)
            ->latest()
            ->paginate(15);

        return NoteResource::collection($notes);
    }

    /*
     * save/store property notes
     */
    public function storeNote(StoreNoteRequest $request, Property $property)
    {
        $note = Note::create([
            'model_type' => 'Property',
            'model_id'   => $property->id,
            'note'       => $request->validated()['note'],
        ]);

        return (new NoteResource($note))
            ->response()
            ->setStatusCode(201);
    }
}
