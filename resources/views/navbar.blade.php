<!-- resources/views/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="#">Kriptografi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') || Request::is('encryption') ? 'active' : '' }}"
                        href="{{ url('/') }}">Enkripsi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('decryption') ? 'active' : '' }}"
                        href="{{ url('decryption') }}">Dekripsi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
