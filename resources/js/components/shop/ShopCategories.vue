<template>
	<v-list dense>
		<h3 class="shop-categories-title">{{ shopDescriptions.product_categories }}</h3>
		<v-list-item-group color="primary" >
			<router-link to="/sklep">
				<v-list-item link :class="['shop-category', {'v-list-item--active': !$route.params.category_id && $route.name != 'SingleProduct'}]">
					<v-list-item-content>
						<v-list-item-title class="shop-category-title" v-text="shopDescriptions.all"></v-list-item-title>
					</v-list-item-content>
				</v-list-item>
			</router-link>
			<router-link :to="`/sklep/${category.id}/1`" v-for="(category, i) in shopCategories" :key="i">
				<v-list-item link  :class="['shop-category', {'v-list-item--active': activeCategory(category.id)}]" >
					<v-list-item-content>
						<v-list-item-title class="shop-category-title" v-text="category.title"></v-list-item-title>
					</v-list-item-content>
				</v-list-item>
			</router-link>
		</v-list-item-group>
	</v-list>
</template>
<script>
	import axios from 'axios'
	
	export default {
		props:['reloadFlag', 'category_id'],
		data() {
			return {
				shopCategories: [],
				shopDescriptions: {}
			}
		},
		methods: {
			getShopDescriptions() {
				axios.get('/api/shop_descriptions/get_one/1').then(res => this.shopDescriptions = res.data);
			},
			getCategories(){
				this.$store.commit('loading', true);
				let endpoint = `get_all`;
				if(this.$route.path == '/sklep') endpoint = `get_where?active=1`;

				axios.get(`/api/shop_categories/${endpoint}`).then(res => {
					this.$store.commit('loading', false);
					this.shopCategories = res.data;
					this.emitCategory();
					this.$emit('blockDataEmit', this.shopCategories);
				}).catch(err => {
					this.$store.commit('loading', false);
					console.log(err);
				})
			},
			emitCategory() {
				this.$emit('category', this.shopCategories.find(cat => cat.id == this.$route.params.category_id));
			},
			activeCategory(id) {
				return this.$route.params.category_id == id || id == this.category_id;
			}
		},
		created() {
			this.getCategories();
			this.getShopDescriptions();
		},
		watch:{
			reloadFlag() {
				if(this.reloadFlag) this.getCategories();
			},
			'$route'() {
				this.emitCategory();
				if(this.$route.name != 'SingleProduct') this.$emit('category_id', null)
			}
		},
	}
</script>

<style>
	.shop-categories-title {
		font-weight: 600;
		margin-bottom: 1.3rem;
		font-size: 1.9rem;
	}
	.shop-category {
		border-left: 3px solid lightgrey;
	}
	.shop-category:hover, .shop-category.v-list-item--active {
		border-color: var(--first-color);
	}
	.shop-category:hover .shop-category-title {
		color: var(--first-color)!important;
	}
	.shop-category-title {
		font-size: 1.2rem!important;
	}
</style>