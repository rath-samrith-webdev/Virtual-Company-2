<template>
  <WebLayout>
    <FullCalendar :options="calendarOptions">
      <template v-slot:eventContent="arg">
        <div class="d-flex flex-column">
          <b>{{arg.event.start.toLocaleTimeString()}}</b>
          <b>{{arg.event.extendedProps.user.first_name}} {{arg.event.extendedProps.user.last_name}}</b>
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
      <el-dialog v-model="innerVisible" width="300" title="Confirm Appointment" append-to-body>
        <el-form label-position="top">
          <el-form-item label="Appointment End Date">
            <el-date-picker v-model="confirmData.appointment_end" value-format="YYYY-MM-DD" class="w-100"/>
          </el-form-item>
          <el-form-item label="Select a room">
            <el-select v-model="confirmData.room_name">
              <el-option
                  v-for="hosp in hospital.hospitalDetail.rooms"
                  :value="hosp.name"
                  :key="hosp"
              >{{ hosp.name }}</el-option>
            </el-select>
          </el-form-item>
        </el-form>
        <div class="el-dialog__footer">
          <el-button @click="innerVisible = false">Cancel</el-button>
          <el-button type="primary" @click="submitConfirmation"> Confirm </el-button>
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
import {EventApi, EventClickArg} from '@fullcalendar/core'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import WebLayout from "@/Components/Layouts/WebLayout.vue";
import {hospitalAppointmentListStore} from "@/stores/hospital-appointment-list";
import {hospitalDetailStore} from "@/stores/hospital-detail";
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
      hospital: hospitalDetailStore(),
      id: '',
      appointment: [],
      currentAppointment: {
        appointment_date: undefined
      },
      confirmData : ref({
        appointment_id: '',
        appointment_end:'',
        room_name: ''
      }),
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
      this.id = clickInfo.event.id
      this.currentAppointment = clickInfo.event
    },
    handleEvents(events: EventApi[]) {
      this.currentEvents = events
    },
    ConfirmAppointment() {
      this.hospital.fetchHospitalDetail(this.currentAppointment.extendedProps.hospital.id)
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