@extends('layouts.admin')

@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchBar = document.getElementById('search-bar');
            const passwordCards = document.querySelectorAll('#favourite-card');

            // Aggiungi un event listener per rilevare i cambiamenti nella barra di ricerca
            searchBar.addEventListener('keyup', function() {

                const searchTerm = searchBar.value.toLowerCase();

                // Loop attraverso gli elementi della lista e nascondi quelli che non corrispondono
                passwordCards.forEach(card => {
                    const passwordName = card.querySelector('h5').textContent.toLowerCase();

                    // Mostra o nasconde l'elemento basato sulla corrispondenza con il termine di ricerca
                    if (passwordName.includes(searchTerm)) {
                        card.classList.remove('d-none');
                    } else {
                        card.classList.add('d-none');
                    }
                });
            });
        });
    </script>
    <div class="favourites-list-container">
        {{-- SEARCHBAR --}}
        <div class="searchbar">
            <nav class="border">
                <input id="search-bar" type="search" placeholder="Search password" aria-label="Search" class="">
                <span class="border"><i class="fa-solid fa-magnifying-glass"></i></span>
            </nav>
        </div>

        {{-- FAVOURITES LIST --}}
        <div class="favourites-list">
            @foreach ($favouritesPassword as $favourite)
                @if ($favourite->user_id === Auth::id() && $favourite->favourite === 1)
                    <a id="favourite-card" href="{{ route('admin.passwords.show', ['password' => $favourite->id]) }}"
                        class="border" aria-current="true">
                        <div class="password-info">
                            <div style="background-color: {{ $favourite->color }};" class="tag">
                            </div>
                            <h5>{{ ucfirst($favourite->name) }}</h5>
                            <span><i
                                    class="fa-{{ $favourite->favourite === 1 ? 'solid' : 'regular' }} fa-star text-warning fs-5"></i>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
