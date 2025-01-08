@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Vendedor</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Crear Vendedor</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendor-profile.store') }}" method="POST" class="needs-validation"
                                novalidate="" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Visualizar</label>
                                    <br>
                                    @isset($profile->banner)
                                        <img src="{{ asset('storage/bannerVendor/' . $profile->banner) }}" alt="Banner Img"
                                            id="picture" class="img-thumbnail" width="200">
                                    @else
                                        <img id="picture" width="200" src="{{ asset('default/image.jpg') }}"
                                            alt="Banner Img" class="img-thumbnail">
                                    @endisset
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner"
                                        onchange="cambiarImagen(event)" autofocus>
                                    <div class="invalid-feedback">
                                        Por favor escoja la imagen
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nombre de la tienda</label>
                                    <input type="text" class="form-control" name="shop_name"
                                        value="{{ $profile->shop_name }}" placeholder="Nombre de la tienda" required
                                        autofocus>
                                    <div class="invalid-feedback">
                                        Por favor ingrese el nombre de la tienda
                                    </div>

                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <div class="alert alert-primary mt-2" id="phone-info-alert">
                                            Agrega +número del país y los dígitos del teléfono. <strong>Ejemplo: +5134567890</strong>
                                        </div>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $profile->phone }}" placeholder="Teléfono (ej. +1234567890)"  pattern="^\+?[1-9]\d{1,14}$" title="Agrega +numero de país y los dígitos del teléfono" required
                                            autofocus>
                                        <div class="invalid-feedback">
                                            Por favor ingrese el teléfono
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Correo electrónico</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $profile->email }}" placeholder="Ej. test@example.com" required
                                            autofocus>
                                        <div class="invalid-feedback">
                                            Por favor ingrese el correo electrónico
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $profile->address }}" placeholder="Dirección" required autofocus>
                                        <div class="invalid-feedback">
                                            Por favor ingrese la dirección
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <div class="ckeditor">
                                            <textarea id="description" name="description" placeholder="Descripción">{{ $profile->description }}</textarea>
                                        </div>
                                        <div class="invalid-feedback">
                                            Por favor ingrese la descripción
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Link de facebook</label>
                                        <input type="text" class="form-control" name="fb_link"
                                            value="{{ $profile->fb_link }}" placeholder="Ej. https://www.facebook.com"
                                            autofocus>
                                        <div class="invalid-feedback">
                                            Por favor ingrese el link de facebook
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Link de twitter</label>
                                        <input type="text" class="form-control" name="tw_link"
                                            value="{{ $profile->tw_link }}" placeholder="Ej. https://www.twitter.com"
                                            autofocus>
                                        <div class="invalid-feedback">
                                            Por favor ingrese el link de twitter
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Link de instagram</label>
                                        <input type="text" class="form-control" name="insta_link"
                                            value="{{ $profile->insta_link }}" placeholder="Ej. https://www.instagram.com"
                                            autofocus>
                                        <div class="invalid-feedback">
                                            Por favor ingrese el link de instagram
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Estado</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="active"
                                                {{ old('status', $profile->status) == 'active' ? 'selected' : '' }}>Activo
                                            </option>
                                            <option value="inactive"
                                                {{ old('status', $profile->status) == 'inactive' ? 'selected' : '' }}>
                                                Inactivo
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor seleccione un estado
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success">Crear</button>
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

    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
