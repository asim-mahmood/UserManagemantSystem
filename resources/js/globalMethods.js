import Vue from 'vue'
import moment from 'moment-timezone';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);


Vue.mixin({

    methods: {
        successToast(text) {
            this.$swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'success',
                text: text,
                showConfirmButton: false,
                customClass: {
                    container: 'sweet-toast-custom-success'
                },
                timer: 1000
            });
            $("body").removeClass("swal2-height-auto");
        },
        errorToast(text) {
            this.$swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'error',
                text: text,
                showConfirmButton: false,
                customClass: {
                    container: 'sweet-toast-custom-error'
                },
                timer: 1000
            });
            $("body").removeClass("swal2-height-auto");
        },
        // activeInactiveApiCall(id, isActive, url) {
        //     axios({
        //         url: url,
        //         method: 'POST',
        //         data: {status:  isActive = !isActive},
        //     })
        //     .then(response => {
        //         if (response.status === 200) {
        //             this.successToast(response.data.message)
        //             // window.location.reload()
        //         }
        //     })
        //     .catch(error => {
        //         this.errorToast(error.response.error)
        //     })
        // }
    },
    filters: {
        timeFormat(time) {
            if (time !== '') {
                const userTimezone = moment.tz.guess(); // Get the user's timezone
                return moment.utc(time).tz(userTimezone).format('h:mm A');
            } else {
                return '';
            }
        },
        dateFormat(date) {
            if (date !== '') {
                const userTimezone = moment.tz.guess(); // Get the user's timezone
                return moment(date).tz(userTimezone).format("DD-MMM-YYYY");
            } else {
                return '';
            }
        },
        stringToIntegerThousandsSeparator(number) {
            if (number) {
                let stringToInteger = parseFloat(number);
                return stringToInteger.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
            }
        },
        replaceUnderscores(value) {
            return value.replace(/_/g, ' ');
        },
        capitalizeFirstLetter(value) {
            if (!value) return '';
            return value.charAt(0).toUpperCase() + value.slice(1);
        },
        // timeFormat(time) {
        //     if (time !== '') {
        //         return moment(time, 'h:mm A').format("h:mm A");
        //     }
        //     else {
        //         return '';
        //     }
        // },
        // dateFormat(date) {
        //     if (date !== '') {
        //         return moment(date).format("DD-MM-YYYY");
        //     }
        //     else {
        //         return '-';
        //     }
        // },

    },
},

)
