@extends('app') <!-- Merujuk ke layout app.blade.php -->

@section('title', 'Decryption')

@section('content')
    <div class="container mt-5">
        <h2>Decryption</h2>
        <form action="/decryption" method="POST" class="bg-light p-4 rounded shadow">
            @csrf
            <div class="mb-3">
                <label for="cipher_text" class="form-label">Cipher Text:</label>
                <input type="text" id="cipher_text" name="cipher_text" class="form-control" required
                    value="{{ old('cipher_text') }}">
            </div>
            <div class="mb-3">
                <label for="key" class="form-label">Key:</label>
                <input type="text" id="key" name="key" class="form-control" required
                    value="{{ old('key') }}">
            </div>
            <button type="submit" class="btn btn-primary">Decrypt</button>

            <!-- Alert untuk jika dekripsi berhasil -->
            @if (isset($plainText))
                <div class="alert alert-success mt-3" role="alert">
                    <strong>Plain Text:</strong> {{ $plainText }}
                </div>
            @endif

            <!-- Alert Error -->
            @if (session('error'))
                <div class="alert alert-danger mt-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
@endsection
