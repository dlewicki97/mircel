<template>
	<v-card flat class="p-3">
		<v-card-title class="p-0 mb-4">
			<h2 class="mb-0 cart-menu-title" style="font-size: 2.5rem">{{ cartDescriptions.step_4 }}</h2>
		</v-card-title>
		<v-row>
			<v-col cols="12"  >
				<CartMenuListing @sum="sum = $event" :delivery="delivery" summary />
			</v-col>
			<v-col cols="12" >
				<ShippingDetails :cartDescriptions="cartDescriptions" :data="shippingDetails" summary />
			</v-col>
			<v-col cols="12" >
				<Payments :deliveryOptions="deliveryOptions" :cartDescriptions="cartDescriptions" @delivery="delivery = $event" :data="payments" summary />
			</v-col>
			
		</v-row>
	</v-card>
</template>

<script>
	import CartMenuListing from './CartMenuListing' 
	import ShippingDetails from './ShippingDetails' 
	import Payments from './Payments' 

	export default {
		props: ['shippingDetails', 'payments', 'cartDescriptions', 'deliveryOptions'],
		data() {
			return {
				delivery: {},
				sum: 0
			}
		},
		components: {
			CartMenuListing, ShippingDetails, Payments
		},
		computed: {
			cartData() {
				let data = {
					payments: this.payments,
					sum: this.sum,
					shipping_details: this.shippingDetails,
					products: JSON.parse(localStorage.getItem('cart'))
				}
				
				return data;
			}
		},
		watch: {
			cartData: {
				deep: true,
				handler() {
					this.$emit('cartData', this.cartData);
				}
			}
		}

	}
</script>