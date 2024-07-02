<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('Rate create')
                <a href="{{route('admin.rates.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                    Department</a>
                @endcan
            </div>
            <div class="bg-white rounded my-6 p-5" style="background-color: #FCB22D">
                <h1 class="text-center font-bold">Feedback List</h1>
            </div>
            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse table-auto">
                    <thead class="text-left">
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                                ID
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                Content
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                From
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                To
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                Star
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-center w-2/12">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('Rate access')
                        @foreach($rates as $rate)
                        <tr class="hover:bg-grey-lighter text-start">
                            <td class="py-4 px-4 border-b border-grey-light">{{ $rate->id }}</td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                {{$rate->content}}
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                @if($rate->user->profile)
                                <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="/images/profiles/user-{{$rate->user->first_name}}/{{ $rate->user->profile }}" alt="" />
                                @else
                                <span class="inline-flex bg-gray-500 items-center justify-center h-10 w-10 rounded-full ring-2 ring-white">{{$rate->user->first_name[0]}}{{$rate->user->last_name[0]}}</span>
                                @endif
                                {{$rate->user->first_name.' '.$rate->user->last_name}}
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                {{$rate->hospital->name}}
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                @if($rate->star ===5)
                                <div class="flex items-center">
                                    @for ($i =0; $i < $rate->star; $i++)
                                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    @endfor
                                    <p class="ms-1 ml-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{$rate->star}} out of 5 </p>
                                </div>
                                @else
                                <div class="flex items-center">
                                    @for ($i =0; $i < $rate->star; $i++)
                                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        @endfor
                                        @for ($i =0; $i < (5 - $rate->star); $i++)
                                            <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                            @endfor
                                            <p class="ms-1 text-sm font-medium text-gray-500 ml-2 dark:text-gray-400">{{$rate->star}} out of 5</p>
                                </div>
                                @endif
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light text-right">
                                @can('Rate edit')
                                <a href="{{route('admin.rates.edit',$rate->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                @endcan
                                @can('Rate delete')
                                <form action="{{ route('admin.departments.destroy', $rate->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">
                                        Delete
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        @endcan
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    </div>
</x-app-layout>
