<template>
  <WebLayout v-if="user.hospital!='No hospital'">
    <FullCalendar :options="calendarOptions">
      <template v-slot:eventContent="arg">
        <div class="d-flex flex-column">
          <b>{{arg.event.start.toLocaleTimeString()}}</b>
          <b>{{arg.event.extendedProps.doctor.first_name}} {{arg.event.extendedProps.doctor.last_name}}</b>
        </div>
      </template>
    </FullCalendar>
    <el-dialog v-model="outerVisible" title="Appointment Details" width="600">
      <p><b>Name:</b> {{ currentAppointment.extendedProps.user.first_name }}</p>
      <p><b>Doctor:</b> {{ currentAppointment.extendedProps.doctor.first_name }}</p>
      <p><b>Hospital:</b> {{ currentAppointment.extendedProps.hospital.name }}</p>
      <p><b>Phone Number:</b> {{ currentAppointment.extendedProps.user.phone_number }}</p>
      <p><b>Date:</b> {{ currentAppointment.start?.toISOString().split('T')[0] }}</p>
      <p><b>Time:</b> {{ currentAppointment.extendedProps.appointment_time }}</p>
      <p><b>Room No: {{currentAppointment.extendedProps.room?.name}}</b></p>
      <p><b>Status:</b> {{ currentAppointment.extendedProps.status }}</p>
      <p><b>Gender:</b> {{ currentAppointment.extendedProps.user.gender }}</p>
      <el-dialog
          v-model="innerVisible"
          width="300"
          title="Confirm Appointment"
          append-to-body
      >
        Are you sure?
        <div class="el-dialog__footer">
          <el-button @click="innerVisible = false">Cancel</el-button>
          <el-button type="primary" @click="submitConfirmation">
            Confirm
          </el-button>
        </div>
      </el-dialog>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="outerVisible = false">Cancel</el-button>
          <el-button type="primary" @click="ConfirmAppointment">
            Confirm Appointment
          </el-button>
        </div>
      </template>
    </el-dialog>
  </WebLayout>
  <WebLayout v-else>
    <NoHospitalSet/>
  </WebLayout>
</template>
<script lang="ts">
import {defineComponent, ref, watch} from 'vue'
import {EventApi, DateSelectArg, EventClickArg} from '@fullcalendar/core'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import WebLayout from "@/Components/Layouts/WebLayout.vue";
import {hospitalAppointmentListStore} from "@/stores/hospital-appointment-list";
import {ElNotification} from "element-plus";
import {useAuthStore} from "@/stores/auth-store";
import NoHospitalSet from "@/Components/Hospitals/NoHospitalSet.vue";
const store = hospitalAppointmentListStore()
const userStore=useAuthStore()
const open2 = (title: string, message: any, type: string) => {
  ElNotification({
    title: title,
    message: message,
    type: type
  })
}
watch(store.message, () => {
  if (store.message.success) {
    open2('Appointment Confirmed', store.message.message, 'success')
  } else {
    open2('Appointment Confirmed', store.message.message, 'warning')
  }
})
export default defineComponent({
  components: {
    NoHospitalSet,
    WebLayout,
    FullCalendar,
  },
  mounted() {
    store.fetchCalendarData()
  },
  data() {
    return {
      outerVisible: ref(false),
      innerVisible: ref(false),
      id: '',
      appointment: [],
      appointmentStore:store.calendars,
      user:userStore,
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
        eventClick: this.handleEventClick,
        eventsSet: this.handleEvents
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
    handleWeekendsToggle() {
      this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
    },
    handleEventClick(clickInfo: EventClickArg) {
      this.outerVisible = true
      console.log(clickInfo.event.extendedProps);
      this.id = clickInfo.event.id
      this.currentAppointment = clickInfo.event
    },
    handleEvents(events: EventApi[]) {
      this.currentEvents = events
    },
    ConfirmAppointment() {
      console.log('submit', this.id)
      this.outerVisible = false
      this.innerVisible = true
    },
    submitConfirmation() {
      this.innerVisible = false
      store.confirmAppointment(this.id)
      store.fetchAppointments()
    },

  },
})
</script>
<style scoped>

</style>