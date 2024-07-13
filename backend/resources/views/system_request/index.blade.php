<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('System-Request create')
                    <a href="{{route('admin.rates.create')}}"
                       class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                        Create Request</a>
                @endcan
            </div>
            <div class="bg-white rounded my-6 p-5" style="background-color: #FCB22D">
                <h1 class="text-center font-bold">Request from Users</h1>
            </div>
            <div class=" shadow-md rounded my-6">
                <p class="text-xl pb-3 flex justify-center items-center">
                    <i class="fas fa-plus mr-3"></i> Latest Request
                </p>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            User Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Request For
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Detail
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Requested
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @can('Rate access')
                        @foreach($requests as $request)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if($request->user->profile)
                                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                             src="/images/profiles/user-{{$request->user->first_name}}/{{ $request->user->profile }}"
                                             alt=""/>
                                    @else
                                        <span
                                            class="inline-flex bg-gray-500 items-center justify-center h-10 w-10 rounded-full ring-2 ring-white">{{$request->user->first_name[0]}}{{$request->user->last_name[0]}}</span>
                                    @endif
                                    {{$request->user->name}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$request->category->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$request->request_details}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$request->request_status}}
                                </td>
                                <td class="px-6 py-4">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                    <svg class="w-2.5 h-2.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                     {{\Carbon\Carbon::parse($request->created_at)->diffForHumans()}}</span>
                                </td>
                                <td class="py-4 px-4 border-b justify-start border-grey-light text-right">
                                    @can('Rate edit')
                                        <a href="{{route('admin.system-requests.edit',$request->id)}}"
                                           class="text-grey-lighter font-bold py-1 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                    @endcan
                                    @can('Rate delete')
                                        <form action="{{ route('admin.system-requests.destroy', $request->id) }}"
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
