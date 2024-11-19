<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .custom-file-input {
            cursor: pointer;
        }
        .custom-file-label {
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Importação e Processamento</h1>
            <p class="text-center text-muted">Escolha uma ação para gerenciar os documentos:</p>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title text-center">Importar Documentos</h5>
                    <p class="card-text text-center text-muted">
                        Clique no botão abaixo para importar documentos para a fila.
                    </p>
                    <form action="{{ route('documents.import-document') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" id="document" name="document" class="custom-file-input" accept=".json" required value="{{ old('document') }}">
                                <label class="custom-file-label" for="document">Escolha o arquivo json...</label>
                            </div>
                            @error('document')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Importar para a Fila</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Processar Documentos</h5>
                    <p class="card-text text-center text-muted">
                        Clique no botão abaixo para processar os documentos da fila.
                    </p>
                    <form action="{{ route('documents.process-document') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block">Processar Fila</button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success mt-3 text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-3 text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('.custom-file-input').on('change', function(e) {
        const fileName = e.target.files[0]?.name || "Escolha o arquivo...";
        $(this).next('.custom-file-label').html(fileName);
    });
</script>
</body>
</html>
