@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8 mt-8">

        <p class="uppercase tracking-[3px] text-[11px] text-[#8B5E3C] mb-2">
            Product Management
        </p>

        <h1 class="text-2xl md:text-3xl font-bold text-[#2B2B2B]">
            Edit Product
        </h1>

    </div>

    <!-- FORM -->
    <div class="bg-white border border-[#EFE7DC] rounded-[36px] shadow-sm overflow-hidden">

        <form action="/admin/products/{{ $product->id }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-5 md:p-8">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- NAME -->
                <div>

                    <label class="block mb-3 font-medium">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ $product->name }}"
                           class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-2xl px-5 py-4">

                </div>

                <!-- PRICE -->
                <div>

                    <label class="block mb-3 font-medium">
                        Price
                    </label>

                    <input type="number"
                           name="price"
                           value="{{ $product->price }}"
                           class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-2xl px-5 py-4">

                </div>

                <!-- STOCK -->
                <div>

                    <label class="block mb-3 font-medium">
                        Stock
                    </label>

                    <input type="number"
                           name="stock"
                           value="{{ $product->stock }}"
                           class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-2xl px-5 py-4">

                </div>

                <!-- CATEGORY -->
                <div>

                    <label class="block mb-3 font-medium">
                        Category
                    </label>

                    <select name="category_id"
                            class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-2xl px-5 py-4">

                        @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- MATERIAL -->
                <div>

                    <label class="block mb-3 font-medium">
                        Material
                    </label>

                    <select name="material_id"
                            class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-2xl px-5 py-4">

                        @foreach($materials as $material)

                        <option value="{{ $material->id }}"
                            {{ $product->material_id == $material->id ? 'selected' : '' }}>

                            {{ $material->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- STYLE -->
                <div>

                    <label class="block mb-3 font-medium">
                        Style
                    </label>

                    <select name="style_id"
                            class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-2xl px-5 py-4">

                        @foreach($styles as $style)

                        <option value="{{ $style->id }}"
                            {{ $product->style_id == $style->id ? 'selected' : '' }}>

                            {{ $style->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <!-- DESCRIPTION -->
            <div class="mt-6">

                <label class="block mb-3 font-medium">
                    Description
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-3xl px-5 py-4">{{ $product->description }}</textarea>

            </div>

            <!-- IMAGE -->
            <div class="mt-6">

                <label class="block mb-3 font-medium">
                    Product Image
                </label>

                <input type="file"
                       name="image"
                       class="w-full bg-[#FAF7F2] border border-[#E7DED3] rounded-2xl px-5 py-4">

            </div>

            <!-- BUTTON -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4">

                <button type="submit"
                        class="bg-[#8B5E3C] hover:bg-[#6B4636] transition text-white px-8 py-4 rounded-2xl font-medium">

                    Update Produk

                </button>

                <a href="/admin/products"
                   class="bg-[#F5EFE6] hover:bg-[#ECE2D4] transition text-[#7D5548] px-8 py-4 rounded-2xl font-medium text-center">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection