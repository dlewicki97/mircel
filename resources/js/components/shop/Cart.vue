<template>
	<v-container class="py-12">
		<Stepper />
	</v-container>
</template>

<script>
	
	import Stepper from './Stepper' 

	export default {
		components: {
			Stepper
		},
		computed: {
			cart() {
				return this.$store.getters.cart;
			}
		},
		watch: {
			'$store.getters.subpages'() {
				if(this.$store.getters.subpages) {
					if(!this.$store.getters.subpages.find(subpage => subpage.page == '/sklep').active) this.$router.push('/');
				}
			},
			cart: {
				deep: true,
				handler() {
					if(this.cart.length == 0) this.$router.push('/');
				}
			}

		},
		created() {
			if(this.$store.getters.cart.length == 0) this.$router.push('/');
		}
	}
</script>