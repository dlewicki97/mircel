<template>
	<v-row justify="center" class="mt-5 mb-2 px-3">
		<v-dialog v-model="dialog" persistent>
			<template v-slot:activator="{ on, attrs }">
				<v-btn color="primary" dark v-bind="attrs" v-on="on" class="w-100">
					{{ title ? title : 'Dodaj plik' }} 
				</v-btn>
			</template>
			<v-card>
				<v-card-title class="d-flex justify-content-between position-relative">
					<div class="d-flex align-items-center">
						<div>Dodaj plik</div>
						<div class="ml-3">
							<v-text-field label="Szukaj" prepend-icon="mdi-magnify" v-model="search" @change="searchPhoto"></v-text-field>
						</div>
					</div>
					<v-icon class="file-picker-close" @click="dialog = false">mdi-close</v-icon>
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
										<v-col @mouseout="closeIcon = 0" @mouseover="showCloseIcon(file.id)" class="d-flex file-picker-col align-items-between flex-column" lg="2" md="3" sm="4" v-for="file in filteredFiles" :key="file.id">
											<div class="d-flex justify-content-between">
												<v-icon class="check-icon" :color="activeFile == file.id ? 'success' : 'white'">mdi-check</v-icon>
												<v-icon @click="deleteFile(file.id)" :color="closeIcon == file.id ? 'black' : 'white'" class=" close-icon">mdi-close</v-icon>
											</div>
											<v-lazy v-if="file.type.split('/')[0] == 'image'" :options="{ threshold: .5 }" transition="fade-transition" min-height="100px" v-model="lazyFiles[i]">
												<img @click="setFileClass(file.id)" class="image-picker-photo"  :src="url(file.path)">
											</v-lazy>
											<a v-if="file.type.split('/')[0] != 'image'" target="_blank" class="text-center" :href="url(file.path)">
												<v-btn color="primary" >
													<v-icon left>mdi-file</v-icon>
													<span>Podgląd</span>
												</v-btn>
											</a>
											<div @click="setFileClass(file.id)" class="file-picker-file">{{ file.path.split('/')[1] }}</div>
										</v-col>
									</v-row>
								</v-container>
							</v-card-text>
						</v-card>
					</v-tab-item>
					<v-tab-item >
						<AddFiles @loadFiles="loadFiles" />
					</v-tab-item>
				</v-tabs-items>
			</v-card>
		</v-dialog>
	</v-row>
</template>

<script>
	import axios from 'axios';
	import AddFiles from './AddFiles.vue';
	import url from '@/helpers/photo/url';

	export default {
		props:['activeFilePath', 'title', 'loadFlag'],
		data () {
			return {
				dialog: false,
				tab: null,
				tabs: ['Wybierz plik',  'Dodaj Nowe Pliki'],
				files: [],
				activeFile: 0,
				multiple: false,
				closeIcon: 0,
				search: '',
				lazyFiles: [],
				url,

			}
		},
		components:{
			AddFiles
		},
		computed: {
			filteredFiles() {
				let filteredFiles = [];
				for(let file of this.files) {
					if(file.path.toLowerCase().includes(this.search.toLowerCase())) {
						filteredFiles.push(file);
					}
				}
				return filteredFiles;
			},
		},
		watch: {
			files() {
				if(this.files != undefined && this.activeFilePath) this.activeFile = this.getFileByPath(this.activeFilePath).id;
			},
			loadFlag() {
				if(this.loadFlag) this.loadFiles();
			}
		},
		methods:{
			showCloseIcon(id){
				this.closeIcon = id;
			},
			isActiveFileDeleted(id){
				if(this.activeFilePath != null){
					for(let file of this.files){
						if(file.id == id && id == this.activeFile){
							this.$emit('loadedFile', 'placeholder');
							this.$emit('updateDeletedFile');
						}
					}
				}
			},
			
			loadFiles(){
				this.$emit('loadFiles');
				axios.get('/api/media/get_all').then(res =>{
					this.files = res.data;
					for(let file of this.files) {
						this.lazyFiles.push(false);
					}
				});
			},

			deleteFile(id){
				if(confirm('Czy na pewno?')){
					axios.delete('/api/media/delete/'+ id).then(res => {
						this.isActiveFileDeleted(id);
						this.loadFiles();
					}).catch(err => console.log(err));
				}
			},
			getFileById(id){
				for(let i=0 ; i<this.files.length ; i++){
					if(this.files[i].id == id){
						return this.files[i];
					}
				}
			},
			getFileByPath(path){
				for(let i=0 ; i<this.files.length ; i++){
					if(this.files[i].path == path){
						return this.files[i];
					}
				}
			},
			sendFileIdToPlaceholder(){
				let data = [];
				data = this.getFileById(this.activeFile).path;

				this.$emit('loadedFile', data);  
			},
			setFileClass(id){
				this.activeFile = id;

				this.sendFileIdToPlaceholder();
			},



		},
		created(){
			this.loadFiles();
		},
	}
</script>
<style>
	.file-picker-file{
		cursor: pointer;
	}

	.file-picker-close {
		position: absolute!important;
		top: 14%;
		right: 2%;
	}
	
</style>