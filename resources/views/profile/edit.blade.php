@extends('layouts.admin.app')
@section('title', 'Profile')

@php
    $breadcrumbs = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Profile'],
    ];
@endphp

@section('content')
<main class="flex-1">
    <div class="space-y-6">
        <!-- Profile Information -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</main>
@endsection
