<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class SearchController extends Controller
{
    /**
     * [search description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
      //define error message
      $error = ['error' => 'No results found, please try with different keywords.'];

      //detect if user entered a keywords
      if($request->has('q'))
      {
        // Using the Laravel Scout syntax to search the products table.
        $posts = Product::search($request->get('q'))->get();

        // If there are results return them, if none, return the error message.
        return $posts->count() ? $posts : $error;
      }

      return $error;

    }
}
