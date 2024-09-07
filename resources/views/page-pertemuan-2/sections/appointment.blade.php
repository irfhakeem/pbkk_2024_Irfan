@extends('page-pertemuan-2.layout.base')

@section('title', 'CRUD Appointments')

@section('content')
    <div class="flex justify-end items-center mb-5">
        <button class="bg-[#229799] px-4 py-[0.4rem] rounded-full items-center text-white">
            Add New
        </button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" class="px-4 py-2">
                            {{ ucfirst(str_replace('_', ' ', $column)) }}
                        </th>
                    @endforeach
                    <th scope="col" class="px-4 py-2">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($appointments as $appointment)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200">
                        @foreach ($columns as $column)
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ $appointment->$column }}
                            </td>
                        @endforeach
                        <td class="flex gap-3 px-4 py-2">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('appointment.delete', $appointment->service_id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this appointment with ID: {{ $appointment->service_id }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-blue-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
