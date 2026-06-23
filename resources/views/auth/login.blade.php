<x-guest-layout>
    

    <div class="mb-10 text-center">

    <p class="text-sm tracking-[3px] uppercase text-[#182d5c] mb-3">
        Furniture Interior
    </p>

    <h1 class="hero-title text-4xl font-bold text-[#2B2B2B] mb-3">
        Masuk
    </h1>

    <p class="text-gray-500 text-sm leading-relaxed">
        Masuk untuk melihat koleksi furniture aesthetic
        dan melanjutkan pesanan Anda.
    </p>

    
</div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- EMAIL -->
        <div>

            <label class="block text-sm font-medium mb-2 text-[#2B2B2B]">
                Email
            </label>

            <input type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan email"
                class="w-full rounded-2xl border border-[#E7DED3] px-5 py-4 focus:ring-2 focus:ring-[#182d5c] focus:border-[#182d5c]">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        <!-- PASSWORD -->
        <div>

            <label class="block text-sm font-medium mb-2 text-[#2B2B2B]">
                Password
            </label>

            <input type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
                class="w-full rounded-2xl border border-[#E7DED3] px-5 py-4 focus:ring-2 focus:ring-[#182d5c] focus:border-[#182d5c]">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <!-- REMEMBER -->
        <div class="flex items-center justify-between">

            <label class="flex items-center gap-2 text-sm text-gray-600">

                <input type="checkbox"
                    name="remember"
                    class="rounded border-gray-300 text-[#8B5E3C] focus:ring-[#8B5E3C]">

                Ingat saya

            </label>

            @if (Route::has('password.request'))

                <a href="{{ route('password.request') }}"
                    class="text-sm text-[#182d5c] hover:underline">

                    Lupa password?

                </a>

            @endif

        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="w-full bg-[#182d5c] hover:bg-[#2d3a6f] text-white py-4 rounded-2xl font-medium transition">

            Masuk

        </button>

        <!-- REGISTER -->
        <p class="text-center text-sm text-gray-500">

            Belum punya akun?

            <a href="{{ route('register') }}"
                class="text-[#182d5c] font-semibold hover:underline">

                Register

            </a>

        </p>

    </form>

</x-guest-layout>