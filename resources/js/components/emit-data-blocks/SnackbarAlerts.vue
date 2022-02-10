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
				rows: [],
				table: 'snackbar_alerts'
			}
		},
		methods: {
			getData(){
				this.$store.commit('loading', true);
				axios.get(`/api/${this.table}/get_all`).then(res => {
					this.$store.commit('loading', false);
					this.rows = res.data;
					this.$emit('blockDataEmit', this.rows);
				}).catch(err => {
					this.$store.commit('loading', false);
					console.log(err);
				})
			},
		},
		created() {
			this.getData();
		},

	}
</script>