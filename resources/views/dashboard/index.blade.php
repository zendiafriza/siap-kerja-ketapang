@extends('layouts.app')

@section('isi')
<div class="app-wrapper">
    @include('partials.navbar')

    <div class="dashboard-layout">
        <aside class="dashboard-sidebar">
            @include('partials.sidebar')
        </aside>

        <main class="dashboard-main">
            @yield('konten_tengah')
        </main>

        <aside class="dashboard-right">
            @include('partials.right_panel')
        </aside>
    </div>
</div>

<style>
    .dashboard-layout {
        display: flex;
        gap: 24px;
        padding: 24px;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
        box-sizing: border-box;
    }

    .dashboard-sidebar {
        width: 260px;
        flex-shrink: 0;
    }

    .dashboard-main {
        flex: 1;
        min-width: 0; /* Prevent flex blowout */
        min-height: 500px;
    }

    .dashboard-right {
        width: 320px;
        flex-shrink: 0;
    }

    /* RESPONSIVE BREAKPOINTS */
    @media (max-width: 1200px) {
        .dashboard-right {
            display: none; /* Hide right panel on smaller desktops/tablets */
        }
    }

    @media (max-width: 1024px) {
        .dashboard-layout {
            padding: 16px;
            gap: 16px;
        }
        .dashboard-sidebar {
            width: 80px; /* Mini sidebar on tablets */
        }
    }

    @media (max-width: 768px) {
        .dashboard-layout {
            flex-direction: column;
            padding: 12px;
        }

        .dashboard-sidebar {
            display: none; /* Hide sidebar on mobile */
        }

        .dashboard-right {
            display: none;
        }

        .dashboard-main {
            width: 100%;
        }
    }
</style>

@include('dashboard.modal_edit')
@endsection