export default {
	users: state => state.users,
	userById: state => id => state.users.find(user => user.id == id) 
}