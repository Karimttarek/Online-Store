<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crud;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;

class SubcategoryController extends Controller
{
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subcategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected $table = 'subcategories';
    protected $model = 'App\Models\Subcategory';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubcategoryDataTable $dataTable){

        return $dataTable->render('dashboard.subcategory.subcategory');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->where('deleted_at' ,null)->select('id' , 'name')->get();
        return view('dashboard.subcategory.create' ,compact('categories'));
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
            'name' => ['required', 'string', 'max:255', 'unique:subcategories'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:subcategories'],
        ]);

        try {
            DB::beginTransaction();

//            Crud::store($this->table , $request->except('_token'));
            DB::table($this->table)->insert([
                'code' => str_replace(' ' ,'-' ,$request->name),
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'category_id' =>$request->category_id,
            ]);
            DB::commit();

            return redirect()->route('subcategory.index')->with('status', 'Successfully Added');

        }catch (Throwable $e){
            report($e);
            DB::rollBack();
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
        $categories = Crud::getDataWhere('categories' , 'deleted_at' , null, ['id' , 'name']);
        $data = Crud::getDataWithRelation($this->model , 'Category' , ['*'])->find($id);
        return view('dashboard.subcategory.edit' , compact('data' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        Crud::update($this->model , $id , ['name' => '' , 'name_ar' => '']);

        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:subcategories'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:subcategories'],
        ]);
        try {

            Crud::update($this->model , $id ,$request->except('_token'));
            DB::commit();
            return redirect()->route('subcategory.index')->with('status', 'Successfully Updated');
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
    public function destroy()
    {
        Crud::multiUpdate($this->model ,\request('item') , ['deleted_at' => Carbon::now()]);
        return redirect()->route('subcategory.index')->with('status', 'Successfully Deleted');
    }
}
