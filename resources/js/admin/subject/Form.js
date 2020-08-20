import AppForm from '../app-components/Form/AppForm';

Vue.component('subject-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title: '',
                description: '',
                course_id: '',
                enabled: true,
            },
            mediaCollections: ['file'],
        }
    },
    methods: {
        courseSelected: function (values) {
            
        }
    },

});