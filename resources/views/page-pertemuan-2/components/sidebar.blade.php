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
            <img src="https://matafoto.co/wp-content/uploads/2021/03/merah-min.jpg" alt=""
                class="rounded-full w-10 h-10 object-cover">
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
            @role('admin')
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Dashboard</p>
                    </a>
                </li>
            @endrole
            @role('patient')
                <li>
                    <a href="{{ route('dashboardPatient') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('dashboardPatient') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('medicalReportsPatient') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('medicalReportsPatient') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">My Medical Report</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('prescription') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('prescription') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">My Prescriptions</p>
                    </a>
                </li>
            @endrole
            @role('doctor')
                <li>
                    <a href="{{ route('dashboardDoctor') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('dashboardDoctor') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Dashboard</p>
                    </a>
                </li>
            @endrole
            @can('add patients')
                <li>
                    <a href="{{ route('pasien') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('pasien') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Patients</p>
                    </a>
                </li>
            @endcan
            @can('add doctors')
                <li>
                    <a href="{{ route('doctor') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('doctor') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Doctors</p>
                    </a>
                </li>
            @endcan
            @can('add medical reports')
                <li>
                    <a href="{{ route('medicalReport') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('medicalReport') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Medical Reports</p>
                    </a>
                </li>
            @endcan
            @can('add specializations')
                <li>
                    <a href="{{ route('specialization') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('specialization') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Specializations</p>
                    </a>
                </li>
            @endcan
            @can('add health centers')
                <li>
                    <a href="{{ route('healthCenter') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('healthCenter') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Health Centers</p>
                    </a>
                </li>
            @endcan
            @can('add drugs')
                <li>
                    <a href="{{ route('drug') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('drug') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Drugs</p>
                    </a>
                </li>
            @endcan
            @can('add prescriptions')
                <li>
                    <a href="{{ route('prescription') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('prescription') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Prescriptions</p>
                    </a>
                </li>
            @endcan
            <li>
                <a href="{{ route('appointment') }}"
                    class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('appointment') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                    <p class="text-md flex-1">Appointments</p>
                </a>
            </li>
            @can('add services')
                <li>
                    <a href="{{ route('service') }}"
                        class="my-2 flex items-center justify-start px-5 py-2 transition-colors ease-in-out duration-100 hover:bg-gradient-to-r from-[#22979960] to-[#22979930] hover:text-white hover:shadow-[#22979930] hover:shadow-md rounded-full cursor-pointer text-gray-400 {{ request()->routeIs('service') ? 'bg-gradient-to-r from-[#229799] to-[#22979960] shadow-[#22979960] shadow-md text-white' : '' }}">
                        <p class="text-md flex-1">Services</p>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>

</html>
