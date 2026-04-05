<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chi tiết chuyến đi: {{ $trip->destination_name }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">← Quay lại</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($trip->days as $day)
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
                <div class="p-4 bg-blue-50 border-b border-blue-100">
                    <h3 class="font-bold text-blue-700 uppercase tracking-wide">Ngày {{ $day->day_index }}</h3>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($day->items as $item)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mt-1.5"></div>
                            <div class="w-0.5 h-full bg-gray-200"></div>
                        </div>
                        <div class="pb-6">
                            <span class="text-xs font-bold text-gray-400 uppercase">{{ $item->start_time }} -
                                {{ $item->end_time }}</span>
                            <h4 class="text-lg font-semibold text-gray-800 leading-tight">{{ $item->location->name }}
                            </h4>
                            <p class="text-sm text-gray-500 mt-1 italic">Vị trí: {{ $item->location->lat }},
                                {{ $item->location->lng }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>