 
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif