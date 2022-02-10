<template></template>
<script>
	export default {
		props: ['getFilesSize'],
		computed: {
			validationRules() {
				return this.$store.getters.validationRules;
			}
		},
		methods: {
			required(v) {
				return !!v || this.validationRules.required;
			},
			email(v) {
				const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
				return pattern.test(v) || this.validationRules.email;

			},
			passwordLength(v) {
				return v.length >= 8 || this.validationRules.password_length;
			},
			fileSize(v) {
				return v == null ? true : v.size < 5000000 || this.validationRules.file_size;
			},
			passwordConfirm(password, passwordConf) {
				return password == passwordConf || this.validationRules.password_confirm;
			},
			filesSize(v) {
				return v.length == 0 ? true : this.getFilesSize < 5 || this.validationRules.file_size;
			},
		},


	}
</script>