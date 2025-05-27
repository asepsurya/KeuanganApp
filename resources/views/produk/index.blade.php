@extends('layout.main')
@section('title', 'Data Produk')
@section('container')
<div class="px-2 py-1 mb-4 flex items-center justify-between">
    <h2 class="text-lg font-semibold">Produk Saya</h2>
    <button class="px-2 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition" @click="toggle">
        + Tambah Produk Baru
    </button>
</div>
<div class="py-3">
    <input type="text" placeholder="Cari Produk..." class="form-input py-2.5 px-4 w-full text-black dark:text-white border border-black/10 dark:border-white/10 rounded-lg placeholder:text-black/20 dark:placeholder:text-white/20 focus:border-black dark:focus:border-white/10 focus:ring-0 focus:shadow-none;" required="" data-listener-added_87712baf="true">
</div>
<div class="border bg-lightwhite dark:bg-white/5 dark:border-white/10 border-black/10 p-5 rounded-md">
    <div class="table-responsive">
        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="text-gray-400">
                    <th class="text-left pl-6 py-3 font-normal w-1/2">
                        Product
                    </th>
                    <th class="text-left font-normal w-1/6">
                        Create at
                    </th>
                    <th class="text-left font-normal w-1/6">
                        Status
                    </th>
                    <th class="text-left font-normal w-1/6 pr-6">
                        Amount
                    </th>
                    <th class="w-6">
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <!-- Row 1 -->
                <tr class="hover:bg-gray-50">
                    <td class="flex items-start gap-3 py-4 pl-6">
                        <input class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" type="checkbox" />
                        <img alt="Black Nike Air Zoom Pegasus 37 shoe on white background" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/5fb5073a-6842-41ed-0330-75a7a092a9c6.jpg" width="48" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 leading-tight">
                                Nike Air Zoom Pegasus 37 A.I.R. Chaz Bear
                            </span>
                            <span class="text-gray-400 leading-tight truncate max-w-[280px]">
                                Donec posuere vulputate arcu. Praesent turpis...
                            </span>
                        </div>
                    </td>
                    <td class="py-4 font-normal text-gray-500">
                        01 Jul 2020
                    </td>
                    <td class="py-4">
                        <span class="inline-block rounded px-2 py-0.5 text-xs font-semibold text-green-700 bg-green-100">
                            In stock
                        </span>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        $23.42
                    </td>
                    <td class="py-4 pr-6 text-gray-400 cursor-pointer">
                        <i class="fas fa-ellipsis-v">
                        </i>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr class="hover:bg-gray-50">
                    <td class="flex items-start gap-3 py-4 pl-6">
                        <input class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" type="checkbox" />
                        <img alt="Red Nike Air Max 270 React ENG shoe on white background" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/3fd382c7-9c91-483d-8307-b503692235ba.jpg" width="48" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 leading-tight">
                                Nike Air Max 270 React ENG
                            </span>
                            <span class="text-gray-400 leading-tight truncate max-w-[280px]">
                                Donec posuere vulputate arcu. Praesent turpis...
                            </span>
                        </div>
                    </td>
                    <td class="py-4 font-normal text-gray-500">
                        16 Jan 2021
                    </td>
                    <td class="py-4">
                        <span class="inline-block rounded px-2 py-0.5 text-xs font-semibold text-red-700 bg-red-100">
                            Out of stock
                        </span>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        $23.42
                    </td>
                    <td class="py-4 pr-6 text-gray-400 cursor-pointer">
                        <i class="fas fa-ellipsis-v">
                        </i>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="hover:bg-gray-50">
                    <td class="flex items-start gap-3 py-4 pl-6">
                        <input class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" type="checkbox" />
                        <img alt="Pink Nike ZoomX SuperRep Surge shoe on white background" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/7d7c57c6-5c1c-4751-3c34-b320ef6b37b5.jpg" width="48" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 leading-tight">
                                Nike ZoomX SuperRep Surge
                            </span>
                            <span class="text-gray-400 leading-tight truncate max-w-[280px]">
                                Donec posuere vulputate arcu. Praesent turpis...
                            </span>
                        </div>
                    </td>
                    <td class="py-4 font-normal text-gray-500">
                        17 May 2021
                    </td>
                    <td class="py-4">
                        <span class="inline-block rounded px-2 py-0.5 text-xs font-semibold text-yellow-700 bg-yellow-100">
                            Low stock
                        </span>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        $23.42
                    </td>
                    <td class="py-4 pr-6 text-gray-400 cursor-pointer">
                        <i class="fas fa-ellipsis-v">
                        </i>
                    </td>
                </tr>
                <!-- Row 4 -->
                <tr class="hover:bg-gray-50">
                    <td class="flex items-start gap-3 py-4 pl-6">
                        <input class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" type="checkbox" />
                        <img alt="Orange Kyrie 7 EP Sisterhood shoe on white background" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/d503bdb9-45be-448a-563c-86de475536ff.jpg" width="48" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 leading-tight">
                                Kyrie 7 EP Sisterhood
                            </span>
                            <span class="text-gray-400 leading-tight truncate max-w-[280px]">
                                Donec posuere vulputate arcu. Praesent turpis...
                            </span>
                        </div>
                    </td>
                    <td class="py-4 font-normal text-gray-500">
                        13 Aug 2021
                    </td>
                    <td class="py-4">
                        <span class="inline-block rounded px-2 py-0.5 text-xs font-semibold text-red-700 bg-red-100">
                            Out of stock
                        </span>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        $23.42
                    </td>
                    <td class="py-4 pr-6 text-gray-400 cursor-pointer">
                        <i class="fas fa-ellipsis-v">
                        </i>
                    </td>
                </tr>
                <!-- Row 5 -->
                <tr class="hover:bg-gray-50">
                    <td class="flex items-start gap-3 py-4 pl-6">
                        <input class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" type="checkbox" />
                        <img alt="Orange Nike Air Max Zephyr shoe on white background" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/b63f7756-a731-4c8a-3bfc-08f28b236f8e.jpg" width="48" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 leading-tight">
                                Nike Air Max Zephyr
                            </span>
                            <span class="text-gray-400 leading-tight truncate max-w-[280px]">
                                Donec posuere vulputate arcu. Praesent turpis...
                            </span>
                        </div>
                    </td>
                    <td class="py-4 font-normal text-gray-500">
                        04 Jul 2021
                    </td>
                    <td class="py-4">
                        <span class="inline-block rounded px-2 py-0.5 text-xs font-semibold text-yellow-700 bg-yellow-100">
                            Low stock
                        </span>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        $23.42
                    </td>
                    <td class="py-4 pr-6 text-gray-400 cursor-pointer">
                        <i class="fas fa-ellipsis-v">
                        </i>
                    </td>
                </tr>
                <!-- Row 6 -->
                <tr class="hover:bg-gray-50">
                    <td class="flex items-start gap-3 py-4 pl-6">
                        <input class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" type="checkbox" />
                        <img alt="Gray Nike Space Hippie 04 shoe on white background" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/bbbf2eef-83f0-4bad-b3e4-32aab6e3fd8f.jpg" width="48" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 leading-tight">
                                Nike Space Hippie 04
                            </span>
                            <span class="text-gray-400 leading-tight truncate max-w-[280px]">
                                Donec posuere vulputate arcu. Praesent turpis...
                            </span>
                        </div>
                    </td>
                    <td class="py-4 font-normal text-gray-500">
                        24 May 2019
                    </td>
                    <td class="py-4">
                        <span class="inline-block rounded px-2 py-0.5 text-xs font-semibold text-green-700 bg-green-100">
                            In stock
                        </span>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        $23.42
                    </td>
                    <td class="py-4 pr-6 text-gray-400 cursor-pointer">
                        <i class="fas fa-ellipsis-v">
                        </i>
                    </td>
                </tr>
                <!-- Row 7 -->
                <tr class="hover:bg-gray-50">
                    <td class="flex items-start gap-3 py-4 pl-6">
                        <input class="mt-1 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" type="checkbox" />
                        <img alt="Blue NikeCourt Royale shoe on white background" class="h-12 w-12 rounded-lg object-cover flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/4611c41e-42b3-4df2-eae1-9a92a0e26a1c.jpg" width="48" />
                        <div class="flex flex-col">
                            <span class="font-semibold text-gray-900 leading-tight">
                                NikeCourt Royale
                            </span>
                            <span class="text-gray-400 leading-tight truncate max-w-[280px]">
                                Donec posuere vulputate arcu. Praesent turpis...
                            </span>
                        </div>
                    </td>
                    <td class="py-4 font-normal text-gray-500">
                        29 Aug 2019
                    </td>
                    <td class="py-4">
                        <span class="inline-block rounded px-2 py-0.5 text-xs font-semibold text-yellow-700 bg-yellow-100">
                            Low stock
                        </span>
                    </td>
                    <td class="py-4 font-semibold text-gray-900">
                        $23.42
                    </td>
                    <td class="py-4 pr-6 text-gray-400 cursor-pointer">
                        <i class="fas fa-ellipsis-v">
                        </i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
