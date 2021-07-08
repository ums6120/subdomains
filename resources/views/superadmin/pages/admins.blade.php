@extends('superadmin.layouts.app')

@section('page')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Admins</li>
        </ol>
        <livewire:admin-management />
    </div>
</main>
@endsection