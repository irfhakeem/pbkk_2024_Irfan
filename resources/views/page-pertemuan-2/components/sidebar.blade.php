<html>
<div class="col-span-2 bg-white border-r-2 border-[#f3f3f3] shadow-xl h-screen">
    <div class="flex flex-col gap-10 items-center justify-center my-10">
        {{-- Logo --}}
        <div>
            <img src="" alt="">
            <p class="text-2xl font-bold text-[#229799]">MED<span class="font-medium text-gray-400">Plus</span></p>
        </div>
        {{-- Avatar --}}
        <div class="flex flex-col gap-2 items-center">
            <img src="" alt="" class="rounded-full w-10 h-10 object-cover">
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = ! dropdownOpen"
                    class="relative flex items-center overflow-hidden focus:outline-none gap-3">
                    <p class="text-black">{{ Auth::user()->name }}</p>
                </button>

                <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false"
                    class="fixed inset-0 z-10 w-full h-full"></div>

                <div x-cloak x-show="dropdownOpen"
                    class="absolute left-0 right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
                    <a href=" {{ route('profile.show') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                    @role('admin')
                        <p>Kamu admin</p>
                    @endrole
                    @role('patient')
                        <p>Kamu pasien</p>
                    @endrole
                    @role('doctor')
                        <p>Kamu dokter</p>
                    @endrole
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
        {{-- List --}}
        <ul id="sidebar-links">
            <!-- Links JavaScript -->
        </ul>
    </div>
</div>

<script>
    const links = [{
            title: 'Dashboard',
            url: '{{ route('dashboard') }}',
            icon: `<svg xmlns="http://www.w3.org/2000/svg" height="20" width="auto" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm64 192c17.7 0 32 14.3 32 32l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96c0-17.7 14.3-32 32-32zm64-64c0-17.7 14.3-32 32-32s32 14.3 32 32l0 192c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-192zM320 288c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32c0-17.7 14.3-32 32-32z"/></svg>`
        },
        {
            title: 'Patients',
            url: '{{ route('pasien') }}',
            icon: ''
        },
        {
            title: 'Doctors',
            url: '{{ route('doctor') }}',
            icon: ''
        },
        {
            title: 'Medical Reports',
            url: '{{ route('medicalReport') }}',
            icon: ''
        },
        {
            title: 'Specialization',
            url: '{{ route('specialization') }}',
            icon: ''
        },
        {
            title: 'Health Centers',
            url: '{{ route('healthCenter') }}',
            icon: ''
        },
        {
            title: 'Drugs',
            url: '{{ route('drug') }}',
            icon: ''
        },
        {
            title: 'Prescriptions',
            url: '{{ route('prescription') }}',
            icon: ''
        },
        {
            title: 'Appointments',
            url: '{{ route('appointment') }}',
            icon: ''
        },
        {
            title: 'Services',
            url: '{{ route('service') }}',
            icon: ''
        },
    ];

    const sidebarLinks = document.getElementById('sidebar-links');
    let isActive = localStorage.getItem('activeLink') || 'Dashboard';

    links.map(link => {
        const li = document.createElement('li');
        li.innerHTML = `
            <a href="${link.url}" class="my-2 flex items-center justify-start px-5 py-2 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] transition-colors ease-in-out duration-100 hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer ${link.title === isActive ? 'bg-gradient-to-r from-[#229799] to-[#22979940] shadow-[#22979960] shadow-md text-white' : 'text-gray-400'}">
                <p class="text-md flex-1">${link.title}</p>
            </a>
        `;
        li.addEventListener('click', () => {
            isActive = link.title;
            localStorage.setItem('activeLink', isActive);
            updateActiveState();
        });
        sidebarLinks.appendChild(li);
    });

    function updateActiveState() {
        const links = sidebarLinks.querySelectorAll('a');
        links.forEach(link => {
            if (link.textContent.trim() === isActive) {
                link.classList.add('bg-[#22979930]');
            } else {
                link.classList.remove('bg-[#22979930]');
            }
        });
    }

    updateActiveState();
</script>

</html>
