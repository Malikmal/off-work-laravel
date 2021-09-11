<?php

namespace App\DataTables;

use App\Models\OffWork;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OffWorkDataTable extends DataTable
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
            ->editColumn('created_at', function ($query){
                return $query->created_at->diffForHumans();
            })
            ->addColumn('employee', '{{$employee_name}}') 
            ->addColumn('action', '
            <form method="POST" action="{{route("off-works.destroy", $id)}}" class="d-flex d-inline" >
                @csrf
                @method("DELETE")
                <a href="{{ route("off-works.accept", $id) }}" class="btn btn-sm @if($accepted_at) btn-secondary @else btn-primary @endif mx-1" title="accepted by {{$acceptor ?? "no ones"}} "><i class="fa fa-check"></i></a>
                @if(auth()->user()->role_id != \App\Models\Role::KARYAWAN )
                <a href="{{ route("off-works.edit", $id) }}" class="btn btn-sm btn-warning mx-1"><i class="fa fa-edit"></i></a>
                <input name="id" value="{{$id}}" type="hidden"/>
                <button type="submit" class="btn btn-sm btn-danger mx-1"><i class="fa fa-trash "></i></button>
                @endif
            </form>
            ')
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OffWork $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OffWork $model)
    {
        return $model->newQuery()->addSelect([
            'employee_name' => \App\Models\Employee::select('employees.name')
                                ->whereColumn('employees.id', 'off_works.employee_id')
                                ->limit(1),
                                
            'acceptor' => \App\Models\User::select('users.name')
                                ->whereColumn('users.id', 'off_works.accepted_by')
                                ->limit(1),

        ])->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('offwork-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::computed('employee'),
            Column::make('description'),
            Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'OffWork_' . date('YmdHis');
    }
}
