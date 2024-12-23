<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.slider.edit', $query->id) . "' class='btn btn-info btn-sm'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.slider.destroy', $query->id) . "' class='btn btn-danger btn-sm ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('banner', function ($query) {
                $imageUrl = $query->banner
                    ? asset('storage/banner/' . $query->banner)
                    : asset('default/image.jpg');

                return "<img width='100px' src='{$imageUrl}' alt='Banner' class='img-thumbnail'>";
            })
            ->addColumn('estatus', function ($query) {
                $active = '<i class="badge badge-success">Activo</i>';
                $inActive = '<i class="badge badge-danger">Inactivo</i>';
                if ($query->status == 'active') {
                    return $active;
                } else {
                    return $inActive;
                }
            })
            ->rawColumns(['banner', 'actions', 'estatus'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->text('Exportar a Excel'),
                Button::make('csv')->text('Exportar a CSV'),
                Button::make('pdf')->text('Exportar a PDF'),
                Button::make('print')->text('Imprimir'),
                Button::make('reset')->text('Reiniciar'),
                Button::make('reload')->text('Recargar')
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
            Column::make('id')->title('#')->width(100), // Traducido a "ID"
            Column::make('banner')->title('Banner')->width(200), // Traducido a "Banner"
            Column::make('title')->title('Título'), // Traducido a "Título"
            Column::make('serial')->title('Serie'), // Traducido a "Serie"
            Column::make('estatus')->title('Estado'), // Traducido a "Estado"
            Column::computed('actions')
                ->title('Acciones') // Traducido a "Acciones"
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
        return 'Slider_' . date('YmdHis');
    }
}
