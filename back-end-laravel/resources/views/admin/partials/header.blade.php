<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark h-100">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse bg-dark navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item  text-center">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item  text-center mx-5">
                        <a class="nav-link" target="_blank" href="http://localhost:5174">Vai al sito pubblico</a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item d-flex justify-content-center">
                        <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                            @csrf
                            <div class="dropdown">
                                <a class="btn btn-dark" href="{{ route('admin.profile') }}" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i><span class="ms-2">{{ Auth::user()->name }}</span>
                                </a>

                            </div>
                            <button class="btn btn-danger ms-3" type="submit"><i
                                    class="fa-solid fa-arrow-right-from-bracket"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
