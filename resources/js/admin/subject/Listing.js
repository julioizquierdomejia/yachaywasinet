import AppListing from '../app-components/Listing/AppListing';

Vue.component('subject-listing', {
    mixins: [AppListing],
    props: {
        'courses': {
            type: Array,
            required: true
        }
    }
});