<?php

namespace App\DataTables;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChildCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', function ($query) {
                $editBtn = "<a href='" . route('admin.childcategory.edit', $query->slug) . "' class='btn btn-primary btn-sm'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.childcategory.destroy', $query->slug) . "' class='btn btn-danger ml-2 btn-sm delete-item'><i class='far fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('category_id', function ($query) {
                return $query->category->name;
            })
            ->addColumn('subcategory_id', function ($query) {
                return $query->subcategory->name;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'active') {
                    $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" checked name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input" disabled>
                    <span class="custom-switch-indicator"></span>
                </label>';
                } else {
                    $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input" disabled>
                    <span class="custom-switch-indicator"></span>
                </label>';
                }
                return $button;
            })
            ->rawColumns(['category_id', 'actions', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('childcategory-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->language([
                'url' => '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json',
                'emptyTable' => 'No hay datos disponibles en la tabla', // Traducción personalizada
                'info' => 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                'infoEmpty' => 'Mostrando 0 a 0 de 0 registros',
                'infoFiltered' => '(filtrado de _MAX_ registros totales)',
                'lengthMenu' => 'Mostrar _MENU_ registros por página',
                'loadingRecords' => 'Cargando...',
                'processing' => 'Procesando...',
                'search' => 'Buscar:',
                'zeroRecords' => 'No se encontraron coincidencias',
                'paginate' => [
                    'first' => 'Primero',
                    'last' => 'Último',
                    'next' => 'Siguiente',
                    'previous' => 'Anterior'
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('#')->width(100),
            Column::make('category_id')->title('Categoría')->width(100),
            Column::make('subcategory_id')->title('SubCategoría')->width(100),
            Column::make('name')->title('Nombre'),
            Column::make('status')->title('Estado')->width(200),
            Column::computed('actions')
            ->title('Acciones')
            ->exportable(false)
            ->printable(false)
            ->width(200)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ChildCategory_' . date('YmdHis');
    }
}
