import AppForm from '../app-components/Form/AppForm';

Vue.component('course-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title: '',
                competence: '',
                enabled: true,
            }
        }
    }

});