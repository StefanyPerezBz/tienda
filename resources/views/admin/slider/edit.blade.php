@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Editar Slider</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST"
                                class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Visualizar</label>
                                    <br>
                                    @isset($slider->banner)
                                        <img src="{{ asset('storage/banner/' . $slider->banner) }}" alt="Banner Img" id="picture"
                                            class="img-thumbnail" width="200">
                                    @else
                                        <img id="picture" alt="Banner Img" src="{{ asset('default/image.jpg') }}"
                                            class="img-thumbnail" width="200">
                                    @endisset
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner"
                                        onchange="cambiarImagen(event)">
                                    <div class="invalid-feedback">
                                        Por favor escoja la imagen
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Tipo</label>
                                    <input type="text" class="form-control" name="type" value="{{ $slider->type }}"
                                    placeholder="Ej. Edición Exclusiva, Promoción de Temporada, Últimos Lanzamientos .." required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el tipo de slider
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" class="form-control" name="title" value="{{ $slider->title }}"
                                        placeholder="Ej.Tendencias que Marcan Estilo, Descubre Descuentos Irresistibles .." required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el título del slider
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Precio inicial</label>
                                    <input type="number" class="form-control" name="starting_price"
                                    value="{{ old('starting_price', $slider->starting_price ?? '') }}"  min="1"
                                    step="0.01" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese un precio inicial válido. Solo se permiten números con hasta dos decimales.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label> URL del botón</label>
                                    <input type="text" class="form-control" name="btn_url" value="{{ $slider->btn_url }}"
                                        placeholder="Dirección web (enlace)" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la URL
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Serie</label>
                                    <input type="number" class="form-control" name="serial" value="{{ $slider->serial }}"
                                        placeholder="Orden en que se muestra el slider (1,2 ..)" min="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese la serie del slider
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active"
                                            {{ old('status', $slider->status) == 'active' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $slider->status) == 'inactive' ? 'selected' : '' }}>Inactivo
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor seleccione un estado
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">Actualizar</button>

                                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary">Regresar</a>
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
