<template>
  <WebLayout>
    <FullCalendar :options="calendarOptions">
      <template v-slot:eventContent='arg'>
        <div class="text-center">
          <b :class="arg.event.extendedProps.hospital_status =='Confirmed'?'success':'primary'">{{
              arg.event.title
            }}</b>
        </div>
      </template>
    </FullCalendar>
    <el-dialog v-model="outerVisible" title="Appointment Details" width="600">
      <p><b>Name:</b> {{ currentAppointment.extendedProps.user.first_name }}</p>
      <p><b>Doctor:</b> {{ currentAppointment.extendedProps.doctor.first_name }}</p>
      <p><b>Hospital:</b> {{ currentAppointment.extendedProps.hospital }}</p>
      <p><b>Phone Number:</b> {{ currentAppointment.extendedProps.user.phone_number }}</p>
      <p><b>Date:</b> {{ currentAppointment.start?.toISOString().split('T')[0] }}</p>
      <p><b>Time:</b> {{ currentAppointment.extendedProps.appointment_time }}</p>
      <p><b>Room No:</b></p>
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
</template>
<script lang="ts">
import {defineComponent, ref, watch} from 'vue'
import {EventApi, DateSelectArg, EventClickArg} from '@fullcalendar/core'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import WebLayout from "@/Components/Layouts/WebLayout.vue";
import {createEventId} from "@/views/Web/Hospital/event-utils";
import {hospitalAppointmentListStore} from "@/stores/hospital-appointment-list";
import {ElNotification} from "element-plus";

const store = hospitalAppointmentListStore()
export default defineComponent({
  components: {
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
      id:'',
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
        initialEvents: JSON.parse(sessionStorage.getItem('calendarData')),
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        select: this.handleDateSelect,
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
    handleDateSelect(selectInfo: DateSelectArg) {
      let title = prompt('Please enter a new title for your event')
      let calendarApi = selectInfo.view.calendar
      calendarApi.unselect() // clear date selection
      if (title) {
        calendarApi.addEvent({
          id: createEventId(),
          title,
          start: selectInfo.startStr,
          end: selectInfo.endStr,
          allDay: selectInfo.allDay
        })
      }
    },
    handleEventClick(clickInfo: EventClickArg) {
      this.outerVisible = true
      console.log(clickInfo.event.id);
      this.id=clickInfo.event.id
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
    open2(title: string, message: any, type: string){
      ElNotification({
        title: title,
        message: message,
        type: type
      })
    }
  },
})
watch(store.message,()=>{
  if (store.message.success) {
    this.open2('Appointment Confirmed', store.message.message, 'success')
  } else {
    this.open2('Appointment Confirmed', store.message.message, 'warning')
  }
})
</script>
<style scoped>

</style>