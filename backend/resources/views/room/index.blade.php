<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <div class="text-right">
        @can('Room create')
        <a href="{{route('admin.rooms.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New room</a>
        @endcan
      </div>
      <div class="bg-white shadow-md rounded my-6">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                     Room Name
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Hospital Name
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Added
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Action
                  </th>
              </tr>
              </thead>
              <tbody>
              @can('Room access')
                  @foreach($rooms as $room)
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                          <td class="px-6 py-4">
                              {{$room->name}}
                          </td>
                          <td class="px-6 py-4">
                              {{$room->hospital->name}}
                          </td>
                          <td class="px-6 py-4">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                    <svg class="w-2.5 h-2.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                     {{\Carbon\Carbon::parse($room->created_at)->diffForHumans()}}</span>
                          </td>
                          <td class="py-4 px-4 border-b justify-start border-grey-light text-right">
                              @can('Room edit')
                                  <a href="{{route('admin.rooms.edit',$room->id)}}"
                                     class="text-grey-lighter font-bold py-1 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                              @endcan
                              @can('Room delete')
                                  <form action="{{ route('admin.rooms.destroy', $room->id) }}"
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
