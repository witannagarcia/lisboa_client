<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\Location as LocationResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

use App\Models\Location;

class LocationController extends BaseController
{

    public function index(Request $request)
    {
        $locations = $request->user()->locations;
        return $this->sendResponse(LocationResource::collection($locations), 'Locations retrieved successfully.');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            'address' => 'required',
            "ext_num" => "required",
            "suburb" => "required",
            "city" => "required",
            "state" => "required",
            "coordinates" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);       
        }

        $location = new Location();
        $location->restaurant_id = env('RESTAURANT_ID');
        $location->user_id = $request->user()->id;
        $location->name = $request->name;
        $location->address = $request->address;
        $location->ext_num = $request->ext_num;
        $location->suburb = $request->suburb;
        $location->city = $request->city;
        $location->state = $request->state;
        $location->coordinates = $request->coordinates;
        $location->save();

        return $this->sendResponse(new LocationResource($location), 'Locations stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = new LocationResource(Location::findOrFail($id));
        return $this->sendResponse($location, 'Location retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            'address' => 'required',
            "ext_num" => "required",
            "suburb" => "required",
            "city" => "required",
            "state" => "required",
            "coordinates" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);       
        }

        $location = Location::findOrFail($id);
        $location->name = $request->name;
        $location->address = $request->address;
        $location->ext_num = $request->ext_num;
        $location->suburb = $request->suburb;
        $location->city = $request->city;
        $location->state = $request->state;
        $location->coordinates = $request->coordinates;
        $location->save();

        return $this->sendResponse(new LocationResource($location), 'Locations updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return $this->sendResponse([], 'Locations deleted successfully.');
    }
}
