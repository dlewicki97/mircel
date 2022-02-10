<template>
	<div>
		<v-dialog @input="v => v || closePasswordReminder()" class="position-relative" v-model="openPasswordReminder" persistent>
			<v-card class="login-card  login-bg" raised :style="`background-image: linear-gradient(to right top, rgb(44 60 49 / 70%), hsl(0 0% 0% / 0.9)), url(${url(authDescriptions.bg_password_reminder_photo)})`">
				<div @click="closePasswordReminder()" class="close-button">
					<v-icon color="white">mdi-{{ authDescriptions.close_icon }}</v-icon>
				</div>
				<v-form v-model="valid" v-if="validationRules.id" ref="form" class="position-relative login-form">
					<h1 class="about-title font-weight-bold text-center text-white mt-0">{{ authDescriptions.password_reminder_title }}</h1>
					<v-text-field dark v-model="auth.email" :rules="[required, email]" :label="authDescriptions.email" required ></v-text-field>
				</v-form>
				<v-btn :disabled="!valid" dark outlined class="mr-4 w-100 login-button " @click="submit">
					{{ authDescriptions.password_reminder_send }}
				</v-btn>


			</v-card>
			<Rules  />
		</v-dialog>
	</div>
</template>

<script>
	import url from '@/helpers/photo/url'
	import Rules from '@/helpers/validation/Rules'
	import axios from 'axios'

	export default {
		props: ['authDescriptions', 'openPasswordReminder'],
		data() {
			return {
				auth: {
					email: ''
				},
				dialog: false,
				url,
				valid: true
			}
		},
		computed: {
			...Rules.computed
		},
		components:{
			Rules
		},
		methods: {
			...Rules.methods,
			closePasswordReminder() {
				this.$emit('closePasswordReminder');
			},
			submit() {
				this.$store.commit('loading', true);
				axios.post('/api/users/password_reminder', this.auth).then(res => {
					this.$store.commit('loading', false);
					if(res.data.success) {
						this.$store.commit('setSnackbar', res.data.success.message);
					}
					if(res.data.error) {
						this.$store.commit('setSnackbar', res.data.error.message);
					}
					console.log(res)
				}).catch(() => this.$store.commit('loading', false))
			}
		}
	}
</script>