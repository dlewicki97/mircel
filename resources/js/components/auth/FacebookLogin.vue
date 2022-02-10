<template>
	<v-btn @click="fbLogin" color="#4569b1" class="white--text w-100">
		<v-icon left>mdi-{{ authDescriptions.fb_icon }}</v-icon>
		<span>{{ authDescriptions.fb_button_name }}</span>
	</v-btn>
</template>

<script>
	import axios from 'axios'

	export default{
		props: ['authDescriptions'],
		data(){
			return{
				fbLink: window.location.origin + '/api/facebook/login',
			}
		},
		methods:{
			fbLogin(){
				localStorage.setItem('fbLogin', true);
				window.location.replace(this.fbLink);
			},
			
		},
		
	}
</script>