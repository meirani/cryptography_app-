<!-- resources/views/encryption.blade.php -->
@extends('app') <!-- Merujuk ke layout app.blade.php -->

@section('title', 'Encryption')

@section('content')
    <form action="/encryption" method="POST">
        @csrf
        <label for="plain_text">Message:</label>
        <input type="text" id="plain_text" name="plain_text" pattern="\S+" required title="Tidak boleh ada spasi">
        <br>
        <label for="key">Key:</label>
        <input type="text" id="key" name="key">
        <br>
        <button type="submit">Encrypt</button>
        @if (isset($cipherText))
            <p>Cipher Text: {{ $cipherText }}</p>
        @endif
    </form>
@endsection
