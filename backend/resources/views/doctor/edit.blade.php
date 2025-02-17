<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white rounded my-6 p-5" style="background-color: #FCB22D">
                    <h1 class="text-center font-bold">Edit Doctor</h1>
                </div>
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.doctors.update',$data['doctor']->id)}}">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Name</label>
                            <input id="title" type="text" name="first_name" value="{{ old('title',$data['doctor']->user->first_name) }}"
                                   placeholder="Appointment Title"
                                   class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"/>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Email</label>
                            <input id="title" type="text" name="email" value="{{ old('title',$data['doctor']->user->email) }}"
                                   placeholder="Appointment Title"
                                   class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"/>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Phone Number</label>
                            <input id="title" type="text" name="phone" value="{{ old('title',$data['doctor']->user->phone_number) }}"
                                   placeholder="Appointment Title"
                                   class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"/>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="description" class="text-gray-700 select-none font-medium">Information</label>
                            <div class="flex gap-2">
                                <select
                                    class="border border-gray-300  text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
                                    name="hospital_id">
                                    <option value="" disabled>Select Hospital</option>
                                    @foreach($data['hospitals'] as $user)
                                        <option value="{{$user->id}}"
                                                @if($user->id==$data['doctor']->hospital_id) selected @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-16 mb-16">
                            <button type="submit"
                                    class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>



