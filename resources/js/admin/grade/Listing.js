import AppListing from '../app-components/Listing/AppListing';

Vue.component('grade-listing', {
    mixins: [AppListing],
    props: {
        'leveltype': {
            type: Array,
            required: true
        },
        'courses': {
            type: Array,
            required: true
        }
    }
});