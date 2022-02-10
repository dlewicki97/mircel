<template>
	<v-card v-if="cartDescriptions" flat class="p-3">
		<v-card-title class="p-0 mb-4">
			<h3 class="mb-0 cart-menu-title">{{ cartDescriptions.step_3 }}</h3>
		</v-card-title>
		<v-divider ></v-divider>
		<v-form v-if="validationRules.id" ref="form" v-model="valid" class="mb-5">
			<h4 class="cart-menu-title" style="margin-top: 2rem; font-size: 1.5rem">{{ cartDescriptions.delivery_type }}</h4>
			<v-radio-group :disabled="summary != undefined" :rules="[required]" v-model="payments.delivery" column >
				<v-radio v-for="(delivery, i) in deliveryOptions" :key="i" :label="deliveryLabel(delivery)" :value="delivery.value"></v-radio>
			</v-radio-group>
			<h4 class="cart-menu-title mt-5" style="font-size: 1.5rem">{{ cartDescriptions.payment_type }}</h4>
			<v-radio-group :disabled="summary != undefined" :rules="[required]" v-model="payments.payment" column >
				<v-radio v-if="payments.delivery != 'in_advance'" :label="cartDescriptions.traditional" value="traditional" ></v-radio>
				<v-radio v-if="payments.delivery != 'courier'" :label="cartDescriptions.personal" value="personal" ></v-radio>
			</v-radio-group>
		</v-form>
		<Rules />
	</v-card>
</template>

<script>
	import axios from 'axios'
	import Rules from '@/helpers/validation/Rules'

	export default {
		props: ['submit', 'summary', 'data', 'cartDescriptions', 'deliveryOptions'],
		data() {
			return {
				valid: true,
				payments: {
					delivery: 'courier',
					payment: 'traditional'
				},
			}
		},
		components: {
			Rules
		},
		computed: {
			...Rules.computed,
			shopDescriptions() {
				return this.$store.getters.shopDescriptions;
			}
		},
		watch: {
			submit() {
				if(this.submit) {
					if(this.$refs.form.validate()) {
						this.$emit('e1', 4)
					}
				}
			},
			valid() {
				this.$emit('valid', this.valid);
			},
			data() {
				if(this.data != undefined) this.payments = this.data;
			},
			payments: {
				deep: true,
				handler() {
					this.$emit('payments', this.payments);
					localStorage.setItem('payments', JSON.stringify(this.payments))
				}
			},
			deliveryOptions() {
				this.$emit('delivery', this.deliveryOptions.find(delivery => delivery.value == this.payments.delivery))
			},
			validationRules() {
				if(this.$refs.form) this.$emit('valid', this.$refs.form.validate());
			},
			cartDescriptions() {
				if(this.$refs.form) this.$emit('valid', this.$refs.form.validate());
			}
		},
		methods: {
			...Rules.methods,
			
			
			deliveryLabel(delivery) {
				return `${delivery.title} ${delivery.price.toFixed(2)} ${this.shopDescriptions.currency}`;
			} 
		},
		created() {
			this.$emit('payments', this.payments);
			if(localStorage.getItem('payments') != null) {
				this.payments = JSON.parse(localStorage.getItem('payments'))
			}
			if(this.$refs.form) this.$emit('valid', this.$refs.form.validate())
		},
		mounted() {
			if(this.$refs.form) this.$emit('valid', this.$refs.form.validate());
		}


}
</script>