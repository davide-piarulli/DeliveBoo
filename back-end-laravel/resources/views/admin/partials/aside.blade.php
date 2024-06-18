<aside class="bg-dark">
  <nav>
    <ul>
      <li class="nav-item">
        <a href="{{ route('admin.products.index') }}" class="nav-link text-white">
          <i class="fa-solid fa-house"></i>
          <span class="d-none d-lg-inline-block">Elenco Prodotto</span>
          <a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.products.create') }}" class="nav-link text-white">
          <i class="fa-solid fa-chart-simple"></i>
          <span class="d-none d-lg-inline-block">Nuovo Prodotto</span>
          <a>
      </li>

      {{-- <li>
        <a href="{{ route('admin.productsType.index') }}">
          <i class="fa-solid fa-signal  p-2 me-1 mt-2"> Tipi Di Prodotto</i>
        </a>
      </li> --}}

      {{-- <li>
        <a href="{{ route('admin.types.index')}}">
          <i class="fa-solid fa-signal  p-2 me-1 mt-2"> Tipologia Ristorante </i>
        </a>
      </li> --}}

    </ul>
  </nav>
</aside>
