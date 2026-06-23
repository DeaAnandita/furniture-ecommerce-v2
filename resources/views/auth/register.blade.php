<x-guest-layout>

    
    <div class="mb-10 text-center">

        <p class="text-sm tracking-[3px] uppercase text-[#182d5c] mb-3">
            Furniture Interior
        </p>

        <h1 class="hero-title text-4xl font-bold text-[#2B2B2B] mb-3">
            Register
        </h1>

        <p class="text-gray-500 text-sm leading-relaxed">
            Buat akun untuk mulai menjelajahi furniture
            modern dengan desain elegan.
        </p>

    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- NAMA -->
        <div>

            <label class="block text-sm font-medium mb-2 text-[#2B2B2B]">
                Nama Lengkap
            </label>

            <input type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Masukkan nama lengkap"
                class="w-full rounded-2xl border border-[#E7DED3] px-5 py-4 focus:ring-2 focus:ring-[#182d5c] focus:border-[#182d5c]">

            <x-input-error :messages="$errors->get('name')" class="mt-2" />

        </div>

        <!-- EMAIL -->
        <div>

            <label class="block text-sm font-medium mb-2 text-[#2B2B2B]">
                Email
            </label>

            <input type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="Masukkan email"
                class="w-full rounded-2xl border border-[#E7DED3] px-5 py-4 focus:ring-2 focus:ring-[#182d5c] focus:border-[#182d5c]">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        <!-- PHONE -->
        <div>

            <label class="block text-sm font-medium mb-2 text-[#2B2B2B]">
                Nomor Telepon
            </label>

            <input type="text"
                name="phone"
                value="{{ old('phone') }}"
                required
                autocomplete="tel"
                placeholder="Masukkan nomor telepon"
                class="w-full rounded-2xl border border-[#E7DED3] px-5 py-4 focus:ring-2 focus:ring-[#182d5c] focus:border-[#182d5c]">

            <x-input-error :messages="$errors->get('phone')" class="mt-2" />

        </div>

        <!-- PASSWORD -->
        <div>

            <label class="block text-sm font-medium mb-2 text-[#2B2B2B]">
                Password
            </label>

            <input type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Masukkan password"
                class="w-full rounded-2xl border border-[#E7DED3] px-5 py-4 focus:ring-2 focus:ring-[#182d5c] focus:border-[#182d5c]">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <!-- KONFIRMASI -->
        <div>

            <label class="block text-sm font-medium mb-2 text-[#2B2B2B]">
                Konfirmasi Password
            </label>

            <input type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi password"
                class="w-full rounded-2xl border border-[#E7DED3] px-5 py-4 focus:ring-2 focus:ring-[#182d5c] focus:border-[#182d5c]">

        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="w-full bg-[#182d5c] hover:bg-[#2d3a6f] text-white py-4 rounded-2xl font-medium transition">

            Register

        </button>

        <!-- LOGIN -->
        <p class="text-center text-sm text-gray-500">

            Sudah punya akun?

            <a href="{{ route('login') }}"
                class="text-[#182d5c] font-semibold hover:underline">

                Masuk

            </a>

        </p>

    </form>

</x-guest-layout>