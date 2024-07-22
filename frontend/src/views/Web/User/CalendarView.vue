<script lang="ts">
import {defineComponent, reactive, ref} from 'vue'
import {EventApi, DateSelectArg, EventClickArg} from '@fullcalendar/core'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import WebLayout from "@/Components/Layouts/WebLayout.vue";
import {hospitalAppointmentListStore} from "@/stores/hospital-appointment-list";
import {ElNotification} from "element-plus";
import {useAuthStore} from "@/stores/auth-store";
import axiosInstance from "@/plugins/axios";
import {pusherConstance} from "@/pusher/pusher";
const userStore = useAuthStore()
const store = hospitalAppointmentListStore()
const pusher = pusherConstance;
const open2 = (title: string, message: any, type: string) => {
  ElNotification({
    title: title,
    message: message,
    type: type
  })
}
export default defineComponent({
  components: {
    WebLayout,
    FullCalendar,
  },
  mounted() {
    store.fetchCalendarData()
    this.fetchHospitals()
    pusher.subscribe(`appointment`).bind(`appointment`, function (data) {
      if (data) {
        this.fetchData()
      }
    })
  },
  data() {
    return {
      dialogTableVisible: ref(false),
      outerVisible: ref(false),
      innerVisible: ref(false),
      dialogEditVisible: ref(false),
      hospital: ref([]),
      events: [],
      docData: ref([]),
      hospital_id: '',
      form: reactive({
        first_name: userStore.user.first_name,
        last_name: userStore.user.last_name,
        user_id: userStore.user.id,
        hospital_id: '',
        doctor_id: '',
        title: '',
        date1: '',
        date2: ''
      }),
      formEdit: reactive({
        id: '',
        first_name: '',
        last_name: '',
        user_id: userStore.user.id,
        hospital_id: '',
        doctor_id: '',
        title: '',
        date1: '',
        date2: ''
      }),
      id: '',
      appointment: [],
      currentAppointment: {
        appointment_date: undefined
      },
      calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin // needed for dateClick
        ],
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        initialEvents: store.calendars,
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        select: this.handleDateSelect,
        eventClick: this.handleEventClick,
        eventsSet: this.handleEvents,
        /* you can update a remote database when these fire:
        eventAdd:
        eventChange:
        eventRemove:
        */
      },
      currentEvents: [] as EventApi[],
    }
  },
  methods: {
    async onUpdate() {
      this.dialogEditVisible = false
      const formData = new FormData()
      formData.append('user_id', this.formEdit.user_id)
      formData.append('appointment_date', this.formEdit.date1)
      formData.append('appointment_time', this.formEdit.date2)
      formData.append('hospital_id', this.formEdit.hospital_id)
      formData.append('title', this.formEdit.title)
      formData.append('doctor_id', this.formEdit.doctor_id)
      try {
        const {data} = await axiosInstance.put(`/appointments/update/${this.formEdit.id}`, formData)
        console.log(data)
        if (data.success == true) {
          open2('Appointment', data.message, 'success')
        } else {
          open2('Appointment', data.message, 'warning')
        }
      } catch (error) {
        console.log(error)
      }
    },
    async getDoctors(id: any) {
      console.log(id)
      try {
        const {data} = await axiosInstance.get(`/hospitals/show/${id}`)
        this.docData = data.data.doctors
      } catch (error) {
        console.log(error)
      }
    },
    openEditDialog(row: any) {
      console.log(row.extendedProps.appointment_time.toLocaleString())
      this.formEdit.id = row.id
      this.formEdit.first_name = row.extendedProps.user.first_name
      this.formEdit.last_name = row.extendedProps.user.last_name
      this.formEdit.user_id = row.extendedProps.user.id
      this.formEdit.title=row.title
      this.formEdit.date1=row.startStr
      this.formEdit.date2=row.extendedProps.appointment_time
      this.formEdit.hospital_id = row.extendedProps.hospital.id
      this.formEdit.doctor_id=row.extendedProps.doctor.id
      this.getDoctors(row.extendedProps.hospital.id)
      this.outerVisible = false
      this.dialogEditVisible = true

    },
    async onSubmit() {
      this.dialogTableVisible = false
      const formData = {
        user_id: this.form.user_id,
        appointment_date: this.form.date1,
        appointment_time: this.form.date2,
        hospital_id: this.form.hospital_id,
        title: this.form.title,
        doctor_id: this.form.doctor_id
      }
      try {
        const {data} = await axiosInstance.post('/appointments/create', formData)
        console.log(data.success)
      } catch (error) {
        console.log(error)
      }
    },
    async fetchHospitals() {
      try {
        const {data} = await axiosInstance.get('/hospitals/list')
        this.hospital = data.data
      } catch (error) {
        console.log(error)
      }
    },
    handleWeekendsToggle() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
    },
    handleDateSelect(selectInfo: DateSelectArg) {
      this.dialogTableVisible = true
      let calendarApi = selectInfo.view.calendar
      calendarApi.unselect() // clear date selection
      this.form.date1 = selectInfo.startStr
    },
    handleEventClick(clickInfo: EventClickArg) {
      this.outerVisible = true
      this.id = clickInfo.event.id
      this.currentAppointment = clickInfo.event
    },
    handleEvents(events: EventApi[]) {
      this.currentEvents = events
    },
    fetchData() {
      this.events = store.calendars
    },
    cancelAppointment(id) {
      this.outerVisible = false
      store.cancelAppointment(id)
      store.fetchCalendarData()
    },
    removeAppointment(id) {
      this.outerVisible = false
      store.removeAppointment(id)
      store.fetchAppointments()
    }
  },
})
</script>
<template>
  <WebLayout>
    <FullCalendar :options="calendarOptions"/>
    <!-- Update Appointment form   -->
    <el-dialog v-model="dialogEditVisible" title="Edit appointment" width="800">
      <el-form :model="formEdit" label-position="top" label-width="auto" style="max-width: 800px">
        <el-input type="hidden" v-model="formEdit.user_id" />
        <el-input type="hidden" v-model="formEdit.id" />
        <el-form-item>
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="formEdit.first_name" />
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="formEdit.last_name" />
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item label="Appointment Title">
          <el-input v-model="formEdit.title" />
        </el-form-item>
        <el-form-item label="Select a hospital">
          <el-select v-model="formEdit.hospital_id" placeholder="Select Hospital">
            <el-option
                @click="getDoctors(form.hospital_id)"
                v-for="item in hospital"
                :key="item.id"
                :label="item.name"
                :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Select a Doctor">
          <el-select v-model="formEdit.doctor_id" placeholder="Select Doctor">
            <el-option
                v-for="item in docData"
                :key="item.id"
                :label="item.first_name + ' ' + item.last_name"
                :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Appointment time">
          <el-col :span="11">
            <el-date-picker
                v-model="formEdit.date1"
                type="date"
                placeholder="Pick a date"
                format="YYYY/MM/DD"
                value-format="YYYY-MM-DD"
                style="width: 100%"
            />
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-time-picker
                v-model="formEdit.date2"
                placeholder="Pick a time"
                style="width: 100%"
                value-format="HH:mm"
            />
          </el-col>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onUpdate">Update</el-button>
          <el-button>Cancel</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <!-- Appointment Creation Data-->
    <el-dialog v-model="dialogTableVisible" title="Make an appointment" width="800">
      <el-form :model="form" label-position="top" label-width="auto" style="max-width: 800px">
        <el-input hidden v-model="form.user_id"/>
        <el-form-item>
          <el-col :span="11">
            <el-form-item label="First name">
              <el-input v-model="form.first_name"/>
            </el-form-item>
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-form-item label="Last name">
              <el-input v-model="form.last_name"/>
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item label="Appointment Title">
          <el-input v-model="form.title"/>
        </el-form-item>
        <el-form-item label="Select a hospital">
          <el-select v-model="form.hospital_id" placeholder="Please select a hospital">
            <el-option
                @click="getDoctors(form.hospital_id)"
                v-for="item in hospital"
                :key="item.id"
                :label="item.name"
                :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Select a Doctor">
          <el-select v-model="form.doctor_id" placeholder="Please select a doctor">
            <el-option
                v-for="item in docData"
                :key="item.id"
                :label="item.first_name + ' ' + item.last_name"
                :value="item.id"
            />
          </el-select>
        </el-form-item>
        <el-form-item label="Activity time">
          <el-col :span="11">
            <el-date-picker
                v-model="form.date1"
                type="date"
                placeholder="Pick a date"
                format="YYYY/MM/DD"
                value-format="YYYY-MM-DD"
                style="width: 100%"
            />
          </el-col>
          <el-col :span="2" class="text-center">
            <span class="text-gray-500">-</span>
          </el-col>
          <el-col :span="11">
            <el-time-picker
                v-model="form.date2"
                placeholder="Pick a time"
                style="width: 100%"
                value-format="HH:mm"
            />
          </el-col>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">Create</el-button>
          <el-button>Cancel</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <el-dialog v-model="outerVisible" title="Appointment Details" width="600">
      <p><b>Name:</b> {{ currentAppointment.extendedProps.user.first_name }}</p>
      <p><b>Doctor:</b> {{ currentAppointment.extendedProps.doctor.first_name }}</p>
      <p><b>Hospital:</b> {{ currentAppointment.extendedProps.hospital.name }}</p>
      <p><b>Phone Number:</b> {{ currentAppointment.extendedProps.user.phone_number }}</p>
      <p><b>Date:</b> {{ currentAppointment.start?.toISOString().split('T')[0] }}</p>
      <p><b>Time:</b> {{ currentAppointment.extendedProps.appointment_time }}</p>
      <p><b>Room No: {{ currentAppointment.extendedProps.room.name }}</b></p>
      <p><b>Status:</b> {{ currentAppointment.extendedProps.status }}</p>
      <p><b>Gender:</b> {{ currentAppointment.extendedProps.user.gender }}</p>
      <template #footer>
        <div class="dialog-footer d-flex justify-content-center align-items-center">
          <el-button @click="openEditDialog(currentAppointment)">Update</el-button>
          <el-button @click="cancelAppointment(currentAppointment.id)">Cancel</el-button>
          <el-button @click="removeAppointment(currentAppointment.id)">Remove</el-button>
          <el-button @click="outerVisible = false">Close</el-button>
        </div>
      </template>
    </el-dialog>
  </WebLayout>
</template>
<style scoped>

</style>