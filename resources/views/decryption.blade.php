<!-- resources/views/decryption.blade.php -->
@extends('app') <!-- Merujuk ke layout app.blade.php -->

@section('title', 'Decryption')

@section('content')
    <form action="/decryption" method="POST">
        @csrf
        <label for="cipher_text">Cipher Text:</label>
        <input type="text" id="cipher_text" name="cipher_text">
        <br>
        <label for="key">Key:</label>
        <input type="text" id="key" name="key">
        <br>
        <button type="submit">Decrypt</button>
        @if (isset($plainText))
            <p>Plain Text: {{ $plainText }}</p>
        @elseif(isset($error))
            <p>Error: {{ $error }}</p>
        @endif
    </form>
@endsection
