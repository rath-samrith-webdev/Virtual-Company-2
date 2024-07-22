<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="text-right">
                    @can('User create')
                        <a href="{{route('admin.users.create')}}"
                           class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                            User</a>
                    @endcan
                </div>
                <div class="bg-white shadow-md rounded my-6">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                User Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Avatar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Added
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @can('User access')
                            @foreach($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->profile)
                                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="/images/profiles/user-{{$user->first_name}}/{{ $user->profile }}" alt="" />
                                        @else
                                            <span class="text-white inline-flex bg-gray-500 items-center justify-center h-10 w-10 rounded-full ring-2 ring-white">{{$user->first_name[0]}} {{$user->last_name[0]}}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$user->email}}
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        @foreach($user->roles as $role)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                    <svg class="w-2.5 h-2.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                     {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$user->verify_status==1?'Verified':'Not verified'}}
                                    </td>
                                    <td class="py-4 px-4 border-b justify-start border-grey-light text-right">
                                        @can('Room edit')
                                            <a href="{{route('admin.users.edit',$user->id)}}"
                                               class="text-grey-lighter font-bold py-1 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                        @endcan
                                        @can('Room delete')
                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
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
