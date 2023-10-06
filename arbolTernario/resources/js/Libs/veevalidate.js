import {defineRule} from "vee-validate";
import AllRules from '@vee-validate/rules';

// validar si esto se necesita
Object.keys(AllRules).forEach(rule => {
	defineRule(rule, AllRules[rule]);
});
//
defineRule('regex', (value, [regex]) => {
	if (!value || !value.length) {
		return true;
	}
	if (!value.match(regex)) {
		return "Your Password must contain lowercase letters, uppercase letters, special character"
	}
	return true
});

defineRule('minLength', (value, [limit]) => {
	if (!value || !value.length) {
		return true;
	}
	if (value.length < parseInt(limit)) {
		return `This field must be at least ${limit} characters`;
	}
	return true;
});

defineRule('confirmed', (value, [target]) => {
	if (value === target) {
		return true;
	}
	return 'Passwords must match';
});

defineRule('required', value => {
	if (!value || !value.length) {
		return 'This field is required';
	}
	return true;
});
