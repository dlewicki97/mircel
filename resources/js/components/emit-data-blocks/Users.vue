<template></template>

<script>
	import axios from 'axios'

	export default {
		props: ['reloadFlag'],
		watch: {
			reloadFlag() {
				if(this.reloadFlag) this.getData();
			}
		},
		data() {
			return {
				users: []
			}
		},
		methods: {
			getData(){
				this.$store.commit('loading', true);
				axios.get(`/api/users/get_where`).then(res => {
					this.$store.commit('loading', false);
					this.users = res.data;

					this.$emit('blockDataEmit', this.users);
				}).catch(err => {
					this.$store.commit('loading', false);
					console.log(err);
				})
			},
		},
		
		created() {
			
			this.getData();
		}
	}
</script>