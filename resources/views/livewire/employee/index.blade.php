<div class="mt-4">
    <div class="max-w-screen-xl bg-white rounded-lg mx-auto px-2 py-4">
        <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">Employees</h3>
                <p class="text-slate-500">Feegow Clinic employees team</p>
            </div>
            <div class="ml-3 w-1/2">
                <div class="w-full min-w-52 flex space-x-3 items-center relative">
                    <div class="flex min-w-max">
                        <a class="cursor-pointer flex rounded-md space-x-2 px-2 py-3 bg-slate-200 hover:bg-slate-300" href="{{ route('employee.create') }}">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                            <span class="text-base"> Add Employee</span>
                        </a>
                    </div>
                    <div class="relative w-4/5">
                        <input
                            wire:model.live='search'
                            class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Search for employee name" />
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
            @if(!empty($this->employees->items()))
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
                        @foreach ($this->employees as $employee)
                            <tr class="hover:bg-slate-50 border-b border-slate-200 text-center capitalize">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800 uppercase">{{ $employee->id }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $employee->user->name }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{ $employee->birthdayFormatted }}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="text-sm text-slate-500">{{$employee->comorbidity ? 'YES' : 'NO'}}</p>
                                </td>
                                <td class="p-4 py-5">
                                    @if($employee->doses_count > 0)
                                    <x-confirm-modal title="Doses information">
                                        <x-slot name="button" >
                                            <p class="text-sm text-slate-500 py-2 px-4 rounded-md hover:bg-slate-300">{{$employee->doses_count}}</p>
                                        </x-slot>
                                        <div class="flex flex-col space-y-4 ">
                                            @foreach ($employee->doses as $dose)
                                                <div class="flex flex-col p-4 space-x-2 w-full border shadow-md rounded-lg">
                                                    <span>Pacient: {{ $employee->user->name }}</span>
                                                    <span>Vaccine: {{ $dose->vaccine->name }}</span>
                                                    <span>Date: {{ $dose->doseDateFormatted }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </x-confirm-modal>
                                    @else
                                        <p class="text-sm text-slate-500">0</p>
                                    @endif
                                </td>
                                <td class="p-4 py-5">
                                    <div class="flex space-x-2 justify-center" x-data>
                                        <a href="{{route('vaccine.apply', $employee->id)}}" class="flex cursor-pointer justify-center items-center rounded-md shadow-lg bg-green-700 text-white hover:bg-green-600">
                                            <div class="flex justify-center items-center p-3">
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" height="800px" width="800px" version="1.1" id="Layer_1" viewBox="0 0 509.397 509.397" xml:space="preserve">
                                                    <g transform="translate(1 1)">
                                                        <g>
                                                            <g>
                                                                <path d="M475.42,51.068l-12.149-12.149l-25.166-25.166L425.956,1.603c-3.471-3.471-8.678-3.471-12.149,0s-3.471,8.678,0,12.149     l6.136,6.136l-30.925,31.556l-30.75-30.75c-3.471-3.471-8.678-3.471-12.149,0L321.82,44.993     c-1.736,1.736-2.603,3.471-2.603,6.075s0.868,4.339,2.603,6.075l6.075,6.075L297.522,93.59c-0.147,0.147-0.279,0.301-0.414,0.454     c-0.153,0.135-0.307,0.266-0.454,0.414l-95.457,95.457c0,0-0.001,0.001-0.001,0.001l-26.902,26.902     c-3.471,3.471-3.471,8.678,0,12.149l19.091,19.092l-18.224,18.224c-0.147,0.147-0.279,0.301-0.413,0.454     c-0.153,0.135-0.307,0.267-0.455,0.414l-26.034,26.034c-7.718,7.718-9.189,18.837-4.427,27.858L58.01,406.864     c-3.471,3.471-3.471,8.678,0,12.149c1.736,1.736,3.471,2.603,6.075,2.603c2.603,0,4.339-0.868,6.075-2.603l85.415-85.415     c3.764,2.445,8.203,3.843,12.646,3.843c6.075,0,12.149-2.603,16.488-7.81l26.034-26.034c0.165-0.165,0.314-0.337,0.464-0.509     c0.136-0.118,0.277-0.231,0.404-0.358l18.224-18.224l18.224,18.224c1.736,1.736,3.471,2.603,6.075,2.603     c2.603,0,4.339-0.868,6.075-2.603l100.664-100.664l21.695-21.695c0.191-0.191,0.368-0.383,0.538-0.576     c0.11-0.098,0.226-0.188,0.329-0.292l30.373-30.373l6.075,6.075c1.736,1.736,3.471,2.603,6.075,2.603s4.339-0.868,6.075-2.603     l24.298-24.298c3.471-3.471,3.471-8.678,0-12.149l-30.373-30.373l31.241-31.241l6.075,6.075c1.736,1.736,3.471,2.603,6.075,2.603     c1.736,0,4.339-0.868,6.075-2.603C478.892,59.746,478.892,54.539,475.42,51.068z M173.427,318.349     c-2.603,2.603-6.942,2.603-9.546,0l-3.471-3.471c-2.603-1.736-2.603-6.075,0-8.678l19.959-19.959l13.017,12.149L173.427,318.349z      M204.668,283.637l-12.149-12.149l12.149-12.149l12.149,12.149L204.668,283.637z M340.044,75.366l12.583,12.583l-24.298,24.298     l-12.583-12.583L340.044,75.366z M340.478,124.397l23.864-23.864l12.149,12.149l-23.864,23.864L340.478,124.397z      M254.132,284.505l-30.496-30.496l-12.026-12.026c0,0,0,0-0.001-0.001l-19.091-19.091l18.224-18.224h123.227L254.132,284.505z      M351.325,187.312H228.098l74.631-74.631l61.614,61.614L351.325,187.312z M377.359,161.278l-12.583-12.583l24.298-24.298     l12.583,12.583L377.359,161.278z M425.956,136.98l-6.075-6.075l-73.763-73.763l-6.075-6.075l12.149-12.149l85.912,85.912     L425.956,136.98z M413.807,75.366l-12.149-12.149l30.373-30.373l12.149,12.149L413.807,75.366z"/>
                                                                <path d="M68.424,434.634c-3.471-3.471-8.678-3.471-12.149,0L38.919,451.99c-6.075,6.075-9.546,14.753-9.546,23.431     s3.471,17.356,9.546,23.43s14.753,9.546,23.43,9.546c8.678,0,17.356-3.471,23.431-9.546s9.546-14.753,9.546-23.43     s-3.471-17.356-9.546-23.431L68.424,434.634z M73.63,486.702c-6.075,6.075-16.488,6.075-22.563,0     c-2.603-3.471-4.339-6.942-4.339-11.281s1.736-8.678,4.339-11.281l11.281-11.281l11.281,11.281     c2.603,3.471,4.339,6.942,4.339,11.281S76.234,484.098,73.63,486.702z"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <span>Apply</span>
                                            </div>
                                        </a>
                                        <a href="{{route('employee.update', $employee->id)}}" class="flex cursor-pointer justify-center items-center rounded-md p-2 shadow-lg bg-slate-500 text-white hover:bg-slate-400">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            <span class="capitalize text-sm h-auto">Edit</span>
                                        </a>
                                        <x-confirm-modal title="Delete employee">
                                            <x-slot name="button">
                                                <div class="flex justify-center items-center rounded-md p-3 shadow-lg bg-red-500 text-white hover:bg-red-300">
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

                <div class="px-4 py-3">
                    {{ $this->employees->links() }}
                </div>
            @else
                <div class="flex items-center justify-center h-20 border rounded-lg">
                    <span class="capitalize text-lg text-slate-500">No employees register found</span>
                </div>
            @endif
        </div>
    </div>
</div>
