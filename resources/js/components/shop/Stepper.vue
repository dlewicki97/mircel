<template>
<v-stepper v-model="e1">
    <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1">{{ cartDescriptions.step_1 }}</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 2" step="2">{{ cartDescriptions.step_2 }}</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 3" step="3">{{ cartDescriptions.step_3 }}</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="4">{{ cartDescriptions.step_4 }}</v-stepper-step>
    </v-stepper-header>

    <v-stepper-items>
        <v-stepper-content step="1">
            <div class="mb-12">
                <CartMenuListing />
            </div>

            <v-btn :disabled="cart.length == 0" color="primary" @click="e1 = 2">{{ cartDescriptions.next }}</v-btn>

        </v-stepper-content>

        <v-stepper-content step="2">
            <div class="mb-12">
                <ShippingDetails :cartDescriptions="cartDescriptions" @shippingDetails="shippingDetails = $event" @e1="e1 = $event" :submit="shippingDetailsSubmit" @valid="shippingDetailsValid = $event" />
            </div>

            <v-btn :disabled="!shippingDetailsValid" color="primary" @click="shippingDetailsValidate">{{ cartDescriptions.next }}</v-btn>

            <v-btn @click="e1 = 1" text>{{ cartDescriptions.back }}</v-btn>
        </v-stepper-content>

        <v-stepper-content step="3">
            <div class="mb-12">
                <Payments :deliveryOptions="deliveryOptions" :cartDescriptions="cartDescriptions" @payments="payments = $event" @e1="e1 = $event" :submit="paymentsSubmit" @valid="paymentsValid = $event" />
            </div>
            <v-btn :disabled="!paymentsValid" color="primary" @click="paymentsValidate">{{ cartDescriptions.next }}</v-btn>
            <v-btn @click="e1 = 2" text>{{ cartDescriptions.back }}</v-btn>
        </v-stepper-content>

        <v-stepper-content step="4">
            <div class="mb-12">
                <Summary :deliveryOptions="deliveryOptions" :cartDescriptions="cartDescriptions" @cartData="cartData = $event" :payments="payments" :shippingDetails="shippingDetails" />
            </div>
            <v-checkbox v-model="regulations">
                <span slot="label">
                    {{ authDescriptions.shop_regulations }} <a @click.stop="" class="register-checkbox-link" download :href="url($store.getters.settings.shop_regulations)">
                        <v-btn class="ml-2" color="primary" small outlined>{{ authDescriptions.download }}</v-btn>
                    </a>
                </span>
            </v-checkbox>
            <v-btn :disabled="!regulations" color="primary" @click="realize">{{ cartDescriptions.realize }}</v-btn>
            <v-btn @click="e1 = 3" text>{{ cartDescriptions.back }}</v-btn>
        </v-stepper-content>
    </v-stepper-items>
    <DeliveryOptions @blockDataEmit="deliveryOptions = $event" />
</v-stepper>
</template>

<script>
import CartMenuListing from './CartMenuListing'
import ShippingDetails from './ShippingDetails'
import Payments from './Payments'
import Summary from './Summary'
import axios from 'axios'
import DeliveryOptions from '@/components/emit-data-blocks/DeliveryOptions'
import url from '@/helpers/photo/url';

export default {
    data() {
        return {
            e1: 1,
            shippingDetailsValid: false,
            shippingDetailsSubmit: false,
            paymentsValid: false,
            paymentsSubmit: false,
            shippingDetails: {},
            payments: {},
            cartData: {},
            deliveryOptions: [],
            regulations: false,
            authDescriptions: {},
            url
        }
    },
    components: {
        CartMenuListing,
        ShippingDetails,
        Payments,
        Summary,
        DeliveryOptions
    },
    computed: {
        cart() {
            return this.$store.getters.cart;
        },
        cartDescriptions() {
            return this.$store.getters.cartDescriptions;
        },
        shopDescriptions() {
            return this.$store.getters.shopDescriptions;
        }
    },
    watch: {
        e1() {
            localStorage.setItem('e1', this.e1);
        }
    },
    methods: {
        shippingDetailsValidate() {
            this.shippingDetailsSubmit = true;
            setTimeout(() => this.shippingDetailsSubmit = false, 20)
        },
        paymentsValidate() {
            this.paymentsSubmit = true;
            setTimeout(() => this.paymentsSubmit = false, 20)
        },
        setOrderError(data) {
            let error = '';
            for (let res of data) {
                error += res['message'] + '<br>';
            }
            this.$store.commit('setSnackbar', error);
            alert(error);
        },
        setCart(data) {
            for (let res of data) {
                let cart = JSON.parse(localStorage.getItem('cart'));
                if (res.delete != undefined || res.amount == 0) cart.splice(cart.indexOf(cart.find(product => JSON.stringify(res.product) == JSON.stringify(product))), 1);
                else if (res.amount != undefined) cart.find(product => JSON.stringify(product) == JSON.stringify(res.product)).amount = res.amount;

                localStorage.setItem('cart', JSON.stringify(cart));
                this.$store.commit('cart', cart);
            }
        },
        getAuthDescriptions() {
            axios.get('/api/auth_descriptions/get_one/1').then(res => this.authDescriptions = res.data);
        },
        realize() {
            if (!confirm(this.shopDescriptions.order_confirm) || !this.regulations) return;

            this.$store.commit('loading', true);
            axios.post('/api/shop_orders/add', this.cartData).then(res => {
                this.$store.commit('loading', false);
                if (res.data.error != undefined) {
                    this.setOrderError(res.data.error.data);
                    this.setCart(res.data.error.data);
                } else {
                    this.$store.commit('setSnackbar', this.$store.getters.snackbarAlerts.order_success);
                    localStorage.setItem('cart', JSON.stringify([]));
                    this.$store.commit('cart', []);
                }
                if (this.cart.length == 0) {
                    localStorage.removeItem('shippingDetails');
                    localStorage.removeItem('payments');
                    localStorage.removeItem('e1');
                    this.$router.push('/');
                }
            }).catch(err => {
                console.log(err);
                this.$store.commit('setSnackbar', this.$store.getters.snackbarAlerts.error);
                this.$store.commit('loading', false);
            })
        }
    },
    created() {
        if (localStorage.getItem('e1')) {
            this.e1 = localStorage.getItem('e1');
        }
        this.getAuthDescriptions();

    }
}
</script>

<style>
.v-stepper__wrapper {
    overflow: unset !important;
}
</style>
