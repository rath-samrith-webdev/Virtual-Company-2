<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                  <form method="POST" action="{{ route('admin.hospitals.store')}}">
                      @csrf
                      <div class="flex flex-col space-y-2">
                          <label for="title" class="text-gray-700 select-none font-medium">Title</label>
                          <input id="title" type="text" name="name" value="{{ old('name') }}" placeholder="Enter title" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                      </div>
                      <div class="flex flex-col space-y-2">
                          <label for="description" class="text-gray-700 select-none font-medium">Address</label>
                          <div class="flex gap-2">
                              <input id="title" type="text" name="street_address" value="{{ old('street_address',) }}" placeholder="Enter street" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                              <input id="title" type="text" name="village" value="{{ old('village') }}" placeholder="Enter Village" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                              <input id="title" type="text" name="commune" value="{{ old('commune')}}" placeholder="Enter Commune" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                              <input id="title" type="text" name="district" value="{{ old('district') }}" placeholder="Enter District" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                              <input id="title" type="text" name="province" value="{{ old('province')}}" placeholder="Enter Province" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                          </div>
                      </div>
                      <div class="flex flex-col space-y-2">
                          <label for="description" class="text-gray-700 select-none font-medium">Other Information</label>
                          <div class="flex gap-2">
                              <div>
                                  <label for="description" class="text-gray-700 select-none font-medium">Category</label>
                                  <div>
                                      <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                          <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                                      </svg>
                                      <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" name="category_id">
                                          <option value="" disabled>Select Category</option>
                                          @foreach($data['category'] as $user)
                                              <option value="{{$user->id}}" >{{$user->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div>
                                  <label for="description" class="text-gray-700 select-none font-medium">User</label>
                                  <div class="flex gap-2">
                                      <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                          <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                                      </svg>
                                      <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" name="user_id" @if(auth()->id()!==1) disabled  @endif>
                                          <option value="" disabled>Select User</option>
                                          @foreach($data['users'] as $user)
                                              <option value="{{$user->id}}" @if(auth()->id()==$user->id) selected @endif >{{$user->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>
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
