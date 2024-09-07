<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PBKK 2024 Irfan</title>
</head>


<body>
    <header>
        <nav class="bg-[#333] w-full py-3 border-b-[1px] border-[#111] px-10">
            <div class="flex justify-between items-center mx-auto">
                <p class="text-white font-bold text-lg">PBKK</p>
            </div>
        </nav>
    </header>
    <div class="bg-white grid grid-cols-8 text-white">
        <div class="col-span-2 left-0 bg-[#333] h-screen">
            <div class="flex flex-col ">
                <div class="bg-[#222] py-5 px-5">
                    <p class=" text-white">
                        Muhammad <span class="font-bold">Irfan Hakim</span>
                    </p>
                </div>
                {{-- List Number Model --}}
                <div>
                    <!-- Tambahkan CDN Alpine.js di bagian <head> jika belum -->
                    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                    <ul class="flex flex-col" data-widget="treeview" role="menu" data-accordion="false">
                        <li x-data="{ open: false }">
                            <a href="#" @click="open = !open"
                                class="flex items-center p-2 text-white hover:bg-[#222] cursor-pointer">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                <p class="text-lg font-medium flex-1">
                                    Pertemuan 1
                                </p>
                                <i class="fas fa-angle-left transition-transform duration-200"
                                    :class="{ 'rotate-90': open }"></i>
                            </a>

                            <ul x-show="open" x-collapse class="mt-2 space-y-1">
                                <li>
                                    <a href="{{ route('param') }}"
                                        class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                        <i class="far fa-circle nav-icon mr-2"></i>
                                        <p>Routing Parameter</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('basic') }}"
                                        class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                        <i class="far fa-circle nav-icon mr-2"></i>
                                        <p>Basic Routing</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('fallback') }}"
                                        class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                        <i class="far fa-circle nav-icon mr-2"></i>
                                        <p>Fallback Routing</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('different-named') }}"
                                        class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                        <i class="far fa-circle nav-icon mr-2"></i>
                                        <p>Named Routing</p>
                                    </a>
                                </li>

                                <ul class="flex flex-col" data-widget="treeview" role="menu" data-accordion="false">
                                    <li x-data="{ open: false }">
                                        <a href="#" @click="open = !open"
                                            class="flex items-center p-2 text-white hover:bg-[#222] cursor-pointer">
                                            <i class="fas fa-tachometer-alt mr-2"></i>
                                            <p class="text-lg font-medium flex-1">
                                                Group Routing
                                            </p>
                                            <i class="fas fa-angle-left transition-transform duration-200"
                                                :class="{ 'rotate-90': open }"></i>
                                        </a>

                                        <ul x-show="open" x-collapse class="mt-2 space-y-1">
                                            <li>
                                                <a href="{{ route('group-page') }}"
                                                    class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                                    <i class="far fa-circle nav-icon mr-2"></i>
                                                    <p>Page Group</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                                <br>

                                <li>
                                    <a href="{{ route('genap-ganjil') }}"
                                        class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                        <i class="far fa-circle nav-icon mr-2"></i>
                                        <p>Genap Ganjil</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('fibonacci') }}"
                                        class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                        <i class="far fa-circle nav-icon mr-2"></i>
                                        <p>Fibonacci</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('bilangan-prima') }}"
                                        class="flex items-center p-2 text-white hover:bg-[#222] rounded">
                                        <i class="far fa-circle nav-icon mr-2"></i>
                                        <p>Bilangan Prima</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-span-6 flex flex-col px-10 py-4 text-black gap-10">
            <p class="text-3xl font-bold ">
                @yield('title')
            </p>
            @yield('content')
        </div>
    </div>

    <footer>
        @include('components.footer')
    </footer>

    @yield('script')
</body>

</html>
