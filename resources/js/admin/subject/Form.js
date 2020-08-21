import AppForm from '../app-components/Form/AppForm';

Vue.component('subject-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title: '',
                description: '',
                course_id: '',
                slug: '',
                enabled: true,
            },
            slugDisabled : true,
            mediaCollections: ['file'],
        }
    },
    methods: {
        courseSelected: function (values) {
            
        },
        sanitizeSlug: function() {
            var title = this.form.title;

            var slug = title.toLowerCase()

            //replace all special characters | symbols with a space
            .normalize('NFD').replace(/[\u0300-\u036f]/g, "") //remove diacritics
            .toLowerCase()
            .replace(/\s+/g, '-') //spaces to dashes
            .replace(/&/g, '-and-') //ampersand to and
            .replace(/[^\w\-]+/g, '') //remove non-words
            .replace(/\-\-+/g, '-') //collapse multiple dashes
            .replace(/^-+/, '') //trim starting dash
            .replace(/-+$/, ''); //trim ending dash
            
            this.form.slug = slug;
        },
    },

});