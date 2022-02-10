<template>
	<div>
		<div>
			<v-btn color="primary" icon dark >
				<v-icon>mdi-{{ drawerDescriptions.login_icon }}</v-icon>
			</v-btn>
			<span>{{ drawerDescriptions.login }}</span>
		</div>
		<v-dialog @input="v => v || closeLogin()" class="position-relative" v-model="dialog" persistent>
			<v-card class="login-card  login-bg" raised :style="`background-image: linear-gradient(to right top, rgb(44 60 49 / 70%), hsl(0 0% 0% / 0.9)), url(${url(authDescriptions.bg_login_photo)})`">
					<div @click="closeLogin()" class="close-button">
						<v-icon color="white">mdi-{{ authDescriptions.close_icon }}</v-icon>
					</div>
					<v-form v-if="validationRules.id" ref="form" class="position-relative login-form">
						<h1 class="about-title font-weight-bold text-center text-white mt-0">{{ authDescriptions.login_title }}</h1>
						<v-text-field dark v-model="auth.email" :rules="[required, email]" :label="authDescriptions.email" required ></v-text-field>
						<v-text-field dark v-model="auth.password" type="password" :rules="[required, passwordLength]" :counter="20" :label="authDescriptions.password" required ></v-text-field>
					</v-form>
					<p @click="openPasswordReminder" class="white--text text-center mt-5" style="cursor: pointer;">{{ authDescriptions.forgot_password }}</p>
					<v-btn dark outlined class="mr-4 w-100 login-button " @click="submit">
						{{ authDescriptions.login }}
					</v-btn>
					<h5 class="text-center white--text py-2 m-0 font-weight-lighter">{{ authDescriptions.or }}</h5>

					<Facebook :authDescriptions="authDescriptions" />

					<p @click="openRegister" class="white--text text-center mt-5" style="cursor: pointer">{{ authDescriptions.register_now }}</p>	
				</v-card>
				<Rules ref="rules" />
			</v-dialog>
		</div>
	</template>

	<script>
		import axios from 'axios'
		import Facebook from './FacebookLogin'
		import url from '@/helpers/photo/url';
		import Rules from '@/helpers/validation/Rules'

		export default {
			watch:{
				'$route'(){
					this.dialog = false;
				}
			},
			components:{
				Facebook, Rules
			},
			props: ['dialog', 'authDescriptions', 'drawerDescriptions'],

			data() {
				return {
					auth: {
						email: '',
						password: '',
					},
					url
				}
			},
			computed: {
				...Rules.computed
			},
			methods: {
				...Rules.methods,
				closeLogin() {
					this.$emit('closeLogin');
				},
				submit() {
					if(this.$refs.form.validate()) {
						this.$store.dispatch('authLogin', this.auth);
					}

				},
				openRegister(){
					this.closeLogin();
					this.$emit('openRegister');
				},
				openPasswordReminder() {
					this.closeLogin();
					this.$emit('openPasswordReminder');
				},

			},
				


		}
	</script>

	<style>
		.v-label, .v-input__slot{
			margin-bottom: 0!important;
		}
		.login-button{
			border:1px solid white;
			color: white;
			outline: none!important;
			background: transparent;
			font-size: 3rem;
			mix-blend-mode: screen;
		}
		.login-button:hover {
			background-color: white;
			color: #000;

		}
		.login-card{
			padding: 4rem 17rem;
		}
		@media(max-width: 992px) {
			.login-card, .register-card{
				padding: 4rem 10rem;
			}
		}
		@media(max-width: 768px) {
			.login-card, .register-card{
				padding: 4rem 6rem;
			}
		}
		@media(max-width: 576px) {
			.login-card, .register-card{
				padding: 4rem 3rem;
			}
		}
		@media(max-width: 430px) {
			.login-card, .register-card{
				padding: 4rem 1rem;
			}
		}
		.login-form{
			z-index: 300;
		}
		.login-bg{
			background-position: center left;
			background-repeat: no-repeat;
			background-size: cover;
			width: 100%;
			height: 100%;
			top:0;
			left:0;
		}
		.v-counter{
			margin-top: .5rem;
		}
		.require-star{
			color: red;
		}
		.login-checkbox-link{
			color: #007bff!important;
		}
	</style>