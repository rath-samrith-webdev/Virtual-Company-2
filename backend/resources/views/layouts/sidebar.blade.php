<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
     class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <svg class="h-12 w-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                    fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                <path
                    d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                    fill="white"></path>
            </svg>

            <a href="{{ route('admin.dashboard') }}">
                <span class="text-white text-2xl mx-2 font-semibold">Dashboard</span>
            </a>
        </div>
    </div>

    <nav class="mt-10">
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }} "
           href="{{ route('admin.dashboard')}}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Dashboard</span>
        </a>
        @canany('Role access','Role add','Role edit','Role delete')
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.roles.index') ? 'active' : '' }}"
               href="{{ route('admin.roles.index') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6.5a2 2 0 11-4 0 2 2 0 014 0zm-9 7a2 2 0 110-4 2 2 0 010 4z"/>
                </svg>

                <span class="mx-3">Role</span>
            </a>
        @endcanany
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.subscription-plans.index') ? 'active' : '' }}"
           href="{{ route('admin.subscribePlans.index') }}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6.5a2 2 0 11-4 0 2 2 0 014 0zm-9 7a2 2 0 110-4 2 2 0 010 4z"/>
            </svg>

            <span class="mx-3">Subscription Plan</span>
        </a>
        @canany('Permission access','Permission add','Permission edit','Permission delete')
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.permissions.index') ? 'active' : '' }}"
               href="{{ route('admin.permissions.index') }}">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                    </path>
                </svg>

                <span class="mx-3">Permission</span>
            </a>
        @endcanany

        @canany('User access','User add','User edit','User delete')
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.users.index') ? 'active' : '' }}"
               href="{{ route('admin.users.index')}}">
                    <span class="inline-flex justify-center items-center">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                       xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </span>
                <span class="mx-3">User</span>
            </a>
        @endcanany
        <div
            class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 "
            onclick="dropdown()"
        >
            <div class="flex justify-start w-full items-center">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 4H8a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 14H14"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v8"/>
                </svg>
                <span class="text-[15px] ml-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 ">Hospital Menu</span>
            </div>
        </div>
        <div
            class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold"
            id="submenu"
        >
            @canany('Hospital access','Hospital add','Hospital edit','Hospital delete')
                <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.hospitals.index') ? 'active' : '' }}"
                   href="{{ route('admin.hospitals.index')}}">
                    <span class="inline-flex justify-center items-center">
                        <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="16px" height="16px" viewBox="0 0 16 16"
                             stroke="currentColor">
<path fill="#020202" d="M13,7H9V3c0-0.553-0.447-1-1-1S7,2.447,7,3v4H3C2.447,7,2,7.447,2,8s0.447,1,1,1h4v4c0,0.553,0.447,1,1,1
	s1-0.447,1-1V9h4c0.553,0,1-0.447,1-1S13.553,7,13,7z"/>
</svg>
                </span>
                    <span class="mx-3">Hospital</span>
                </a>
            @endcanany
            @canany('Appointment access','Appointment add','Appointment edit','Appointment delete')
                <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.appointments.index') ? 'active' : '' }}"
                   href="{{ route('admin.appointments.index')}}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 4H8a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14H14"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v8"/>
                    </svg>

                    <span class="mx-3">Appointments</span>
                </a>
            @endcanany
                @canany('Room access','Room add','Room edit','Room delete')
                    <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.rooms.index') ? 'active' : '' }}"
                       href="{{ route('admin.rooms.index')}}">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 4H8a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14H14"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v8"/>
                        </svg>
                        <span class="mx-3">Rooms</span>
                    </a>
                @endcanany
            @canany('Department access','Department add','Department edit','Department delete')
                <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.departments.index') ? 'active' : '' }}"
                   href="{{ route('admin.departments.index')}}">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 4H8a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14H14"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v8"/>
                    </svg>
                    <span class="mx-3">Departments</span>
                </a>
            @endcanany
            @canany('Doctor access','Doctor add','Doctor edit','Doctor delete')
                <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.doctors.index') ? 'active' : '' }}"
                   href="{{ route('admin.doctors.index')}}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>

                    <span class="mx-3">Doctors</span>
                </a>
            @endcanany
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.rates.index') ? 'active' : '' }}"
               href="{{ route('admin.rates.index')}}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>

                <span class="mx-3">Feedback</span>
            </a>
        </div>
        @canany('Mail access','Mail edit')
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.mail.index') ? 'active' : '' }}"
               href="{{ route('admin.mail.index')}}">
                <svg class="h-6 w-6" stroke="currentColor" version="1.1" id="图层_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                    <path id="XMLID_1_" class="st0" d="M13.4,2c0.1,0,0.2,0.1,0.2,0.3c0,0,0.1,0.8,0.5,1.5c0.7,1.2,2,1.9,3.4,1.9c0.7,0,1.4-0.2,1.9-0.5
	l0,0c0,0,0.1,0.1,0.2,0.2c0,0,0.8,0.9,1.2,1.6c0.3,0.6,0.7,1.4,0.8,1.8c0,0.1,0,0.2,0,0.2l0,0c-1.9,1.1-2.5,3.5-1.4,5.3
	c0.3,0.6,0.9,1,1,1.1c0.1,0.1,0.1,0.2,0.1,0.4l-1.6,2.7c0,0-0.1,0.1-0.1,0.1c-0.1,0-0.2,0.1-0.2,0.1c0,0-0.1,0-0.1,0
	c-0.4-0.1-1.2-0.3-1.9-0.3c-0.6,0-1.2,0.1-1.6,0.4c-1.3,0.8-1.8,2.9-1.8,3c0,0.1-0.1,0.2-0.2,0.3c0,0-0.1,0-0.1,0l-3,0
	c-0.1,0-0.2-0.1-0.3-0.3c0-0.1-0.1-0.9-0.5-1.5c-0.7-1.2-2-1.9-3.4-1.9c-0.7,0-1.4,0.2-1.9,0.5l0,0c0,0-0.1-0.1-0.2-0.2
	c0,0-0.8-0.9-1.2-1.6c-0.4-0.7-0.8-1.8-0.8-1.8c0-0.1,0-0.2,0-0.2l0,0c1.9-1.1,2.5-3.5,1.4-5.3c-0.4-0.6-1-1.1-1-1.1
	C2.7,8.5,2.6,8.3,2.7,8.2l1.6-2.7c0,0,0.1-0.1,0.1-0.1c0.1,0,0.2-0.1,0.3-0.1c0,0,0.1,0,0.1,0c0.4,0.1,1.1,0.2,1.8,0.2
	c0.7,0,1.2-0.1,1.6-0.4C9.4,4.5,9.9,2.6,10,2.4c0-0.1,0.1-0.2,0.2-0.3c0,0,0.1,0,0.1,0L13.4,2 M13.4,1l-3.2,0.1l0,0
	c-0.2,0-0.4,0.1-0.5,0.2C9.3,1.4,9.1,1.8,9,2.1C8.9,2.6,8.4,3.9,7.7,4.4C7.3,4.5,6.9,4.6,6.5,4.6C5.9,4.6,5.3,4.5,5,4.4
	c-0.1,0-0.2-0.1-0.4-0.1c-0.3,0-0.5,0.1-0.8,0.2C3.7,4.6,3.6,4.8,3.5,4.9l0,0L1.8,7.7l0,0C1.5,8.3,1.7,9,2.2,9.3
	c0,0,0.5,0.4,0.8,0.8c0.8,1.4,0.3,3.2-1.1,3.9l-0.1,0c-0.4,0.2-0.5,0.8-0.3,1.4c0,0,0.4,1.2,0.9,2c0.5,0.8,1.3,1.7,1.3,1.8
	c0.3,0.3,0.6,0.5,1,0.5c0.1,0,0.3,0,0.4-0.1c0,0,0,0,0,0l0.1,0c0.5-0.3,1-0.4,1.4-0.4c1,0,2,0.5,2.5,1.4c0.3,0.5,0.3,1.1,0.3,1.1
	c0.1,0.6,0.6,1.1,1.2,1.1l0,0l3.1,0l0,0c0.2,0,0.4-0.1,0.5-0.2c0.3-0.2,0.6-0.5,0.7-0.9c0.1-0.5,0.6-1.9,1.3-2.3
	c0.3-0.2,0.7-0.2,1.1-0.2c0.6,0,1.3,0.2,1.6,0.2c0.1,0,0.3,0.1,0.4,0.1c0.3,0,0.5-0.1,0.7-0.2c0.2-0.1,0.3-0.2,0.4-0.4l0,0l1.7-2.8
	l0,0c0.3-0.5,0.1-1.2-0.4-1.6c0,0-0.5-0.4-0.8-0.8c-0.8-1.4-0.3-3.2,1.1-3.9l0.1,0c0.4-0.2,0.5-0.8,0.3-1.4c0,0-0.4-1.2-0.9-2
	c-0.5-0.8-1.3-1.7-1.3-1.8c-0.3-0.3-0.6-0.5-1-0.5c-0.1,0-0.3,0-0.4,0.1l-0.1,0c-0.5,0.3-1,0.4-1.4,0.4c-1,0-2-0.5-2.5-1.4
	c-0.3-0.5-0.3-1.1-0.3-1.1C14.6,1.6,14,1.1,13.4,1L13.4,1L13.4,1z M15.2,14.9c0.2-0.2,0.2-0.5,0-0.7c-0.2-0.2-0.5-0.2-0.7,0
	c-0.6,0.7-1.6,1.2-2.5,1.2c-1.8,0-3.4-1.5-3.4-3.4s1.5-3.4,3.4-3.4s3.4,1.5,3.4,3.4c0,0.3,0.2,0.5,0.5,0.5c0.3,0,0.5-0.2,0.5-0.5
	c0-2.4-2-4.4-4.4-4.4c-2.4,0-4.4,2-4.4,4.4c0,2.4,2,4.4,4.4,4.4C13.2,16.4,14.4,15.8,15.2,14.9z"/>
</svg>


                <span class="mx-3">Setting</span>
            </a>
        @endcanany
        @can('System-Request access','System-Request edit','System-Request create','System-Request update')
            <div
                class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 "
                onclick="otherDropdown()"
            >
                <svg class="h-6 w-6" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="16px" height="16px" viewBox="0 0 16 16" stroke="currentColor"
                     xml:space="preserve">
<path fill="#010101" d="M14.562,15H2.438C2.197,15,2,14.803,2,14.562V1.438C2,1.197,2.197,1,2.487,1h9.537L15,4v10.562
	C15,14.803,14.803,15,14.562,15z M12,2v2h2L12,2z M14,5h-2.976V2H3v12h11V5z M10,4.5C10,4.224,9.776,4,9.5,4h-5
	C4.224,4,4,4.224,4,4.5l0,0C4,4.776,4.224,5,4.5,5h5C9.776,5,10,4.776,10,4.5L10,4.5z M13,6.5C13,6.224,12.776,6,12.5,6h-8
	C4.224,6,4,6.224,4,6.5l0,0C4,6.776,4.224,7,4.5,7h8C12.776,7,13,6.776,13,6.5L13,6.5z M13,8.5C13,8.224,12.776,8,12.5,8h-8
	C4.224,8,4,8.224,4,8.5l0,0C4,8.776,4.224,9,4.5,9h8C12.776,9,13,8.776,13,8.5L13,8.5z M13,10.5c0-0.276-0.224-0.5-0.5-0.5h-8
	C4.224,10,4,10.224,4,10.5l0,0C4,10.776,4.224,11,4.5,11h8C12.776,11,13,10.776,13,10.5L13,10.5z"/>
</svg>
                <div class="flex justify-between w-full items-center">
                    <span
                        class="text-[15px] ml-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">Other</span>
                    <span class="text-sm rotate-180" id="arrow">
            <i class="bi bi-chevron-down"></i>
          </span>
                </div>
            </div>
            <div
                class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold"
                id="otherSubmenu"
            >
                <a class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1 flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.system-requests.index') ? 'active' : '' }}"
                   href="{{ route('admin.system-requests.index')}}">
                    <svg stroke="currentColor" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
<path fill="#010101" d="M12.697,5.246c-0.247,0.181-0.593,0.126-0.773-0.12c-0.769-1.051-1.897-1.739-3.185-1.94
	c-0.3-0.047-0.597-0.057-0.891-0.049C7.724,3.142,7.603,3.159,7.48,3.172C7.3,3.191,7.119,3.213,6.943,3.251
	C6.788,3.286,6.64,3.334,6.491,3.383C6.359,3.426,6.229,3.468,6.103,3.521C5.921,3.599,5.748,3.689,5.579,3.787
	C5.501,3.832,5.423,3.875,5.347,3.924C5.146,4.055,4.956,4.2,4.778,4.358c-0.03,0.026-0.061,0.053-0.091,0.08
	c-0.202,0.189-0.392,0.393-0.56,0.614C4.127,5.053,4.126,5.055,4.125,5.056C3.593,5.76,3.245,6.611,3.159,7.539
	c-0.014,0.149-0.021,0.3-0.021,0.454v0.005l1.08-1.082c0.218-0.217,0.569-0.217,0.785,0c0.216,0.217,0.216,0.568,0,0.785
	L2.977,9.729C2.871,9.834,2.73,9.893,2.584,9.893S2.296,9.834,2.192,9.729l-2.03-2.029c-0.216-0.216-0.216-0.567,0-0.785
	c0.219-0.216,0.569-0.216,0.785,0l1.082,1.082V7.992c0-0.255,0.016-0.507,0.047-0.754c0.029-0.233,0.095-0.455,0.15-0.68
	C2.235,6.524,2.241,6.489,2.25,6.456c0.048-0.181,0.103-0.358,0.167-0.532c0.071-0.197,0.152-0.39,0.243-0.576
	C2.724,5.222,2.793,5.1,2.864,4.979C2.987,4.767,3.117,4.562,3.264,4.37c0.056-0.072,0.115-0.139,0.174-0.208
	c0.17-0.204,0.35-0.397,0.544-0.576c0.04-0.037,0.08-0.074,0.122-0.11C4.329,3.28,4.569,3.104,4.821,2.943
	c0.036-0.022,0.069-0.048,0.105-0.07c0.267-0.162,0.549-0.298,0.84-0.416C5.812,2.438,5.858,2.417,5.905,2.4
	c0.287-0.109,0.587-0.193,0.893-0.255c0.06-0.012,0.118-0.025,0.179-0.035c0.298-0.052,0.601-0.08,0.91-0.085
	c0.041,0,0.08-0.011,0.122-0.011v0.012c0.298,0.001,0.6,0.018,0.902,0.065c1.579,0.246,2.968,1.093,3.907,2.383
	C12.999,4.72,12.944,5.067,12.697,5.246z M3.183,11.527c0.938,1.291,2.327,2.138,3.906,2.383c0.303,0.048,0.604,0.064,0.902,0.065
	v0.012c0.042,0,0.081-0.011,0.122-0.011c0.31-0.006,0.612-0.034,0.91-0.086c0.061-0.01,0.119-0.023,0.179-0.035
	c0.306-0.062,0.605-0.146,0.893-0.256c0.047-0.018,0.093-0.038,0.139-0.057c0.291-0.119,0.573-0.255,0.84-0.416
	c0.036-0.022,0.069-0.048,0.105-0.07c0.252-0.16,0.492-0.337,0.718-0.532c0.042-0.036,0.082-0.073,0.122-0.11
	c0.194-0.178,0.374-0.372,0.544-0.576c0.059-0.068,0.118-0.135,0.174-0.207c0.146-0.193,0.276-0.398,0.399-0.609
	c0.071-0.121,0.141-0.243,0.204-0.369c0.091-0.187,0.172-0.379,0.243-0.576c0.064-0.174,0.119-0.352,0.167-0.532
	c0.009-0.033,0.015-0.067,0.023-0.103c0.056-0.225,0.121-0.446,0.15-0.68c0.031-0.247,0.047-0.499,0.047-0.754V8.002l1.081,1.082
	c0.217,0.217,0.567,0.217,0.786,0c0.216-0.218,0.216-0.568,0-0.785l-2.03-2.029c-0.104-0.104-0.245-0.163-0.392-0.163
	s-0.287,0.059-0.393,0.163l-2.027,2.029c-0.216,0.216-0.216,0.567,0,0.785c0.216,0.217,0.567,0.217,0.785,0l1.08-1.082v0.005
	c0,0.153-0.007,0.304-0.021,0.454c-0.086,0.927-0.434,1.779-0.966,2.482c-0.001,0.002-0.002,0.004-0.003,0.004
	c-0.168,0.222-0.357,0.426-0.56,0.614c-0.03,0.027-0.061,0.054-0.091,0.08c-0.178,0.159-0.368,0.304-0.568,0.435
	c-0.076,0.049-0.154,0.092-0.232,0.137c-0.169,0.098-0.342,0.188-0.523,0.266c-0.126,0.054-0.257,0.096-0.389,0.139
	c-0.148,0.049-0.297,0.097-0.452,0.131c-0.176,0.039-0.356,0.061-0.537,0.08c-0.122,0.013-0.243,0.03-0.368,0.035
	c-0.294,0.008-0.591-0.002-0.891-0.049c-1.287-0.201-2.416-0.89-3.185-1.94c-0.181-0.247-0.526-0.301-0.773-0.12
	C3.056,10.933,3.001,11.28,3.183,11.527z"/>
</svg>
                    <span class="mx-3">System Requests</span>
                </a>
                <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                    User Requests
                </h1>
                <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                    Friends
                </h1>
            </div>
        @endcan
    </nav>
</div>
<script type="text/javascript">
    //Hospital----
    function dropdown() {
        document.querySelector("#submenu").classList.toggle("hidden");
        document.querySelector("#arrow").classList.toggle("rotate-0");
    }

    dropdown();

    function openSidebar() {
        document.querySelector(".sidebar").classList.toggle("hidden");
    }

    //Others-------
    function otherDropdown() {
        document.querySelector("#otherSubmenu").classList.toggle("hidden");
        document.querySelector("#otherArrow").classList.toggle("rotate-0");
    }

    otherDropdown();

    function otherOpenSidebar() {
        document.querySelector(".otherSidebar").classList.toggle("hidden");
    }

</script>
