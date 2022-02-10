<template>
	<v-card flat>
		<v-card-text>
			<v-row class="d-flex justify-content-center">
				<v-col lg="4" sm="12" md="4">
					<v-file-input id="file" v-model="file"  multiple show-size counter label="Pliki" prepend-icon="mdi-files"></v-file-input>
					<v-btn :disabled="loading" :loading="loading" @click="submit" class="" color="success">
						<v-icon left class="">mdi-check</v-icon>
						<span>Wyślij</span>
					</v-btn>
				</v-col>
			</v-row>


		</v-card-text>
	</v-card>
</template>

<script>
	import axios from 'axios';
	
	export default{
		data(){
			return{
				file: [],
				loading: false
			}
		},
		methods:{
			submit(){
				if(this.file.length == 0) return;
				this.loading = true;
				for(let i=0 ; i<this.file.length ; i++ ){
					let formData = new FormData();
					formData.append('file', this.file[i]);
					axios.post('/api/media/add',formData).then(res=>{
						this.loading = false;
						this.$emit('loadFiles');
						this.file = [];
						this.$store.commit('setSnackbar', 'Pomyślnie dodano!');
					}).catch(err=>{
						this.loading = false;
						console.log(err);
						this.$store.commit('setSnackbar', 'Coś poszło nie tak...');
					});
				} 
			},
		}
	}
</script>