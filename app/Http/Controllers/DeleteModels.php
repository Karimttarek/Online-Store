<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteModels extends Controller
{
    //

    public function index()
    {

        //setting/DB/all/refresh/delete

        /**
         * Easily link to delete models
         * fill models you need to delete
         * at @param  array  $models
         * visit http://127.0.0.1:8000/setting/DB/all/delete to run the script
         *
         */
        $models = [
            'App\Models\Brand',
            'App\Models\Subcategory',
            'App\Models\Category',
            'App\Models\Product',
        ];


        foreach ($models as $model)
            $model::truncate();

        return redirect('/');
    }
}
