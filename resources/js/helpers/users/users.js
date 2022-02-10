import Store from '../../store/store.js'

export function user(user_id) {
	for(user of Store.getters.users) {
		if(user.id === user_id) {
			return user;
		}
	}
}