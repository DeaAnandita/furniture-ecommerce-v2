@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-6 mb-10">

    <!-- HEADER -->
    <div>

        <p class="uppercase tracking-[4px] text-[11px] md:text-sm text-[#8B5E3C] mb-3">
            Account
        </p>

        <h1 class="text-3xl md:text-4xl font-bold hero-title">
            My Profile
        </h1>

    </div>

    <!-- PROFILE INFO -->
    <div class="bg-white border border-[#E8DED1] rounded-[30px] p-6 md:p-8 shadow-sm">

        <div class="max-w-xl">

            @include('profile.partials.update-profile-information-form')

        </div>

    </div>

    <!-- PASSWORD -->
    <div class="bg-white border border-[#E8DED1] rounded-[30px] p-6 md:p-8 shadow-sm">

        <div class="max-w-xl">

            @include('profile.partials.update-password-form')

        </div>

    </div>

    <!-- DELETE ACCOUNT -->
    <div class="bg-white border border-red-100 rounded-[30px] p-6 md:p-8 shadow-sm">

        <div class="max-w-xl">

            @include('profile.partials.delete-user-form')

        </div>

    </div>

</div>

@endsection