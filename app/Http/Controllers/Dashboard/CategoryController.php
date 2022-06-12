<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crud;
use App\Http\Traits\UploadImageTrait;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\DataTables\CategoryDataTable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    protected $table = 'categories';
    protected $model = 'App\Models\Category';
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('dashboard.category.category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:categories'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            DB::beginTransaction();
            $file_name = $this->uploadImage($request->image, 'image/categories');
            DB::table('categories')->insert([
                'code' => str_replace(' ' ,'-' ,$request->name),
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'image' => $file_name
            ]);

            DB::commit();
            return redirect()->route('category.index')->with('status', 'New Category Added');
        }catch (Throwable $e){
            DB::rollBack();
            report($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Crud::getDataWhereId($this->table , ['id','name' , 'name_ar', 'image'] , $id);
        return view('dashboard.category.edit' , compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        DB::beginTransaction();

        Crud::update($this->model , $id , ['name' => '' , 'name_ar' => '']);

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:categories'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {

            Crud::update($this->model , $id ,$request->except('_token'));

            DB::commit();
            $this->deleteImage($request->image, 'image/categories');
            $this->uploadImage($request->image, 'image/categories'); // save image
            return redirect()->route('category.index')->with('status', 'Updated seccessfuly');
        }catch (Throwable $e){
            DB::rollBack();
            report($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public  function destroy(){
        Crud::multiUpdate($this->model ,\request('item') , ['deleted_at' => Carbon::now()]);
       return redirect()->route('category.index')->with('status', 'Successfuly Deleted');

    }
}
