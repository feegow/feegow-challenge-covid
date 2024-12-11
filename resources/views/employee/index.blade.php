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
                                        birthday
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-50 w-10">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        comorbidity
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-200 bg-slate-50 w-10">
                                    <p class="text-sm font-normal leading-none text-slate-500">
                                        doses
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
                            @foreach ($employees as $employee)
                                <tr class="hover:bg-slate-50 border-b border-slate-200 text-center capitalize">
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
                                        <p class="text-sm text-slate-500">{{$employee->comorbidity ? 'YES' : 'NO'}}</p>
                                    </td>
                                    <td class="p-4 py-5">
                                        <p class="text-sm text-slate-500">#</p>
                                    </td>
                                    <td class="p-4 py-5">
                                        <div class="flex space-x-2 justify-center" x-data>
                                            <a href="{{route('employee.update', $employee->id)}}" class="flex cursor-pointer justify-center items-center rounded-md p-2 shadow-lg bg-slate-500 text-white hover:bg-slate-400">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                <span class="capitalize text-sm h-auto">Edit</span>
                                            </a>
                                            <x-confirm-modal title="Delete employee">
                                                <x-slot name="button">
                                                    <div class="flex justify-center items-center rounded-md p-2 shadow-lg bg-red-500 text-white hover:bg-red-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        <span class="capitalize text-sm h-auto">Delete</span>
                                                    </div>
                                                </x-slot>
                                                <span>Are you sure you want to delete the employee {{ $employee->user->name }} ?</span>
                                                <x-slot name="confirm">
                                                    <form action="{{route('employee.delete', $employee->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{$employee->id}}">
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

                    <div class="flex justify-between items-center px-4 py-3 max-w-2xl">
                        {{ $employees->links() }}
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
