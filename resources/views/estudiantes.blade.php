<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6fa63d5e18.js" crossorigin="anonymous"></script>
    <title>Estudiante</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <div>
        <h1 class="text-center p-2">Información del estudiante </h1>
    </div>

    <div class="card m-3 p-3 shadow-sm">

        <button type="button"
            class="btn btn-primary position-absolute top-0 end-0 m-3"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            <i class="fa-solid fa-pen"></i>
            Actulizar
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualiza la información que creas necesaria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('update_estudiante_by_id', $estudiante->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="input_name_estudiante" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="input_name_estudiante" name="input_name_estudiante" required
                                    value="{{ old('input_name_estudiante', $estudiante->nombre) }}">
                            </div>

                            <div class="mb-3">
                                <label for="input_phone_estudiante" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="input_phone_estudiante" name="input_phone_estudiante" required
                                    value="{{ old('input_phone_estudiante', $estudiante->phone) }}">
                            </div>

                            <div class="mb-3">
                                <label for="input_email_estudiante" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="input_email_estudiante" name="input_email_estudiante" required
                                    value="{{ old('input_email_estudiante', $estudiante->correo) }}">
                            </div>

                            <div class="mb-3">
                                <label for="input_password_estudiante" class="form-label">Contraseña (dejar vacío si no quieres cambiar)</label>
                                <input type="password" class="form-control" id="input_password_estudiante" name="input_password_estudiante">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>


        <h5 class="fw-bold mb-2">Nombre:</h5>
        <p class="mb-3">{{ $estudiante->nombre }}</p>
        <h5 class="fw-bold mb-2">Telefono:</h5>
        <p class="mb-3">{{ $estudiante->phone }}</p>
        <h5 class="fw-bold mb-2">Correo:</h5>
        <p style="white-space: pre-wrap;">{{ $estudiante->correo }}</p>

    </div>

    <div>
        <div class="p-5">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                        id="pills-lecciones-curso-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-lecciones-curso"
                        type="button" role="tab"
                        aria-controls="pills-lecciones-curso"
                        aria-selected="false">Mis cursos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                        id="pills-estudiantes-curso-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-estudiantes-curso"
                        type="button"
                        role="tab"
                        aria-controls="pills-estudiantes-curso"
                        aria-selected="false">Cursos</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active"
                    id="pills-lecciones-curso"
                    role="tabpanel"
                    aria-labelledby="pills-lecciones-curso-tab"
                    tabindex="0">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($estudiante->curso_belongsToMany->count() > 0)
                                @foreach($estudiante->curso_belongsToMany as $ittem)
                                <tr>
                                    <td>{{ $ittem->pivot->id }}</td>
                                    <td>{{ $ittem->titulo }}</td>
                                    <td>{{ $estudiante->correo }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_estudiante_Modal{{ $ittem->pivot->id }}">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <div class="modal fade" id="delete_estudiante_Modal{{ $ittem->pivot->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        ¿Estás seguro cancelar tu suscripción a <strong>{{ $ittem->titulo }}</strong> ?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>

                                                        <form method="POST" action="{{ route('delete_relacion_by_id',$ittem->pivot->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                Sí, eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">No hay cursos registrados</td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="tab-pane fade"
                    id="pills-estudiantes-curso"
                    role="tabpanel"
                    aria-labelledby="pills-estudiantes-curso-tab"
                    tabindex="0">

                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($allcursos->count() > 0)
                                @foreach($allcursos as $ittem)
                                <tr>
                                    <td>{{ $ittem->id }}</td>
                                    <td>{{ $ittem->titulo }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#subscribe_curso_Modal{{ $ittem->id }}">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </button>

                                        <div class="modal fade" id="subscribe_curso_Modal{{ $ittem->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmar suscripción</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas suscribirte al curso <strong>{{ $ittem->titulo }}</strong>?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>

                                                        <form method="POST" action="{{ route('create_relacion') }}">
                                                            @csrf
                                                            <input type="hidden" name="curso_id" value="{{ $ittem->id }}">
                                                            <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
                                                            <button type="submit" class="btn btn-success">
                                                                Sí, suscribirme
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="3" class="text-center">No hay cursos registrados</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>