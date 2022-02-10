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
			return{
				subpages: []
			}
		},
		methods:{
			async getData(){
				this.$store.commit('loading', true);
				await axios.get('/api/subpages/get_all').then(res => {
					this.$store.commit('loading', false);
					if(res.data.length > 0) this.subpages = res.data;
					this.$emit('blockDataEmit', this.subpages);
				});
			}
		},
		created(){
			this.getData();
		},
	}
</script>