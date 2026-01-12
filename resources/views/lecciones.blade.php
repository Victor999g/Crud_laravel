<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6fa63d5e18.js" crossorigin="anonymous"></script>
    <title>Lecciones</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <div>
        <h1 class="text-center p-2">Información de la lección </h1>
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

                        <form method="POST" action="{{ route('update_leccion_by_id', $leccion->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="Input_titulo_leccion" class="form-label">Título</label>
                                <input type="text" class="form-control" id="Input_titulo_leccion" name="input_cursos_leccion" required value="{{ old('input_cursos_leccion', $leccion->titulo) }}""></input>
                            </div>
                            <div class=" mb-3">
                                <label for="input_area_contenido_leccion" class="form-label">Contenido</label>
                                <textarea class="form-control" id="input_area_contenido_leccion" name="input_contenido_leccion" rows="3" required>{{ old('input_contenido_leccion', $leccion->contenido) }}</textarea>
                            </div>
                            <label for="Input_titulo_leccion" class="form-label">Curso asociado:{{$leccion->cursos_belongsTo->titulo}}</label>

                            <select class="form-select" name="select_lecciones" required>
                                <option value="">Selecciona una opción</option>
                                @foreach($cursos as $ittem)
                                <option value="{{ $ittem->id }}"
                                    {{ old('select_lecciones', $leccion->curso_id) == $ittem->id ? 'selected' : '' }}>
                                    {{ $ittem->titulo }}
                                </option>
                                @endforeach
                            </select>

                            <br />
                            <br />
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <h5 class="fw-bold mb-2">Titulo:</h5>
        <p class="mb-3">{{ $leccion->titulo }}</p>
        <h5 class="fw-bold mb-2">Curso asociado:</h5>
        <p class="mb-3">{{ $leccion->cursos_belongsTo->titulo }}</p>
        <h5 class="fw-bold mb-2">Contenido:</h5>
        <p style="white-space: pre-wrap;">{{ $leccion->contenido }}</p>

    </div>

</body>

</html>