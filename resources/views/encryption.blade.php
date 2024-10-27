@extends('app') <!-- Merujuk ke layout app.blade.php -->

@section('title', 'Encryption')

@section('content')
    <div class="container mt-5">
        <h2>Encryption</h2>
        <form action="/encryption" method="POST" class="bg-light p-4 rounded shadow">
            @csrf
            <div class="mb-3">
                <label for="plain_text" class="form-label">Message:</label>
                <input type="text" id="plain_text" name="plain_text" class="form-control" pattern="\S+" required
                    title="Tidak boleh ada spasi">
            </div>
            <div class="mb-3">
                <label for="key" class="form-label">Key:</label>
                <input type="text" id="key" name="key" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Encrypt</button>
            @if (isset($cipherText))
                <div class="alert alert-info mt-3" role="alert">
                    <strong>Cipher Text:</strong> {{ $cipherText }}
                </div>
            @endif
        </form>
    </div>
@endsection
