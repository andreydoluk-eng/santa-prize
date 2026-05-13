@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-6">Категорії</h1>

        <div class="grid md:grid-cols-3 gap-6">
            <a href="{{ route('equipments.index') }}" class="rounded-xl bg-white border p-6 hover:shadow-md">
                <h2 class="text-xl font-semibold">Спецтехніка</h2>
            </a>
            <a href="{{ route('services.index') }}" class="rounded-xl bg-white border p-6 hover:shadow-md">
                <h2 class="text-xl font-semibold">Послуги</h2>
            </a>
            <a href="{{ route('projects.index') }}" class="rounded-xl bg-white border p-6 hover:shadow-md">
                <h2 class="text-xl font-semibold">Наші роботи</h2>
            </a>
        </div>
    </section>
@endsection
