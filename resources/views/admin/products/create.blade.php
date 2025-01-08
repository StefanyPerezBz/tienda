@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Producto</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear Producto</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="POST" class="needs-validation"
                                novalidate="" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Visualizar</label>
                                    <br>
                                    <img id="picture" width="200" src="{{ asset('default/image.jpg') }}"
                                        alt="">
                                </div>

                                <div class="form-group">
                                    <label>Imagen</label>
                                    <input type="file" class="form-control" name="thumb_image"
                                        onchange="cambiarImagen(event)" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor escoja la imagen
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Nombre del producto</label>
                                    <input type="text" class="form-control"
                                        placeholder="Ejemplo; Camiseta Nike Dri-FIT..." name="name"
                                        value="{{ old('name') }}" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre del producto
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Categoría</label>
                                            <select id="mainCategory" class="form-control" required>
                                                <option value="" disabled selected>Seleccionar categoría</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor ingrese la categoría del producto
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Sub Categoría</label>
                                            <select id="subCategory" class="form-control" disabled required>
                                                <option value="" disabled selected>Seleccionar subcategoría</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor ingrese la subcategoría del producto
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Sub Subcategoría</label>
                                            <select id="childCategory" class="form-control" disabled required>
                                                <option value="" disabled selected>Seleccionar sub subcategoría
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor ingrese la sub subcategoría del producto
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="inputState">Marca de producto</label>
                                    <select id="inputState" class="form-control" name="brand" required>
                                        <option value="" disabled selected>Seleccionar marca</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la marca del producto
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>SKU (Código único de identificación del producto)</label>
                                    <input type="text" class="form-control" name="sku" value="{{ old('sku') }}"
                                        placeholder="Ejemplo:NK-DF-001">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el SKU del producto
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Precio</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}"
                                        required min="1" step="0.01" autofocus placeholder="Ejemplo: 50,99">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el precio del producto
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Precio de oferta</label>
                                    <input type="number" step="0.01" class="form-control" name="offer_price"
                                        value="{{ old('offer_price') }}" min="1" autofocus
                                        placeholder="Ejemplo: 40,99">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el precio de oferta del producto
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fecha de inicio de oferta</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date"
                                                value="{{ old('offer_start_date') }}" autofocus>
                                            <div class="invalid-feedback">
                                                Por favor ingrese la fecha de inicio de la oferta
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fecha de fin de oferta</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date"
                                                value="{{ old('offer_end_date') }}" autofocus>
                                            <div class="invalid-feedback">
                                                Por favor ingrese la fecha de fin de la oferta
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" min="0" class="form-control" name="qty"
                                        value="{{ old('qty') }}" required autofocus placeholder="Ejemplo: 50">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el stock del producto
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Link de video</label>
                                    <input type="text" class="form-control" name="video_link"
                                        value="{{ old('video_link') }}" placeholder="Ejemplo: https://www.youtube.com"
                                        autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el link de video
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Descripción corta</label>
                                    <div class="ckeditor">
                                        <textarea id="short_description" name="short_description" class="form-control"
                                            placeholder="Ejemplo: Camiseta deportiva de alta calidad."></textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la descripción corta
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Descripción larga</label>
                                    <div class="ckeditor">
                                        <textarea id="long_description" name="long_description" class="form-control"
                                            placeholder="Ejemplo: Esta camiseta está hecha con tecnología Dri-FIT para mantenerte seco y cómodo"></textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la descripción larga
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>¿Destacar producto?</label>
                                            <select id="is_top" class="form-control" name="is_top" required>
                                                <option value="" disabled selected>Seleccionar estado</option>
                                                <option value="Si" {{ old('is_top') == 'Si' ? 'selected' : '' }}>Sí
                                                </option>
                                                <option value="No" {{ old('is_top') == 'No' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor ingrese si desea destacar el producto
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>¿Marcar como uno de los mejores productos?</label>
                                            <select id="is_best" class="form-control" name="is_best" required>
                                                <option value="" disabled selected>Seleccionar estado</option>
                                                <option value="Si" {{ old('is_best') == 'Si' ? 'selected' : '' }}>Sí
                                                </option>
                                                <option value="No" {{ old('is_best') == 'No' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor ingrese si desea marcar como uno de los mejores productos
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>¿Quiere destacar el producto en la página principal?</label>
                                            <select id="is_featured" class="form-control" name="is_featured" required>
                                                <option value="" disabled selected>Seleccionar estado</option>
                                                <option value="Si" {{ old('is_featured') == 'Si' ? 'selected' : '' }}>
                                                    Sí
                                                </option>
                                                <option value="No" {{ old('is_featured') == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor ingrese si desea marcar el producto como destacado en la página
                                                principal
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Tipo de producto</label>
                                    <select id="inputState" class="form-control" name="product_type">
                                        <option value="" disabled selected>Seleccionar tipo de producto</option>
                                        <option value="new_arrival">New Arrival</option>
                                        <option value="featured_product">Featured</option>
                                        <option value="top_product">Top Product</option>
                                        <option value="best_product">Best Product</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el tipo de producto
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Título SEO del producto</label>
                                    <input type="text" class="form-control" name="seo_title"
                                        value="{{ old('seo_title') }}" autofocus
                                        placeholder="Ejemplo: Camiseta Nike Dri-FIT para hombres">
                                    <div class="invalid-feedback">
                                        Por favor ingrese el título SEO
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Descripción SEO del producto</label>
                                    <div class="ckeditor">
                                        <textarea name="seo_description" id="seo_description" class="form-control"
                                            placeholder="Ejemplo: Compra la camiseta Nike Dri-FIT para hombres. Comodidad y rendimiento en un solo lugar"></textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la descripción SEO
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="" disabled selected>Seleccionar estado</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el estado del producto
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Crear</button>

                                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Regresar</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Cambiar la imagen
        document.getElementById("image").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categories = @json($categories);

            const mainCategory = document.getElementById('mainCategory');
            const subCategory = document.getElementById('subCategory');
            const childCategory = document.getElementById('childCategory');

            // Al cambiar la categoría principal
            mainCategory.addEventListener('change', function() {
                const selectedCategoryId = this.value;
                const selectedCategory = categories.find(category => category.id == selectedCategoryId);

                subCategory.innerHTML =
                    '<option value="" disabled selected>Seleccionar subcategoría</option>';
                childCategory.innerHTML =
                    '<option value="" disabled selected>Seleccionar sub subcategoría</option>';
                childCategory.disabled = true;

                if (selectedCategory && selectedCategory.subcategories.length > 0) {
                    subCategory.disabled = false;
                    selectedCategory.subcategories.forEach(subcategory => {
                        subCategory.innerHTML +=
                            `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                } else {
                    subCategory.disabled = true;
                }
            });

            // Al cambiar la subcategoría
            subCategory.addEventListener('change', function() {
                const selectedSubCategoryId = this.value;
                const selectedCategoryId = mainCategory.value;
                const selectedCategory = categories.find(category => category.id == selectedCategoryId);
                const selectedSubCategory = selectedCategory?.subcategories.find(subcategory => subcategory
                    .id == selectedSubCategoryId);

                childCategory.innerHTML =
                    '<option value="" disabled selected>Seleccionar sub subcategoría</option>';

                if (selectedSubCategory && selectedSubCategory.child_categories.length > 0) {
                    childCategory.disabled = false;
                    selectedSubCategory.child_categories.forEach(childCategoryItem => {
                        childCategory.innerHTML +=
                            `<option value="${childCategoryItem.id}">${childCategoryItem.name}</option>`;
                    });
                } else {
                    childCategory.disabled = true;
                }
            });
        });
    </script>

    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#short_description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#long_description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#seo_description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
