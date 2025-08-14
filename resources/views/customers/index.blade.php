@extends('layouts.app')

@section('content')
<div class="card" style="display:grid; gap:12px;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <div style="font-size:12px; color:var(--efficio-muted); text-transform:uppercase; letter-spacing:.08em;">Clienti</div>
            <h2 style="margin:4px 0 0;">Elenco</h2>
        </div>
        <a href="{{ route('customers.create') }}" class="item" style="padding:8px 12px; border:1px solid rgba(255,255,255,.1); border-radius:8px;">
            + Nuovo cliente
        </a>
    </div>

    <!-- Search Box -->
    <div style="background: var(--efficio-surface); border: var(--border); border-radius: 8px; padding: 16px;">
        <div style="display: flex; gap: 12px; align-items: center;">
            <div style="flex: 1; position: relative;">
                <input 
                    type="text" 
                    id="searchInput"
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="Cerca clienti per nome, email, telefono, città, indirizzo..." 
                    style="width: 100%; padding: 12px 16px; background: var(--efficio-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: var(--efficio-text); font-size: 14px;"
                    autocomplete="off"
                >
                <div id="searchSpinner" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); display: none; color: var(--efficio-accent);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2V6M12 18V22M4.93 4.93L7.76 7.76M16.24 16.24L19.07 19.07M2 12H6M18 12H22M7.76 16.24L4.93 19.07M19.07 4.93L16.24 7.76" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin"/>
                    </svg>
                </div>
            </div>
            @if($search)
                <a href="{{ route('customers.index') }}" style="padding: 12px 20px; background: var(--efficio-muted); color: var(--efficio-bg); border: none; border-radius: 8px; font-weight: 500; text-decoration: none; transition: all 0.2s;">
                    Cancella
                </a>
            @endif
        </div>
        @if($search)
            <div style="margin-top: 12px; color: var(--efficio-muted); font-size: 14px;">
                Risultati per: <strong>{{ $search }}</strong> • {{ $customers->total() }} cliente{{ $customers->total() != 1 ? 'i' : '' }} trovati
            </div>
        @endif
    </div>

    <div id="customersGrid" style="display:grid; grid-template-columns: repeat(12, 1fr); gap:12px;">
        @foreach($customers as $c)
            <a href="{{ route('customers.show', $c) }}" class="card" style="grid-column: span 6; text-decoration:none;">
                <div style="font-weight:600">{{ $c->name }}</div>
                <div style="color:var(--efficio-muted); font-size:14px;">{{ $c->email ?? '—' }} • {{ $c->phone ?? '—' }}</div>
                <div style="color:var(--efficio-muted); font-size:12px; margin-top:6px;">{{ $c->city }} {{ $c->zip }}</div>
            </a>
        @endforeach
    </div>

    <div id="noResults" style="text-align: center; padding: 40px; color: var(--efficio-muted); display: {{ $customers->count() == 0 ? 'block' : 'none' }};">
        @if($search)
            Nessun cliente trovato per "{{ $search }}". <a href="{{ route('customers.index') }}" style="color: var(--efficio-accent);">Riprova</a>
        @else
            Nessun cliente presente. <a href="{{ route('customers.create') }}" style="color: var(--efficio-accent);">Crea il primo cliente</a>
        @endif
    </div>

    <div id="paginationContainer">
        {{ $customers->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const customersGrid = document.getElementById('customersGrid');
    const noResults = document.getElementById('noResults');
    const paginationContainer = document.getElementById('paginationContainer');
    const searchSpinner = document.getElementById('searchSpinner');
    
    let searchTimeout;
    let currentSearch = '{{ $search ?? "" }}';
    
    // Funzione per aggiornare l'URL senza ricaricare la pagina
    function updateURL(searchTerm) {
        const url = new URL(window.location);
        if (searchTerm) {
            url.searchParams.set('search', searchTerm);
        } else {
            url.searchParams.delete('search');
        }
        window.history.pushState({}, '', url);
    }
    
    // Funzione per eseguire la ricerca
    function performSearch(searchTerm) {
        if (searchTerm === currentSearch) return;
        
        currentSearch = searchTerm;
        searchSpinner.style.display = 'block';
        
        // Aggiorna l'URL
        updateURL(searchTerm);
        
        // Esegui la richiesta AJAX
        fetch(`{{ route('customers.index') }}?search=${encodeURIComponent(searchTerm)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Crea un DOM temporaneo per estrarre i contenuti
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Aggiorna la griglia dei clienti
            const newGrid = doc.getElementById('customersGrid');
            if (newGrid) {
                customersGrid.innerHTML = newGrid.innerHTML;
            }
            
            // Aggiorna il messaggio "nessun risultato"
            const newNoResults = doc.getElementById('noResults');
            if (newNoResults) {
                noResults.innerHTML = newNoResults.innerHTML;
                noResults.style.display = newNoResults.style.display;
            }
            
            // Aggiorna la paginazione
            const newPagination = doc.getElementById('paginationContainer');
            if (newPagination) {
                paginationContainer.innerHTML = newPagination.innerHTML;
            }
            
            // Aggiorna il contatore risultati se presente
            const resultsInfo = document.querySelector('[style*="margin-top: 12px"]');
            if (resultsInfo) {
                const newResultsInfo = doc.querySelector('[style*="margin-top: 12px"]');
                if (newResultsInfo) {
                    resultsInfo.innerHTML = newResultsInfo.innerHTML;
                }
            }
            
            searchSpinner.style.display = 'none';
        })
        .catch(error => {
            console.error('Errore durante la ricerca:', error);
            searchSpinner.style.display = 'none';
        });
    }
    
    // Gestisce l'input con debounce
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.trim();
        
        // Cancella il timeout precedente
        clearTimeout(searchTimeout);
        
        // Imposta un nuovo timeout per la ricerca
        searchTimeout = setTimeout(() => {
            performSearch(searchTerm);
        }, 300); // Ritardo di 300ms
    });
    
    // Gestisce la pressione di Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(searchTimeout);
            performSearch(this.value.trim());
        }
    });
    
    // Gestisce il focus per migliorare l'UX
    searchInput.addEventListener('focus', function() {
        this.style.borderColor = 'var(--efficio-accent)';
        this.style.boxShadow = 'var(--efficio-glow)';
    });
    
    searchInput.addEventListener('blur', function() {
        this.style.borderColor = 'rgba(255,255,255,0.1)';
        this.style.boxShadow = 'none';
    });
});
</script>

<style>
@keyframes spin {
    from { transform: translateY(-50%) rotate(0deg); }
    to { transform: translateY(-50%) rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

#searchInput:focus {
    outline: none;
    border-color: var(--efficio-accent);
    box-shadow: var(--efficio-glow);
}
</style>
@endsection


