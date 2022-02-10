<template>
	<div>
		<v-dialog class="position-relative" @input="v => v || closeRegister()" v-model="dialog" persistent>
			<v-card class="register-card  register-bg" raised :style="`background-image: linear-gradient(to right top, rgb(44 60 49 / 70%), hsl(0 0% 0% / 0.9)), url(${url(authDescriptions.bg_register_photo)})`">
				<div @click="closeRegister" class="close-button">
					<v-icon color="white">mdi-{{ authDescriptions.close_icon }}</v-icon>
				</div>
				<v-form v-if="validationRules.id" ref="form" v-model="valid" class="position-relative register-form">
					<h1 class="about-title font-weight-bold text-center text-white mt-0">{{ authDescriptions.register_title }}</h1>
					<v-text-field dark v-model="auth.name" :rules="[required]" :counter="30" :label="authDescriptions.name" class="primary-text"></v-text-field>
					<v-text-field dark v-model="auth.email" :rules="[required, email]" :label="authDescriptions.email"></v-text-field>
					<v-text-field type="password" :rules="[required, passwordLength]" dark v-model="auth.password" :label="authDescriptions.password"></v-text-field>
					<v-text-field :rules="[required, passwordConfirm(auth.password, passwordConf)]" type="password" dark v-model="passwordConf" :label="authDescriptions.password_confirm"></v-text-field>

					<v-checkbox dark v-model="regulations" :rules="[required]">
						<span slot="label">
							{{ authDescriptions.shop_regulations }} <a @click.stop="" class="register-checkbox-link" download :href="url($store.getters.settings.shop_regulations)"><v-btn dark class="register-button ml-2" small outlined>{{ authDescriptions.download }}</v-btn></a>
						</span>
					</v-checkbox>

					<v-checkbox dark class="pt-0 mt-0" v-model="privace" :rules="[required]">
						<span slot="label">
							{{ authDescriptions.privace_policy }} <a @click.stop="" class="register-checkbox-link" download :href="url($store.getters.settings.privace_policy)"><v-btn dark class="register-button ml-2" small outlined>{{ authDescriptions.download }}</v-btn></a>
						</span>
					</v-checkbox>

					<v-checkbox dark class="pt-0 mt-0 register-checkbox" v-model="rodo1" :rules="[required]">
						<div slot="label" v-html="$store.getters.settings.rodo_1"></div>
					</v-checkbox>

					<v-checkbox dark class="pt-0 mt-0 register-checkbox" v-model="rodo2" :rules="[required]">
						<div slot="label" v-html="$store.getters.settings.rodo_2"></div>
					</v-checkbox>

				</v-form>
				<v-btn dark outlined class="mr-4 w-100 register-button" @click="submit">
					{{ authDescriptions.make_account }}
				</v-btn>
				<h5 class="text-center white--text py-4 m-0 font-weight-lighter">{{ authDescriptions.or }}</h5>


				<Facebook :authDescriptions="authDescriptions" />

			</v-card>
			<Rules />
		</v-dialog>

	</div>
</template>

<script>
	import Facebook from './FacebookLogin';
	import url from '@/helpers/photo/url';
	import Rules from '@/helpers/validation/Rules'
	import axios from 'axios'

	export default {
		props:['dialog', 'authDescriptions'],
		watch:{
			'$route'(){
				this.dialog = false;
			},
		},
		data() {
			return {
				valid: true,
				auth: {
					name: '',
					email: '',
					password: '',
					photo: ''
				},
				passwordConf: '',
				regulations: false,
				privace: false,
				rodo1: false,
				rodo2: false,
				url
			}
		},
		computed: {
			...Rules.computed
		},
		methods: {
			...Rules.methods,
			submit () {
				if(this.$refs.form.validate()) {
					this.$store.dispatch('register', this.auth);
					this.closeRegister();
				}
			},
			closeRegister(){
				this.$emit('closeRegister');
			}
		},
		components:{
			Facebook, Rules
		},
		
	}
</script>

<style>
	.v-label, .v-input__slot{
		margin-bottom: 0!important;
	}
	.register-button{
		border:1px solid white;
		color: white;
		outline: none!important;
		background: transparent;
		font-size: 3rem;
		mix-blend-mode: screen;
	}
	.register-button:hover {
		background-color: white;
		color: #000;
		
	}
	.close-button{
		top: 1%;
		left: 0;
		cursor: pointer;
		width: 100%;
		position: absolute;
		padding: .5rem;
		text-align: right;
	}
	.register-card{
		padding: 4rem 17rem;
	}
	.register-form{
		z-index: 300;
	}
	.register-bg{
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
	.register-checkbox-link{
		color: #007bff!important;
	}
</style>