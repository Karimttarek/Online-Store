<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox' ,function (Product $product){
                return '<input type="checkbox" name="item[]" class="item" value="'.$product->id.'">';
            })
            ->addColumn('edit', function (Product $product){
                return '<a href="'.url('dashboard/product/edit/'.$product->id).'"><i class="fa fa-edit"></i></a>
                <a href="#"><i class="fa fa-trash delete"></i></a>';//'.url('dashboard/category/delete/'.$category->id).'
            })
            ->addColumn('image' , function (Product $product){
                return '<img width="100%" height="100%" src="'.asset('image/products/'.$product->image).'">';
            })
            ->rawColumns([
                'edit',
                'checkbox',
                'image'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->where('deleted_at' , null);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
//                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1 , 'asc')
                    ->lengthMenu([10, 25, 50, 100])
                    ->buttons([
                        button::make(['className'=>'btn btn-default col-xs-1' , 'text' =>'<i class="fa fa-plus"></i>Add' , 'action' => 'function(){window.location.href= "'. route('product.create').'"}']),
                        button::make(['extend' =>'print' , 'className'=>'btn btn-default col-xs-1' , 'text' =>'<i class="fa fa-print"></i> Print']),
                        button::make(['extend' =>'csv' , 'className'=>'btn btn-success col-xs-1' , 'text' =>'<i class="fa fa-download"></i> CSV']),
                        button::make(['extend' =>'excel' , 'className'=>'btn btn-success col-xs-1' , 'text' =>'<i class="fa fa-download"></i> Excel']),
                        button::make(['extend' =>'reset' , 'className'=>'btn btn-default col-xs-1' , 'text' =>'<i class="fa fa-sync-alt"></i>']),
                        button::make(['className'=>'btn btn-danger delete col-xs-1', 'text' =>'<i class="fa fa-trash"></i> Delete'])
                    ])->parameters();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('checkbox')->title('<input type="checkbox" class="ckeck-all" onclick="checkAll()">')
                ->exportable(false)->printable(false)->orderable(false)->searchable(false),
            Column::make('id')->title('Id'),
            Column::make('sku')->title('Sku'),
            Column::make('name')->title('Name'),
            Column::make('name_ar')->title('Name(ar)'),
            Column::make('description')->title('Description'),
            Column::make('price')->title('Price'),
            Column::make('stock')->title('Stock'),
            Column::make('image')->title('Image')
                ->exportable(false)->printable(false)->orderable(false)->searchable(false),
            Column::make('active')->title('Active'),
//            Column::make('created_at')->title('Created at')
//                ->exportable(false)->printable(false)->orderable(false)->searchable(false),
            Column::make('edit')->title('Action')
                ->exportable(false)->printable(false)->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
