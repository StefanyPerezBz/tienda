@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Marca</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Editar Marca</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.brand.update', $brand->slug) }}" method="POST"
                                class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Visualizar</label>
                                    <br>
                                    @isset($brand->logo)
                                        <img src="{{ asset('storage/logo/' . $brand->logo) }}" alt="Logo Img" id="picture"
                                            class="img-thumbnail" width="200">
                                    @else
                                        <img id="picture" alt="image" src="{{ asset('default/image.jpg') }}"
                                            class="img-thumbnail" width="200">
                                    @endisset
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="logo"
                                        onchange="cambiarImagen(event)" autofocus>
                                    <div class="invalid-feedback">
                                        Por favor escoja la imagen
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name" value="{{ $brand->name }}"
                                        placeholder="Ej. Amazon, eBay .." required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre de la marca
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="is_featured">Destacar marca</label>
                                    <select name="is_featured" id="is_featured" class="form-control" required>
                                        <option value="yes"
                                            {{ old('is_featured', $brand->is_featured) == 'yes' ? 'selected' : '' }}>Si
                                        </option>
                                        <option value="no"
                                            {{ old('is_featured', $brand->is_featured) == 'no' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor ingrese para destacar la marca
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active"
                                            {{ old('status', $brand->status) == 'active' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $brand->status) == 'inactive' ? 'selected' : '' }}>Inactivo
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione un estado
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Actualizar</button>

                                    <a href="{{ route('admin.brand.index') }}" class="btn btn-primary">Regresar</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

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
@endsection
