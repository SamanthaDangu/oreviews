<?php

namespace App\Http\Controllers;

use App\Models\Videogame;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    /**
     * /videogames
     * GET
     */
    public function list()
    {
        // Get all items
        $list = Videogame::all();

        // Return JSON of this list
        return $this->sendJsonResponse($list, 200);
    }

    /**
     * /videogames
     * POST
     */
    public function add(Request $request)
    {
        // Retrieve data
        $name = $request->input('name');
        $editor = $request->input('editor', '');
        $status = $request->input('status', 1);

        // Create a new Model
        $item = new Videogame();
        $item->name = $name;
        $item->editor = $editor;
        $item->status = $status;

        // Save this Model
        if ($item->save()) {
            // Return JSON of this list + 201 Created
            return $this->sendJsonResponse($item, 201);
        } else {// If failed to save
            // Display a 500 error (internal server error)
            return $this->sendEmptyResponse(500);
        }
    }

    /**
     * /videogames/[id]
     * GET
     */
    public function read($id)
    {
        // Get item or send 404 response if not
        $item = Videogame::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            // Return JSON of this list
            return $this->sendJsonResponse($item, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return $this->sendEmptyResponse(404);
        }
    }

    /**
     * /videogames[id]
     * PUT
     */
    public function update(Request $request, $id)
    {
        // Retrieve data
        $name = $request->input('name');
        $editor = $request->input('editor', '');
        $status = $request->input('status', 1);

        // Get item or send 404 response if not
        $item = Videogame::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            $item->name = $name;
            $item->editor = $editor;
            $item->status = $status;

            // Save this Model
            if ($item->save()) {
                // Return JSON of this list
                return $this->sendJsonResponse($item, 200);
            } else {// If failed to save
                // Display a 500 error (internal server error)
                return $this->sendEmptyResponse(500);
            }
        } else { // Sinon
            // HTTP status code 404 Not Found
            return $this->sendEmptyResponse(404);
        }
    }

    /**
     * /videogames/[id]
     * DELETE
     */
    public function delete($id)
    {
        // Get item or send 404 response if not
        $item = Videogame::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            // try to delete
            if ($item->delete()) {
                // Return no content + 204
                return $this->sendEmptyResponse(204);
            } else {// If failed to delete
                // Display a 500 error (internal server error)
                return $this->sendEmptyResponse(500);
            }
        } else { // Sinon
            // HTTP status code 404 Not Found
            return $this->sendEmptyResponse(404);
        }
    }

    /**
     * /videogames/[id]/reviews
     * GET
     */
    public function getReviews($id)
    {
        // Get item or send 404 response if not
        $item = Videogame::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            // Retrieve all related Reviews (thanks to Relationships)
            $reviews = $item->reviews->load(['videogame', 'platform']);

            // Return JSON of this list
            return $this->sendJsonResponse($reviews, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return $this->sendEmptyResponse(404);
        }
    }
}
