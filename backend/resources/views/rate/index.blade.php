<x-app-layout>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('Rate create')
                <a href="{{route('admin.rates.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                    Department</a>
                @endcan
            </div>
            <div class="bg-white rounded my-6 p-5" style="background-color: #FCB22D">
                <h1 class="text-center font-bold">Feedback List</h1>
            </div>
            <div class="flex flex-wrap mt-6">
                <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-plus mr-3"></i> Star Base Feedback
                    </p>
                    <div class="p-6 rounded bg-white">
                        <canvas id="chartThree" width="400" height="200"></canvas>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-account mr-3"></i>Monthly Feedback
                    </p>
                    <div class="p-6 rounded bg-white">
                        <canvas id="chartFour" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse table-auto">
                    <thead class="text-left">
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">
                                ID
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                Content
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                From
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                To
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">
                                Star
                            </th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-center w-2/12">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('Rate access')
                        @foreach($data['rates'] as $rate)
                        <tr class="hover:bg-grey-lighter text-start">
                            <td class="py-4 px-4 border-b border-grey-light">{{ $rate->id }}</td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                {{$rate->content}}
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                @if($rate->user->profile)
                                <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="/images/profiles/user-{{$rate->user->first_name}}/{{ $rate->user->profile }}" alt="" />
                                @else
                                <span class="inline-flex bg-gray-500 items-center justify-center h-10 w-10 rounded-full ring-2 ring-white">{{$rate->user->first_name[0]}}{{$rate->user->last_name[0]}}</span>
                                @endif
                                {{$rate->user->first_name.' '.$rate->user->last_name}}
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                {{$rate->hospital->name}}
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light">
                                @if($rate->star ===5)
                                <div class="flex items-center">
                                    @for ($i =0; $i < $rate->star; $i++)
                                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    @endfor
                                    <p class="ms-1 ml-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{$rate->star}} out of 5 </p>
                                </div>
                                @else
                                <div class="flex items-center">
                                    @for ($i =0; $i < $rate->star; $i++)
                                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        @endfor
                                        @for ($i =0; $i < (5 - $rate->star); $i++)
                                            <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                            @endfor
                                            <p class="ms-1 text-sm font-medium text-gray-500 ml-2 dark:text-gray-400">{{$rate->star}} out of 5</p>
                                </div>
                                @endif
                            </td>
                            <td class="py-4 px-4 border-b border-grey-light text-right">
                                @can('Rate edit')
                                <a href="{{route('admin.rates.edit',$rate->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                                @endcan
                                @can('Rate delete')
                                <form action="{{ route('admin.departments.destroy', $rate->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">
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
</x-app-layout>
<script>
    var chartThree = document.getElementById('chartThree')
    var chartFour = document.getElementById('chartFour')
    let feedback_monthly = {!! json_encode($data['new_orders_count'],JSON_HEX_TAG) !!};
    let star_base_feedback = {!! json_encode($data['star_base_count'],JSON_HEX_TAG) !!};
    var FeedbackCategorize = new Chart(chartThree, {
        type: 'bar',
        data: {
            labels: ['Zero Star','One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star'],
            datasets: [{
                label: 'Total Feedback',
                data: star_base_feedback,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    var feedbackMonthly = new Chart(chartFour, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Feedback',
                data: feedback_monthly,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
