@extends('layout.base')

@section('title', 'Bilangan Prima')

@section('content')
    <div>
        <h1>Masukkan Angka</h1>
        <form action="#" method="GET">
            <label for="n">Enter a number (n):</label>
            <input type="text" name="n" id="n" min="1" class="border-[1px] border-black" required>
            <button type="submit">Submit</button>
        </form>

        @if (count($numberDetails) > 0)
            <h2>Hasil</h2>
            <table>
                <thead>
                    <tr>
                        <th class="border-[1px] border-black">Nomor Urut</th>
                        <th class="border-[1px] border-black">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($numberDetails as $detail)
                        <tr>
                            <td class="border-[1px] border-black">{{ $detail['number'] }}</td>
                            <td class="border-[1px] border-black">{{ $detail['type'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    @endif
@endsection
