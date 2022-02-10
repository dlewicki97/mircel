<template>
	<v-container class="px-3">
		<v-row justify="center">
			<h2 class="about-title font-weight-bold text-center first-color my-0 mb-5">{{ calendarDescriptions.title }}</h2>
		</v-row>
		<h2>{{ calendarDescriptions.legend }}</h2>
		<v-row v-for="(service, i) in services" :key="i" align="center" class="px-3">
			<div class="legend-color" :style="`background-color: ${service.color}`"></div>
			<p>{{ service.title }}</p>

		</v-row>
		<v-row align="center" class="px-3 mb-4">
			<div class="legend-color" :style="`background-color: ${calendarDescriptions.unconfirmed_color}`"></div>
			<p>{{ calendarDescriptions.unconfirmed }}</p>

		</v-row>
		<v-sheet tile height="54" class="d-flex" >
			<v-btn icon class="ma-2" @click="$refs.calendar.prev()" >
				<v-icon>mdi-{{ calendarDescriptions.previous_icon }}</v-icon>
			</v-btn>
			<v-select v-model="showType" :items="showTypes" dense outlined hide-details class="ma-2" :label="calendarDescriptions.type" ></v-select>

			<v-select v-model="weekday" :items="dayFormats" item-value="format" item-text="title" dense outlined hide-details :label="calendarDescriptions.day_format" class="ma-2" ></v-select>
			<v-btn icon class="ma-2" @click="$refs.calendar.next()" >
				<v-icon>mdi-{{ calendarDescriptions.next_icon }}</v-icon>
			</v-btn>
		</v-sheet>
		<v-sheet height="600" width="100%">
			<v-calendar v-if="weekday.length > 0" ref="calendar" v-model="value" :weekdays="weekday" :type="type" :events="events" :event-overlap-mode="mode" :event-overlap-threshold="30" :event-color="getEventColor" @change="getEvents" @click:date="viewDay" @click:more="viewDay" @click:event="showEvent" locale="pl" :event-more-text="calendarDescriptions.more"></v-calendar>

			<v-menu v-model="selectedOpen" :close-on-content-click="false" :activator="selectedElement" offset-x >
				<v-card color="grey lighten-4" min-width="350px" flat >
					<v-toolbar :color="selectedEvent.color" dark >
						<v-btn icon>
							<v-icon>mdi-{{ calendarDescriptions.reservation_icon }}</v-icon>
						</v-btn>
						<v-toolbar-title v-html="selectedEvent.name + '<br>' + getReservationTime(selectedEvent)"></v-toolbar-title>
						<v-spacer></v-spacer>

					</v-toolbar>


				</v-card>
			</v-menu>
		</v-sheet>
	</v-container>
</template>

<script>
	import DateFormatter from '../../helpers/date/format.js'
	import axios from 'axios'

	export default {
		props: ['serviceEquipments', 'services', 'reloadFlag'],
		data: () => ({
			type: 'month',
			showType: '',
			types: ['month', 'week', 'day', '4day'],
			showTypes: [],
			weekday: [],
			weekdays: [
			{ text: 'Ndz - Sob', value: [0, 1, 2, 3, 4, 5, 6] },
			{ text: 'Pn - Ndz', value: [1, 2, 3, 4, 5, 6, 0] },
			{ text: 'Pn - Pt', value: [1, 2, 3, 4, 5] },
			{ text: 'Pn, Śr, Pt', value: [1, 3, 5] },
			],
			value: '',
			events: [],
			focus: '',
			selectedEvent: {},
			selectedElement: null,
			selectedOpen: false,
			calendarDescriptions: {},
			dayFormats: []
		}),
		watch: {
			calendarDescriptions() {
				if(this.calendarDescriptions.id) {
					this.showTypes.push(this.calendarDescriptions.month, this.calendarDescriptions.week, this.calendarDescriptions.day, this.calendarDescriptions.four_days); 
					this.showType = this.showTypes[0];
				}
			},
			showType() {
				this.type = this.types[this.showTypes.indexOf(this.showType)];
			},
			reloadFlag(){
				if(this.reloadFlag){
					this.getEvents();
				}
			},
			dayFormats() {
				if(this.dayFormats.length > 0) {
					this.dayFormats.forEach(day_format => day_format.format = day_format.format.split(' ').map(format => parseInt(format)));
					this.weekday = this.dayFormats[0].format;
				}
			}
		},
		methods: {
			getDayFormats() {
				axios.get('/api/day_formats/get_all').then(res => this.dayFormats = res.data);
			},
			getCalendarDescriptions() {
				axios.get('/api/calendar_descriptions/get_one/1').then(res => this.calendarDescriptions = res.data);
			},
			getReservationTime: selectedEvent => `${DateFormatter.formatTime(selectedEvent.start)}-${DateFormatter.formatTime(selectedEvent.end)}`,
			showEvent ({ nativeEvent, event }) {
				const open = () => {
					this.selectedEvent = event
					this.selectedElement = nativeEvent.target
					setTimeout(() => {
						this.selectedOpen = true
					}, 10)
				}

				if (this.selectedOpen) {
					this.selectedOpen = false
					setTimeout(open, 10)
				} else {
					open()
				}

				nativeEvent.stopPropagation()
			},
			viewDay ({ date }) {
				this.focus = date
				this.type = 'day'
				this.showType = 'Dzień'
			},
			async getEvents () {
				const events = []

				await axios.get('/api/reservations/get_all').then(res => {
					for(let data of res.data) {
						events.push({
							name: this.serviceEquipments.find(eq => eq.id == data.service_equipment_id).title,
							start: data.entry,
							end: data.leave,
							color: data.active ? this.serviceEquipments.find(eq => eq.id == data.service_equipment_id).service.color : 'rgb(197 197 197)',
							timed: true,

						})
					}
					this.$emit('blockDataEmit', res.data)
					this.events = events
					this.$emit('events', events.sort((a,b) => a.created_at > b.created_at ? 1 : (a.created_at < b.created_at ? 0 : -1)));
				}).catch(err => console.log(err))
			},
			getEventColor (event) {
				return event.color
			},


		},
		created() {
			this.getEvents();
			this.getDayFormats();
			this.getCalendarDescriptions();
		}
	}
</script>

<style>
	.legend-color {
		width: 30px;
		height: 15px;
		border: 1px solid black;

	}
	.legend-color + p {
		margin-bottom: 0!important;
		margin-left: 1rem;
	}

	.v-event {
		width: 100%!important;
	}

	.v-calendar .v-event-timed-container {
		margin-right: 0!important;
	}
</style>