@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Perfil</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Perfil</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">¡Hola, {{ Auth::user()->name }}!</h2>
            <p class="section-lead">
                Cambie la información sobre su perfil en esta página.
            </p>

            <div class="row mt-sm-4">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post" action="{{ route('admin.profile.update') }}" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Editar Perfil</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        @isset(Auth::user()->image)
                                            <img id="picture" alt="image" src="{{ Storage::url(Auth::user()->image) }}"
                                                style="width: 100px; height:100px" class="object-cover aspect-video">
                                        @else
                                            <img id="picture" alt="image"
                                                src="{{ asset('backend/assets/img/avatar/avatar-1.png') }}"
                                                style="width: 100px; height:100px" class="object-cover aspect-video">
                                        @endisset

                                        <input type="file" name="image" class="form-control mt-2"
                                            onchange="cambiarImagen(event)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" required=""
                                            value="{{ Auth::user()->name }}" name="name">
                                        <div class="invalid-feedback">
                                            Por favor ingrese su nombre
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Correo electrónico</label>
                                        <input type="email" class="form-control" required=""
                                            value="{{ Auth::user()->email }}" name="email">
                                        <div class="invalid-feedback">
                                            Por favor ingrese su correo
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="ujang@maman.com" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Phone</label>
                                        <input type="tel" class="form-control" value="">
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <form method="post" class="needs-validation" novalidate=""
                            action="{{ route('admin.password.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Cambiar Contraseña</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Contraseña Actual</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Por favor ingrese su contraseña actual
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Nueva Contraseña</label>
                                        <input type="password" name="password" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Por favor ingrese su nueva contraseña
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Confirmar Contraseña</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Por favor confirme su contraseña
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Script para cambiar la imagen seleccionada -->
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
