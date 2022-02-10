<template>
	<v-container fluid>
		<v-select v-model="selectedUsers" :items="searchUser()" return-object :item-text="itemText" label="Użytkownicy" multiple chips>
			<template v-slot:prepend-item>
				<v-list-item>
					<v-text-field v-model="search" @keyup="searchUser" label="Znajdź"></v-text-field>
				</v-list-item>
				<v-list-item ripple @click="toggle" >
					<v-list-item-action>
						<v-icon :color="selectedUsers.length > 0 ? 'primary' : ''">
							{{ icon }}
						</v-icon>
					</v-list-item-action>
					<v-list-item-content>
						<v-list-item-title>
							Wybierz wszystkich
						</v-list-item-title>
					</v-list-item-content>
				</v-list-item>
				<v-list-item ripple @click="selectPlayers" >
					<v-list-item-action>
						<v-icon :color="selectedUsers.length > 0 ? 'primary' : ''">
							{{ playersIcon }}
						</v-icon>
					</v-list-item-action>
					<v-list-item-content>
						<v-list-item-title>
							Tylko zawodnicy
						</v-list-item-title>
					</v-list-item-content>
				</v-list-item>
				<v-divider class="mt-2"></v-divider>

			</template>
			
			<template #selection="{ item }">
				<v-chip color="primary">{{item.name}}</v-chip>
			</template>

		</v-select>
	</v-container>
</template>

<script>
	import axios from 'axios'

	export default {
		data() {
			return {
				users: [],
				selectedUsers: [],
				search: '',
				checkboxes: [],
				selectPlayersFlag: false 
			}
		},

		watch: {
			selectedUsers() {
				this.$emit('users', this.selectedUsers);
			},
			search() {
				this.search = this.search == undefined ?  '' : this.search;
			}
		},

		computed: {
			likesAllFruit () {
				return this.selectedUsers.length === this.users.length;
			},
			likesSomeFruit () {
				return this.selectedUsers.length > 0 && !this.likesAllFruit;
			},
			icon () {
				if (this.likesAllFruit) return 'mdi-close-box';
				if (this.likesSomeFruit) return 'mdi-minus-box';
				return 'mdi-checkbox-blank-outline';
			},
			playersIcon() {
				return this.selectPlayersFlag ? 'mdi-close-box' : 'mdi-checkbox-blank-outline';
			}
		},

		methods: {
			selectPlayers() {
				this.selectPlayersFlag = !this.selectPlayersFlag;
				this.selectedUsers = [];
				if(this.selectPlayersFlag) {
					for(let user of this.users) {
						if(user.type == 'Zawodnik') this.selectedUsers.push(user);
					}
				}
				
			},
			async getUsers() {
				await axios.get('/api/users/get_all').then(res => {
					this.users = res.data; 
				}).catch(err => {
					this.$store.commit('setSnackbar', 'Nie udało się załadować użytkowników...');
				})
			},
			itemText(item) {
				return `${item.name} (${item.email})`;
			},
			toggle() {
				this.selectPlayersFlag = false;
				this.$nextTick(() => {
					if(this.likesAllFruit) {
						this.selectedUsers = [];
					}else {
						this.selectedUsers = this.users.slice();
					}
				});
			},
			searchUser() {
				let filteredUsers = [];
				for(let user of this.users) 
					user.name.toLowerCase().includes(this.search.toLowerCase()) || user.email.toLowerCase().includes(this.search.toLowerCase()) ? filteredUsers.push(user) : true;

				return filteredUsers;
			}
		},
		created() {
			this.getUsers();
		}
	}
</script>