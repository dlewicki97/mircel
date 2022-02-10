<template>
	<v-row justify="center" class="mt-5 mb-2 px-3 image-picker">
		<v-dialog v-model="dialog" persistent style="background-color: white!important">
			<template v-slot:activator="{ on, attrs }">
				<v-btn v-if="!title" color="primary" dark v-bind="attrs" v-on="on" class="w-100">
					Dodaj {{ multiple ? 'zdjęcia' : $route.path.split('/')[2] == 'settings' ? 'logo' : 'zdjęcie' }} {{ banner ? 'banerowe' : '' }}
				</v-btn>
				<v-btn v-else color="primary" dark v-bind="attrs" v-on="on" class="w-100">
					Dodaj {{ title }}
				</v-btn>
			</template>
			<v-card>
				<v-card-title class="d-flex justify-content-between position-relative">
					<div class="d-flex align-items-center">
						<div>Dodaj zdjęcia</div>
						<div class="ml-3">
							<v-text-field label="Szukaj" prepend-icon="mdi-magnify" v-model="search" @change="searchPhoto"></v-text-field>
						</div>
					</div>
					<v-icon class="image-picker-close" @click="dialog = false">mdi-close</v-icon>
				</v-card-title>
				<v-tabs v-model="tab" background-color="primary" dark>
					<v-tab v-for="tab in tabs" :key="tab">
						{{ tab }}
					</v-tab>
				</v-tabs>

				<v-tabs-items v-model="tab">
					<v-tab-item >
						<v-card flat>
							<v-card-text>
								<v-container>
									<v-row class="d-flex align-items-center">
										<v-col @mouseout="closeIcon = 0" @mouseover="showCloseIcon(photo.id)" class="d-flex align-items-between flex-column" lg="2" md="3" cols="6" sm="4" v-for="(photo, i) in filteredPhotos" :key="photo.id">
											
											<div class="d-flex justify-content-between">
												<v-icon class="check-icon" :color="activePhotos.includes(photo.id) || activePhoto == photo.id ? 'success' : 'white'">mdi-check</v-icon>
												<v-icon @click="deletePhoto(photo.id)" :color="closeIcon == photo.id ? 'black' : 'white'" class=" close-icon">mdi-close</v-icon>
											</div>
											<v-lazy :options="{ threshold: .5 }" transition="fade-transition" min-height="100px" v-model="lazyPhotos[i]">
												<img @click="setPhotoClass(photo.id)" class="image-picker-photo" :src="url(photo.path)" />
											</v-lazy>
											<div>{{ photo.path }}</div>
										</v-col>
									</v-row>
								</v-container>
							</v-card-text>
						</v-card>
					</v-tab-item>
					<v-tab-item >
						<AddPhotos @loadPhotos="loadPhotos" />
					</v-tab-item>
				</v-tabs-items>
			</v-card>
		</v-dialog>
	</v-row>
</template>

<script>
	import axios from 'axios';
	import AddPhotos from './AddPhotos.vue';
	import url from '../../helpers/photo/url.js';

	export default {
		props:['activePhotoPath', 'banner', 'apiGallery', 'title'],
		data () {
			return {
				dialog: false,
				tab: null,
				tabs: ['Wybierz zdjęcie',  'Dodaj Nowe Zdjęcie'],
				photos: [],
				lazyPhotos: [],
				activePhotos: [],
				activePhoto: 0,
				multiple: this.$route.path.split('/')[3] == 'gallery' ? true: false,
				closeIcon: 0,
				url,
				search: '',
			}
		},
		components:{
			AddPhotos
		},
		watch: {
			apiGallery() {
				this.loadPhotos();
				this.activePhotos = [];
			},
		},
		computed: {
			filteredPhotos() {
				let filteredPhotos = [];
				for(let photo of this.photos) {
					if(photo.path.toLowerCase().includes(this.search.toLowerCase())) {
						filteredPhotos.push(photo);
					}
				}
				return filteredPhotos;
			},
		},
		
		methods:{
			setActivePhotoPath() {
				for(let photo of this.photos) {
					if(photo.path == this.activePhotoPath) {
						this.activePhoto = photo.id;
					} 
				}
			},
			showCloseIcon(id){
				this.closeIcon = id;
			},
			isActivePhotoDeleted(id){
				if(this.activePhotoPath !== null){
					for(let photo of this.photos){
						if(photo.id == id && id == this.activePhoto){
							this.$emit('loadedImage', 'placeholder');
							this.$emit('updateDeletedPhoto');
						}
					}
				}
			},
			setApiGallery() {
				if(this.apiGallery) {
					let photos = [];
					for(let i=0 ; i<this.photos.length ; i++) {
						if(!this.apiGallery.some(a => a.path == this.photos[i].path)) {
							if(!photos.includes(this.photos[i])) photos.push(this.photos[i]);
						}
					}
					this.photos = photos;
				}

			},
			loadPhotos(){
				axios.get('/api/media/get_photos').then(res =>{
					this.photos = res.data;
					for(let photo of this.photos) {
						this.lazyPhotos.push(false);
					}

					this.setApiGallery();
					if(this.activePhotoPath) this.setActivePhotoPath();
				});
			},

			deletePhoto(id){
				if(confirm('Czy na pewno?')){
					axios.delete('/api/media/delete/'+ id).then(res => {
						this.isActivePhotoDeleted(id);
						this.loadPhotos();
					}).catch(err => console.log(err));
				}
			},
			getPhotoLinks(){
				let links = [];

				for(let i=0 ; i< this.photos.length ; i++){
					for(let j = 0 ; j < this.activePhotos.length ; j++){
						if(this.photos[i].id == this.activePhotos[j]) links[0] = this.photos[i];
					}

				}
				return links;
			},
			sendImageIdToPlaceholder(){
				let data = [];
				if(this.multiple) {
					for(let activePhoto of this.activePhotos) {
						data.push(this.getPhotoById(activePhoto));
					}

				} else data = this.getPhotoById(this.activePhoto);

				this.$emit('loadedImage', data);  
			},
			setPhotoClass(id){
				if(this.multiple){
					if(!this.activePhotos.includes(id)) this.activePhotos.push(id);
					else this.activePhotos.splice(this.activePhotos.indexOf(id),1);
				}else{
					this.activePhoto = id;
				}

				this.sendImageIdToPlaceholder();
			},
			getPhotoById(id){
				for(let i=0 ; i<this.photos.length ; i++){
					if(this.photos[i].id == id){
						return this.photos[i].path;
					}
				}
			},



		},
		created(){
			this.loadPhotos();
		},
	}
</script>
<style>
	.image-picker-photo{
		cursor: pointer;
		height: auto;
		width: 100%;
	}
	.image-picker-close {
		position: absolute!important;
		top: 14%;
		right: 2%;
	}

	.v-dialog {
		background-color: white!important;
	}
</style>