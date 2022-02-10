<template>
	<v-select  v-model="color" :rules="rules.titleRules" :items="searchColor()" return-object :item-text="itemText" label="Wybierz kolor">
		<template v-slot:prepend-item>
			<v-list-item>
				<v-text-field v-model="search" @keyup="searchColor" label="Znajdź"></v-text-field>
			</v-list-item>

			<v-divider class=""></v-divider>

			<v-list-item>
				<v-text-field v-model="newColor" label="Dodaj nowy"></v-text-field>
				<v-btn color="primary" @click="addColor" :disabled="newColor == ''" text>Wyślij</v-btn>
			</v-list-item>

			<v-divider class=""></v-divider>
		</template>

		<template #selection="{ item }">
			{{item.title}}
		</template>

		<template #item="{ item, on }">
			<div class="d-flex justify-content-between w-100">
				<div v-if="!editing">
					{{ item.title }}
				</div>
				<div v-else>
					<v-text-field @click.stop v-model="item.title"></v-text-field>
					<v-btn text @click.stop="edit(item)" color="primary">Zapisz</v-btn>
					<v-btn text @click.stop="editing = false" color="error">Anuluj</v-btn>
				</div>
				<div>
					<v-icon @click.stop="editing = true">mdi-pencil</v-icon>
					<v-icon @click.stop="destroy(item)">mdi-delete</v-icon>
				</div>
			</div>
		</template>
	</v-select>
</template>

<script>
	import axios from 'axios'

	export default {
		props: ['selectedColor', 'rules'],
		data() {
			return {
				colors: [],
				color: '',
				search: '',
				newColor: '',
				editing: false
			}
		},

		watch: {
			color() {
				this.$emit('color', this.color);
			},
			search() {
				this.search = this.search == undefined ?  '' : this.search;
			},
		},
		methods: {
			itemText: item => item.title,
			async getColors() {
				await axios.get('/api/shop_item_colors/get_all').then(res => {
					this.colors = res.data;
					if(this.selectedColor != 0) this.color = this.colors.find(color => this.selectedColor == color.id); 
				}).catch(err => {
					this.$store.commit('setSnackbar', 'Nie udało się załadować kolorów...');
				})
			},
			searchColor() {
				let filteredcolors = [];
				for(let color of this.colors) 
					color.title.toLowerCase().includes(this.search.toLowerCase()) ? filteredcolors.push(color) : true;

				return filteredcolors;
			},
			async addColor() {
				if(this.newColor == '') return;
				this.$store.commit('loading', true);
				await axios.post(`/api/shop_item_colors/add`, {title: this.newColor}).then(res => {
					this.newColor = '';
					this.$store.commit('loading', false);
					this.$store.commit('setSnackbar', 'Pomyślnie dodano nowy kolor!'); 
					this.getColors();
				}).catch(err => {
					this.$store.commit('loading', false);
					this.$store.commit('setSnackbar', 'Nie udało się dodać koloru...');
				})
			},
			async edit(item) {
				if(item.title == '') return;
				this.$store.commit('loading', true);
				await axios.put(`/api/shop_item_colors/edit`, item).then(res => {
					this.$store.commit('loading', false);
					this.editing = false;
					this.$store.commit('setSnackbar', 'Pomyślnie edytowano kolor!'); 
					this.getColors();
				}).catch(err => {
					this.$store.commit('loading', false);
					this.editing = false;
					this.$store.commit('setSnackbar', 'Nie udało się edytować koloru...');
				})
			},
			async destroy(item) {
				if(!confirm(`Czy na pewno usunąć kolor ${item.title}?`)) return;
				this.$store.commit('loading', true);
				await axios.delete(`/api/shop_item_colors/delete/${item.id}`).then(res => {
					this.$store.commit('loading', false);
					this.$store.commit('setSnackbar', 'Pomyślnie usunięto kolor!'); 
					this.getColors();
				}).catch(err => {
					this.$store.commit('loading', false);
					this.$store.commit('setSnackbar', 'Nie udało się usunąć koloru...');
				})
			}
		},
		created() {
			this.getColors();
		}
	}
</script>