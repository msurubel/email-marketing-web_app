@extends('layouts.masterlayout')
@section('content')
    <livewire:main-app/>

    <!-- Url Function Scripts -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('urlChange', (url) => {
                history.pushState(null, null, url);
            });
        });
    </script>
    <!-- Url Function Scripts -->
@endsection