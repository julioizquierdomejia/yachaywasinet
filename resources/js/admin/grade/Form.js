import AppForm from '../app-components/Form/AppForm';

Vue.component('grade-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title: '',
                level_id: '',
                enabled: true
            }
        }
    }

});