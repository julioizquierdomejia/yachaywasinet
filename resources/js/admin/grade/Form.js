import AppForm from '../app-components/Form/AppForm';

Vue.component('grade-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title: '',
                level_id: '',
                courses: '[]',
                enabled: true
            },
            selectedCourses: [],
        }
    },
    methods: {
        updateCourses: function (values) {
            this.form.courses = JSON.stringify(this.selectedCourses);
        }
    },
    created: function () {
        this.selectedCourses = JSON.parse(this.form.courses);
    },

});