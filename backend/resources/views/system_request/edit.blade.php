<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white rounded my-6 p-5" style="background-color: #FCB22D">
                    <h1 class="text-center font-bold">Edit Department</h1>
                </div>
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.system-requests.update',$systemRequest->id)}}">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <input id="title" type="text" hidden name="user_id" value="{{ old('content',$systemRequest->user_id) }}" placeholder="Feedback Content" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Request Details</label>
                            <input id="title" type="text" name="request_details" value="{{ old('content',$systemRequest->request_details) }}" placeholder="Feedback Content" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Request Category</label>
                            <p class="bg-blue-100 text-blue-800 text-l me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">{{$systemRequest->category->name}}</p>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Requester</label>
                            <input id="title" type="text" disabled name="user_name" value="{{ old('content',$systemRequest->user->first_name.' '.$systemRequest->user->last_name) }}" placeholder="Feedback Content" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Update Status</label>
                            <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" name="request_status">
                                <option value="" hidden>Select One</option>
                                <option value="pending" @if($systemRequest->request_status=='pending')selected @endif>Pending</option>
                                <option value="approved" @if($systemRequest->request_status=='approved')selected @endif>Approved</option>
                            </select>
                        </div>
                        <div class="text-center mt-16 mb-16">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
