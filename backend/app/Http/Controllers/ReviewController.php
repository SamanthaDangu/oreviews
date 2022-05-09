<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * /reviews
     * GET
     */
    public function list()
    {
        // Get all items
        $list = Review::all();

        // Return JSON of this list
        return $this->sendJsonResponse($list, 200);
    }

    /**
     * /reviews
     * POST
     */
    public function add(Request $request)
    {
        // Retrieve data
        $title = $request->input('title');
        $text = $request->input('text', '');
        $author = $request->input('author', '');
        $publication_date = $request->input('publication_date', '');
        $display_note = $request->input('display_note', 0);
        $gameplay_note = $request->input('gameplay_note', 0);
        $scenario_note = $request->input('scenario_note', 0);
        $lifetime_note = $request->input('lifetime_note', 0);
        $videogame_id = $request->input('videogame_id', 0);
        $platform_id = $request->input('platform_id', 0);
        $status = $request->input('status', 1);

        // Create a new Model
        $item = new Review();
        $item->title = $title;
        $item->text = $text;
        $item->author = $author;
        $item->publication_date = $publication_date;
        $item->display_note = $display_note;
        $item->gameplay_note = $gameplay_note;
        $item->scenario_note = $scenario_note;
        $item->lifetime_note = $lifetime_note;
        $item->videogame_id = $videogame_id;
        $item->platform_id = $platform_id;
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
     * /reviews/[id]
     * GET
     */
    public function read($id)
    {
        // Get item or send 404 response if not
        $item = Review::find($id);

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
     * /reviews[id]
     * PUT
     */
    public function update(Request $request, $id)
    {
        // Retrieve data
        $title = $request->input('title');
        $text = $request->input('text', '');
        $author = $request->input('author', '');
        $publication_date = $request->input('publication_date', '');
        $display_note = $request->input('display_note', 0);
        $gameplay_note = $request->input('gameplay_note', 0);
        $scenario_note = $request->input('scenario_note', 0);
        $lifetime_note = $request->input('lifetime_note', 0);
        $videogame_id = $request->input('videogame_id', 0);
        $platform_id = $request->input('platform_id', 0);
        $status = $request->input('status', 1);

        // Get item or send 404 response if not
        $item = Review::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            $item->title = $title;
            $item->text = $text;
            $item->author = $author;
            $item->publication_date = $publication_date;
            $item->display_note = $display_note;
            $item->gameplay_note = $gameplay_note;
            $item->scenario_note = $scenario_note;
            $item->lifetime_note = $lifetime_note;
            $item->videogame_id = $videogame_id;
            $item->platform_id = $platform_id;
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
     * /reviews/[id]
     * DELETE
     */
    public function delete($id)
    {
        // Get item or send 404 response if not
        $item = Review::find($id);

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
}
