<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('Department create')
                    <a href="{{route('admin.rates.create')}}"
                       class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
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
                                <td class="py-4 px-4 border-b border-grey-light text-right">
                                    @can('Rate edit')
                                        <a href="{{route('admin.departments.edit',$rate->id)}}"
                                           class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                    @endcan

                                    @can('Rate delete')
                                        <form action="{{ route('admin.departments.destroy', $rate->id) }}"
                                              method="POST" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button
                                                class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">
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
