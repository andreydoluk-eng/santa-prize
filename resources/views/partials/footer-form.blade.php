<footer id="application-form" class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-semibold mb-4">Залишити заявку</h2>

        <form action="{{ route('applications.store') }}" method="post" class="grid md:grid-cols-3 gap-4">
            @csrf
            <input type="hidden" name="source_url" value="{{ url()->current() }}">
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Ваше ім'я"
                class="rounded-lg border border-gray-300 px-4 py-3"
                required
            >
            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                placeholder="+380..."
                class="rounded-lg border border-gray-300 px-4 py-3"
                required
            >
            <input
                type="text"
                name="message"
                value="{{ old('message') }}"
                placeholder="Коментар (необов'язково)"
                class="rounded-lg border border-gray-300 px-4 py-3"
            >

            <button class="md:col-span-3 rounded-lg bg-blue-600 text-white px-4 py-3 font-medium hover:bg-blue-700">
                Надіслати заявку
            </button>
        </form>
    </div>
</footer>
