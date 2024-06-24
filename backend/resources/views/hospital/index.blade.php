<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-2">
      <div class="text-right">
        @can('Hospital create')
        <a href="{{route('admin.hospitals.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New Hospital</a>
        @endcan
      </div>

      <div class="bg-white shadow-md rounded my-6">
        <table class="text-left w-full border-collapse">
          <thead>
            <tr>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Title</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Status</th>
              <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-2/12">Actions</th>
            </tr>
          </thead>
          <tbody>
            @can('Hospital access')
            @foreach($hospitals as $hospital)
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">{{ $hospital->name }}</td>
              <td class="py-4 px-6 border-b border-grey-light">
                @if($hospital->publish)
                <span class="text-white inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-500 rounded-full">Publish</span>
                @else
                <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">Draft</span>
                @endif
              </td>
              <td class="py-4 px-6 border-b border-grey-light text-right">

                @can('Hospital edit')
                <a href="{{route('admin.hospitals.edit',$hospital->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                @endcan

                @can('Hospital delete')
                <form action="{{ route('admin.hospitals.destroy', $hospital->id) }}" method="POST" class="inline">
                  @csrf
                  @method('delete')
                  <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
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
