<div class="mt-4">
    <div class="max-w-screen-xl bg-white rounded-lg mx-auto px-2 py-4">
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Vaccines</h3>
                <p class="text-slate-500">Feegow Clinic available vaccines</p>
            </div>
            <div class="ml-3 w-1/2">
                <div class="w-full min-w-52 flex space-x-3 items-center relative">
                    <div class="flex min-w-max">
                        <a class="cursor-pointer flex rounded-md space-x-2 px-2 py-3 bg-slate-200 hover:bg-slate-300" href="{{ route('vaccine.create') }}">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="800px" width="800px" version="1.1" id="Capa_1" viewBox="0 0 183.153 183.153" xml:space="preserve">
                                <g>
                                    <path d="M182.274,0.879c-1.171-1.172-3.071-1.172-4.242,0L145.331,33.58c-1.5-0.209-3.074,0.245-4.227,1.398l-9.146,9.146   l-11.538-11.537c-1.953-1.952-5.118-1.952-7.071,0l-76.01,76.01l-1.521-1.521c-1.953-1.952-5.118-1.952-7.071,0   c-1.953,1.953-1.953,5.119,0,7.071l5.057,5.057l11.538,11.538l-27.828,27.827l-8.978-8.978c-1.953-1.952-5.118-1.952-7.071,0   c-1.953,1.953-1.953,5.119,0,7.071l25.027,25.027c0.977,0.976,2.256,1.464,3.536,1.464c1.279,0,2.559-0.488,3.536-1.464   c1.953-1.953,1.953-5.119,0-7.071l-8.978-8.978l27.828-27.827L63.95,149.35l5.057,5.057c0.977,0.976,2.256,1.464,3.536,1.464   s2.559-0.488,3.536-1.464c1.953-1.953,1.953-5.119,0-7.071l-1.521-1.521l76.01-76.01c0.938-0.938,1.464-2.209,1.464-3.536   s-0.527-2.598-1.464-3.536L139.03,51.195l9.146-9.146c1.153-1.153,1.607-2.728,1.398-4.227l32.7-32.7   C183.446,3.95,183.446,2.05,182.274,0.879z M67.486,138.743L44.41,115.667l14.417-14.417l11.538,11.538   c0.585,0.586,1.354,0.879,2.121,0.879s1.536-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L63.07,97.008l7.128-7.128   l11.538,11.538c0.585,0.585,1.354,0.878,2.121,0.878s1.536-0.293,2.122-0.879c1.171-1.171,1.171-3.071,0-4.243L74.441,85.637   l7.128-7.128l11.538,11.538c0.585,0.586,1.354,0.879,2.121,0.879s1.536-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242   L85.812,74.266l7.128-7.128l11.537,11.538c0.586,0.586,1.354,0.879,2.122,0.879c0.768,0,1.536-0.293,2.121-0.878   c1.172-1.172,1.172-3.071,0-4.243L97.183,62.895l19.702-19.702l23.075,23.075L67.486,138.743z"/>
                                </g>
                            </svg>
                            <span class="text-base"> New Vaccine </span>
                        </a>
                    </div>
                    <div class="relative w-4/5">
                        <input
                            wire:model.live='search'
                            class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Search for vaccine name or batch" />
                        <button
                            class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="currentColor" class="w-8 h-8 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            @if(!empty($this->vaccines->items()))
                <table class="w-full table-auto min-w-max">
                    <thead>
                        <tr class="uppercase">
                            <th class="p-4 border-b border-slate-200 bg-slate-50 w-10">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    id
                                </p>
                            </th>
                            <th class="p-4 border-b border-slate-200 bg-slate-50 w-40">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    name
                                </p>
                            </th>
                            <th class="p-4 border-b border-slate-200 bg-slate-50 w-32">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    batch
                                </p>
                            </th>
                            <th class="p-4 border-b border-slate-200 bg-slate-50 w-10">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    expiry
                                </p>
                            </th>
                            <th class="p-4 border-b border-slate-200 bg-slate-50 w-10">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    actions
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->vaccines as $vaccine)
                            <tr class="hover:bg-slate-50 border-b border-slate-200 text-center capitalize">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800 uppercase">{{ $vaccine->id }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $vaccine->name }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $vaccine->batch }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $vaccine->expiryFormatted }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <div class="flex space-x-2 justify-center" x-data>
                                        <a href="{{route('vaccine.update', $vaccine->id)}}" class="flex cursor-pointer justify-center items-center rounded-md p-2 shadow-lg bg-slate-500 text-white hover:bg-slate-400">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            <span class="capitalize text-sm h-auto">Edit</span>
                                        </a>
                                        <x-confirm-modal title="Remove vaccine">
                                            <x-slot name="button">
                                                <div class="flex justify-center items-center rounded-md p-2 shadow-lg bg-red-500 text-white hover:bg-red-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    <span class="capitalize text-sm h-auto">Delete</span>
                                                </div>
                                            </x-slot>
                                            <span>Are you sure you want to remove the vaccine {{ $vaccine->name }} from the storage ?</span>
                                            <x-slot name="confirm">
                                                <form action="{{route('vaccine.delete', $vaccine->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$vaccine->id}}">
                                                    <button type="submit" class="p-2 bg-red-600 hover:bg-red-500 text-white rounded-md">
                                                        {{__('Delete')}}
                                                    </button>
                                                </form>
                                            </x-slot>
                                        </x-confirm-modal>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-4 py-3">
                    {{ $this->vaccines->links() }}
                </div>
            @else
                <div class="flex items-center justify-center h-20 border rounded-lg">
                    <span class="capitalize text-lg text-slate-500">No vaccines register found</span>
                </div>
            @endif
        </div>
    </div>
</div>
