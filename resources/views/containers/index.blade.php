@extends('layouts.app')

@section('content')
    <h1 class="text-2x1 font-bold mb-4">Daftar Container</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Nomor Container</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Shipper</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Consignee</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Lokasi Bongkar</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Tanggal Muat</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Tanggal Bongkar</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Kapal</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Tanggal ETD</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Tanggal ETA</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">Aksi</th>

                </tr>
                <livewire:container-grid />
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
