<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('Appointment create')
                    <a href="{{route('admin.appointments.create')}}"
                       class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                        Appointment</a>
                @endcan
            </div>

            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead>
                    <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                            ID
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                            Hospital
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                           Appointment Maker
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                            Appointment Date
                        </th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-2/12">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @can('Appointment access')
                        @foreach($appointments as $appointment)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $appointment->id }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{$appointment->hospital->name}}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{$appointment->user->first_name .' '.$appointment->user->last_name}}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{$appointment->appointment_date}}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light text-right">

                                    @can('Appointment edit')
                                        <a href="{{route('admin.appointments.edit',$appointment->id)}}"
                                           class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                    @endcan

                                    @can('Appointment delete')
                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}"
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
