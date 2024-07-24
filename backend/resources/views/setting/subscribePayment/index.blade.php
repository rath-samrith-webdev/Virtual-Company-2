<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="text-right">
                    @can('User create')
                        <a href="{{route('admin.subscribePlans.create')}}"
                           class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New Subscribe Plan</a>
                    @endcan
                </div>
                <div class="bg-white shadow-md rounded my-6">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Payment Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Plan Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Duration
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Added
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @can('User access')
                            @foreach($data as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $user->payment_id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$user->subscribePlan->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$user->duration}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$user->amount}}
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
