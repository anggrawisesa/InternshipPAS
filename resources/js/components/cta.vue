<template>
    <section class="bg-gray-50">
        <div class="p-8 md:p-12 lg:px-16 lg:py-24">
            <div class="mx-auto max-w-lg text-center">
                <h2 class="text-2xl font-bold text-gray-900 md:text-3xl">
                    Temukan Keajaiban Kecantikan dengan Produk Kami
                </h2>

                <p class="hidden text-gray-500 sm:mt-4 sm:block">
                    Jelajahi rangkaian kosmetik kami yang dirancang untuk
                    membuat Anda tampil menawan. Produk berkualitas tinggi,
                    ramah kulit, dan aman digunakan setiap hari.
                </p>
            </div>

            <div class="mx-auto mt-8 max-w-xl">
                <form action="#" class="sm:flex sm:gap-4">
                    <div class="sm:flex-1">
                        <input
                            type="text"
                            placeholder="lipbalm"
                            class="w-full rounded-md border-gray-200 bg-white p-3 text-gray-700 shadow-sm transition focus:border-white focus:outline-none focus:ring focus:ring-indigo-400"
                        />
                    </div>

                    <button
                        type="submit"
                        class="group mt-4 flex w-full items-center justify-center gap-2 rounded-md bg-indigo-600 px-5 py-3 text-white transition focus:outline-none focus:ring focus:ring-indigo-400 sm:mt-0 sm:w-auto"
                    >
                        <span class="text-sm font-medium"> cari barang </span>

                        <svg
                            class="size-5 rtl:rotate-180"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                            />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>
</template>
