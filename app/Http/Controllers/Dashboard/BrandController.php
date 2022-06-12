<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crud;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class BrandController extends Controller
{

    protected $table = 'brands';
    protected $model = 'App\Models\Brand';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('dashboard.brand.brand');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brand.create');
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
            'name' => ['required', 'string', 'max:255', 'unique:brands'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:brands'],
        ]);

        try {
            DB::beginTransaction();

//            Crud::store($this->table , $request->except('_token'));
            DB::table($this->table)->insert([
                'code' => str_replace(' ' ,'-' ,$request->name),
                'name' => $request->name,
                'name_ar' => $request->name_ar,
            ]);
            DB::commit();

            return redirect()->route('brand.index')->with('status', 'Successfully Added');

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
        $data = Crud::find($this->table , $id);
        return view('dashboard.brand.edit' , compact('data'));
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
            'name' => ['required', 'string', 'max:255', 'unique:brands'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:brands'],
        ]);
        try {

            Crud::update($this->model , $id ,$request->except('_token'));
            DB::commit();
            return redirect()->route('brand.index')->with('status', 'Successfully Updated');
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
        return redirect()->route('brand.index')->with('status', 'Successfully Deleted');
    }
}
