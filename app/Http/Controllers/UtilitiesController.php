<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper;
use App\Configuration;

class UtilitiesController extends Controller
{

    public function setPostCategories(Request $request) {

        $categories = $request->input('value');

        $values = [];
        foreach (explode(',', $categories) as $c) {
            $values[] = trim($c);
        };
        $config = Configuration::firstOrNew([
            'key' => 'post-categories'
        ]);

        $config->value = $values;
        $config->save();

        return redirect()->back()->with([
            'message' => [
                'text' => 'Categories updated',
                'type' => 'success',
            ]
        ]);
    }
}
