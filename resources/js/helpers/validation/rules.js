import store from "@/store/store";

export default async function rules(filesSize = 0) {
    await store;

    const validationRules = store.getters.validationRules;
    return {
        required(v) {
            return !!v || validationRules.required;
        },
        email(v) {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return pattern.test(v) || validationRules.email;
        },
        passwordLength(v) {
            return v.length >= 8 || validationRules.password_length;
        },
        fileSize(v) {
            return v == null
                ? true
                : v.size < 5000000 || validationRules.file_size;
        },
        passwordConfirm(password, passwordConf) {
            return password == passwordConf || validationRules.password_confirm;
        },
        filesSize(v) {
            return v.length == 0
                ? true
                : filesSize < 5 || validationRules.file_size;
        }
    };
}
