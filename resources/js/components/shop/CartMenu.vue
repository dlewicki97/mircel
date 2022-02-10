<template>
	<div class="text-center">
		
		<v-menu @input="v => v || closeMenu()" offset-y v-model="menu" :close-on-content-click="false" >
			<template #activator="{ on }">
				<div v-on="on">
					<v-btn class="header-button" :color="color ? color : ''"  icon>
						<v-icon>mdi-{{ cartDescriptions.cart_icon }}</v-icon>
					</v-btn>
					<span>{{ cartDescriptions.title }}</span>
				</div>
			</template>
			<CartMenuListing @closeMenu="closeMenu()"/>
		</v-menu>
	</div>
</template>

<script>
	import CartMenuListing from './CartMenuListing'
	import axios from 'axios'

	export default {
		props: ['color', 'menu'],
		components: {
			CartMenuListing
		},
		computed: {
			cartDescriptions() {
				return this.$store.getters.cartDescriptions;
			}
		},
		methods: {
			closeMenu() {
				this.$emit('closeMenu');
			}
		},
		created() {
			this.$store.dispatch('cartDescriptions');
			this.$store.dispatch('shopDescriptions');
		}
		

	}
</script>

<style>
	.cart-menu-product-photo {
		width: 60px;
		height: 60px;
		border-radius: 50%;
	}

	.cart-menu-product-title {
		font-weight: 500;
		font-size: 1rem;
	}
	.cart-menu-product-content {

		line-height: 17px;
	}

	.cart-menu-sum {
		background-color: var(--first-color);
		color: white;
		font-size: 1rem;
		padding: 1rem;
	}

	.cart-menu-sum span {
		font-size: 2rem;
		font-weight: 700;
		margin-left: .5rem;
	}
	.cart-menu-title {
		font-weight: 700;
		color: var(--first-color);
		font-size: 2rem;
	}
</style>