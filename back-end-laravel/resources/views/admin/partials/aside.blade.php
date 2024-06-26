<aside class="bg-dark">
  <nav>
    <ul>
      <li class="nav-item mt-5">
        <a href="{{ route('admin.products.index') }}" class="nav-link text-white">
          <i class="fa-solid fa-list"></i>
          <span class="d-none d-lg-inline-block">Elenco Prodotti</span>
        </a>
      </li>
      <li class="nav-item mt-5">
        <a href="{{ route('admin.orders.index') }}" class="nav-link text-white">
          <i class="fa-solid fa-list"></i>
          <span class="d-none d-lg-inline-block">Ordini Ricevuti</span>
        </a>
      </li>

      {{-- <li class="nav-item mt-5">
        <a href="{{ route('admin.restaurants.edit',Auth::user()->id) }}" class="nav-link text-white">
          <i class="fa-solid fa-list"></i>
          <span class="d-none d-lg-inline-block">Modifica Logo</span>
        </a>
      </li> --}}
    </ul>
  </nav>
</aside>
