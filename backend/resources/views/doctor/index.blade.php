<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('Doctor create')
                    <a href="{{route('admin.doctors.create')}}"
                       class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                        Doctor</a>
                @endcan
            </div>
            <div class="bg-white rounded my-6 p-5" style="background-color: #FCB22D">
                <h1 class="text-center font-bold">Doctor List</h1>
            </div>
            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead>
                    <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                            ID
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                            Name
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                            Email
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                            Phone
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-2/12">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @can('Appointment access')
                        @foreach($doctors as $doctor)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $doctor->id }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{$doctor->user->first_name}}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{$doctor->user->email}}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{$doctor->user->phone_number?$doctor->user->phone_number:'No Contact'}}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light text-right">

                                    @can('Appointment edit')
                                        <a href="{{route('admin.doctors.edit',$doctor->id)}}"
                                           class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                    @endcan

                                    @can('Appointment delete')
                                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}"
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
