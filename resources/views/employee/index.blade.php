<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>
    <div class="mt-4">
        <div class="max-w-screen-xl bg-white rounded-lg mx-auto px-2 py-4">
            <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Employees</h3>
                    <p class="text-slate-500">Feegow Clinic employees team</p>
                </div>
                <div class="ml-3">
                    <div class="w-full max-w-sm min-w-52 flex space-x-3 items-center relative">
                        <div class="flex">
                            <a class="cursor-pointer flex rounded-md space-x-2 px-2 py-3 bg-slate-200 hover:bg-slate-300" href="{{ route('employee.create') }}">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                <span class="text-base"> Add Employee</span>
                            </a>
                        </div>
                        <div class="relative">
                            <input
                                class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                                placeholder="Search for employee..." />
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
                @if(!empty($employees->items()))
                    <table class="w-full text-left table-auto min-w-max">
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
                                        birthday
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-50 w-10">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        comorbidity
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="hover:bg-slate-50 border-b border-slate-200 capitalize">
                                    <td class="p-4 py-5">
                                        <p class="block font-semibold text-sm text-slate-800 uppercase">{{ $employee->id }}</p>
                                    </td>
                                    <td class="p-4 py-5">
                                        <p class="text-sm text-slate-500">{{ $employee->user->name }}</p>
                                    </td>
                                    <td class="p-4 py-5">
                                        <p class="text-sm text-slate-500">{{ $employee->birthday }}</p>
                                    </td>
                                    <td class="p-4 py-5">
                                        <p class="text-sm text-slate-500">{{$employee->comorbidity}}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-between items-center px-4 py-3">
                        {{ $employees->links() }}
                        {{-- <div class="text-sm text-slate-500">
                            Showing <b>1-5</b> of 45
                        </div>
                        <div class="flex space-x-1">
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                                Prev
                            </button>
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-slate-800 border border-slate-800 rounded hover:bg-slate-600 hover:border-slate-600 transition duration-200 ease">
                                1
                            </button>
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                                2
                            </button>
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                                3
                            </button>
                            <button
                                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                                Next
                            </button>
                        </div> --}}
                    </div>
                @else
                    <div class="flex items-center justify-center h-20 border rounded-lg">
                        <span class="capitalize text-lg text-slate-500">No employees register found</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
