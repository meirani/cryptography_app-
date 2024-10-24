<!-- resources/views/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Kriptografi</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('encryption') ? 'active' : '' }}"
                    href="{{ url('encryption') }}">Enkripsi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('decryption') ? 'active' : '' }}"
                    href="{{ url('decryption') }}">Dekripsi</a>
            </li>
        </ul>
    </div>
</nav>
