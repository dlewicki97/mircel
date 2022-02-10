<template>
	<v-card v-if="cartDescriptions" flat class="p-3">
		<v-card-title class="p-0 mb-4">
			<h3 class="mb-0 cart-menu-title details">{{ cartDescriptions.step_2 }}</h3>
		</v-card-title>
		<v-divider></v-divider>
		<v-form v-if="validationRules.id" ref="form" v-model="valid">
			<v-row>
				<v-col cols="12" lg="3">
					<v-text-field type="text" :rules="[required]" v-model="shippingDetails.main_address.name" :disabled="summary != undefined" :label="cartDescriptions.name"></v-text-field>
				</v-col>
				<v-col cols="12" lg="3">
					<v-text-field type="email" :rules="[required, email]" v-model="shippingDetails.main_address.email" :disabled="summary != undefined" :label="cartDescriptions.email"></v-text-field>
				</v-col>
				<v-col cols="12" lg="3">
					<v-text-field type="text" :rules="[required]" v-model="shippingDetails.main_address.phone" :disabled="summary != undefined" :label="cartDescriptions.phone"></v-text-field>
				</v-col>
				<v-col cols="12" lg="3">
					<v-text-field type="text" :rules="[required]" v-model="shippingDetails.main_address.street" :disabled="summary != undefined" :label="cartDescriptions.street"></v-text-field>
				</v-col>
				<v-col cols="12" lg="3">
					<v-text-field type="number" :rules="[required]" v-model="shippingDetails.main_address.house_number" :disabled="summary != undefined" :label="cartDescriptions.house_number"></v-text-field>
				</v-col>
				<v-col cols="12" lg="3">
					<v-text-field type="number" v-model="shippingDetails.main_address.flat_number" :disabled="summary != undefined" :label="cartDescriptions.flat_number"></v-text-field>
				</v-col>
				<v-col cols="12" lg="3">
					<v-text-field type="text" :rules="[required]" v-model="shippingDetails.main_address.zip_code" :disabled="summary != undefined" :label="cartDescriptions.zip_code"></v-text-field>
				</v-col>
				<v-col cols="12" lg="3">
					<v-text-field type="text" :rules="[required]" v-model="shippingDetails.main_address.city" :disabled="summary != undefined" :label="cartDescriptions.city"></v-text-field>
				</v-col>
				
			</v-row>
			<v-textarea v-if="shippingDetails.other_address == '0'" rows="4" v-model="shippingDetails.main_address.message" :disabled="summary != undefined" :label="cartDescriptions.message"></v-textarea>

			<h4 class="cart-menu-title mt-5" style="font-size: 1.5rem">{{ cartDescriptions.other_address }}</h4>
			<v-radio-group :disabled="summary != undefined" v-model="shippingDetails.other_address" row >
				<v-radio :label="cartDescriptions.yes" value="1" ></v-radio>
				<v-radio :label="cartDescriptions.no" value="0" ></v-radio>
			</v-radio-group>

			<div v-if="shippingDetails.other_address == '1'">
				<v-divider></v-divider>
				<v-row>
					<v-col cols="12" lg="4">
						<v-text-field type="text" :rules="[required]" v-model="shippingDetails.second_address.name" :disabled="summary != undefined" :label="cartDescriptions.name"></v-text-field>
					</v-col>
					<v-col cols="12" lg="4">
						<v-text-field type="text" :rules="[required]" v-model="shippingDetails.second_address.phone" :disabled="summary != undefined" :label="cartDescriptions.phone"></v-text-field>
					</v-col>
					<v-col cols="12" lg="4">
						<v-text-field type="text" :rules="[required]" v-model="shippingDetails.second_address.street" :disabled="summary != undefined" :label="cartDescriptions.street"></v-text-field>
					</v-col>
					<v-col cols="12" lg="3">
						<v-text-field type="number" :rules="[required]" v-model="shippingDetails.second_address.house_number" :disabled="summary != undefined" :label="cartDescriptions.house_number"></v-text-field>
					</v-col>
					<v-col cols="12" lg="3">
						<v-text-field type="number" v-model="shippingDetails.second_address.flat_number" :disabled="summary != undefined" :label="cartDescriptions.flat_number"></v-text-field>
					</v-col>
					<v-col cols="12" lg="3">
						<v-text-field type="text" :rules="[required]" v-model="shippingDetails.second_address.zip_code" :disabled="summary != undefined" :label="cartDescriptions.zip_code"></v-text-field>
					</v-col>
					<v-col cols="12" lg="3">
						<v-text-field type="text" :rules="[required]" v-model="shippingDetails.second_address.city" :disabled="summary != undefined" :label="cartDescriptions.city"></v-text-field>
					</v-col>

				</v-row>
				<v-textarea rows="4" v-model="shippingDetails.second_address.message" :disabled="summary != undefined" :label="cartDescriptions.message"></v-textarea>
			</div>
		</v-form>
		<Rules />
	</v-card>
</template>

<script>
	import axios from 'axios'
	import Rules from '@/helpers/validation/Rules'
	
	export default {
		props: ['submit', 'summary', 'data', 'cartDescriptions'],
		data() {
			return {
				valid: true,
				shippingDetails: {
					other_address: '0',
					main_address: {
						name: '',
						email: '',
						phone: '',
						street: '',
						house_number: '',
						flat_number: '',
						zip_code: '',
						city: '',
						message: '',
					},
					second_address: {
						name: '',
						phone: '',
						street: '',
						house_number: '',
						flat_number: '',
						zip_code: '',
						city: '',
						message: '',
					},
				},
				
				
			}
		},
		computed: {
			...Rules.computed
		},
		watch: {
			
			valid() {
				this.$emit('valid', this.valid);
			},
			submit() {
				if(this.submit) {
					if(this.$refs.form.validate()) {
						this.$emit('e1', 3)
					}
					
				}
			},
			data() {
				if(this.data != undefined) {
					this.shippingDetails = this.data;
				}
			},
			shippingDetails: {
				deep: true,
				handler() {
					this.$emit('shippingDetails', this.shippingDetails)
					localStorage.setItem('shippingDetails', JSON.stringify(this.shippingDetails));
				}
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
		},
		created() {
			this.$emit('shippingDetails', this.shippingDetails)
			if(localStorage.getItem('shippingDetails') != null) {
				this.shippingDetails = JSON.parse(localStorage.getItem('shippingDetails'));
			}
			if(this.$refs.form) this.$emit('valid', this.$refs.form.validate());
		},
		mounted() {
			if(this.$refs.form) this.$emit('valid', this.$refs.form.validate());
		}



	}
</script>