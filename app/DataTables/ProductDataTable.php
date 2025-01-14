<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            $editBtn = "<a href='" . route('admin.products.edit', $query->slug) . "' class='btn btn-info btn-sm'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='" . route('admin.products.destroy', $query->slug) . "' class='btn btn-danger btn-sm ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
            $moreBtn = '<div class="dropdown dropleft d-inline">
            <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
            </button>
            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
              <a class="dropdown-item has-icon"><i class="far fa-heart"></i> Image Gallery</a>
              <a class="dropdown-item has-icon"<i class="far fa-file"></i> Variants</a>
            </div>
          </div>';
            return $editBtn.$deleteBtn.$moreBtn;
        })
        ->addColumn('thumb_image', function ($query) {
            $imageUrl = $query->thumb_image
                ? asset('storage/product/' . $query->thumb_image)
                : asset('default/image.jpg');

            return "<img width='100px' src='{$imageUrl}' alt='Product' class='img-thumbnail'>";
        })
        ->addColumn('product_type', function($query){
            switch ($query->product_type) {
                case 'nueva_llegada':
                    return '<i class="badge badge-success">Producto recién llegado</i>';
                    break;
                case 'destacado':
                    return '<i class="badge badge-warning">Producto destacado</i>';
                    break;
                case 'producto_top':
                    return '<i class="badge badge-info">Producto top</i>';
                    break;

                case 'mejor_producto':
                    return '<i class="badge badge-danger">Mejor producto</i>';
                    break;

                default:
                    return '<i class="badge badge-dark">Ninguno</i>';
                    break;
            }
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
        ->rawColumns(['thumb_image', 'product_type', 'actions', 'estatus'])

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('id')->title('#')->width(100),
            Column::make('thumb_image')->title('Imagen')->width(100),
            Column::make('name')->title('Nombre')->width(100),
            Column::make('product_type')->title('Tipo')->width(150),
            Column::make('status')->title('Estado')->width(100),
            Column::computed('actions')->title('Acciones')->width(100)
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
        return 'Product_' . date('YmdHis');
    }
}
