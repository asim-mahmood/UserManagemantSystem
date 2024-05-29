<template>
    <div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-4">
            <div class="position-relative p-3 bg-gray" style="height: 180px">
            <div class="ribbon-wrapper">
            <div class="ribbon bg-primary">
            Ribbon
            </div>
            </div>
            Ribbon Default <br>
            <small>.ribbon-wrapper.ribbon-lg .ribbon</small>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="position-relative p-3 bg-gray" style="height: 180px">
            <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-info">
            Ribbon Large
            </div>
            </div>
            Ribbon Large <br>
            <small>.ribbon-wrapper.ribbon-lg .ribbon</small>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="position-relative p-3 bg-gray" style="height: 180px">
            <div class="ribbon-wrapper ribbon-xl">
            <div class="ribbon bg-secondary">
            Ribbon Extra Large
            </div>
            </div>
            Ribbon Extra Large <br>
            <small>.ribbon-wrapper.ribbon-xl .ribbon</small>
            </div>
            </div>
            </div>
        </div>

    </div>
</template>

<script>
import moment from 'moment';
export default {
    name: "customer-notes",
    props: [ 'customerId', 'customerType'],
    data() {
        return {
            crud_loading: false,
            loading: false,
            notes: '',
        }
    },
    // methods: {
    //     save() {
    //         this.crud_loading = true;
    //         let url = '/admin/customer/notes';
    //         let method = 'POST';
    //         axios({
    //             url: url,
    //             method: method,
    //             data: {
    //                 customer_id: this.customerId,
    //                 notes: this.notes,
    //                 customer_type: this.customerType,
    //             },
    //         })
    //         .then(response => {
    //             this.crud_loading = false
    //             this.$emit('close-modal')
    //             $(".modal-backdrop").remove();
    //             $("body").removeClass('modal-open');
    //             // this.successToast(response.data.message)
    //             // window.location.reload();
    //         })
    //         .catch(error => {
    //             this.errorToast(error.response.statusText)
    //         });
    //     },
    //     getCustomerNotes() {
    //         this.loading = true
    //         let url = '/admin/management/get/customer/notes';
    //         let method = 'POST';
    //         axios({
    //             url: url,
    //             method: method,
    //             data: {
    //                 customer_id: this.customerId,
    //                 customer_type: this.customerType,
    //             },
    //         })
    //         .then(response => {
    //             this.loading = false
    //             if (Object.keys(response.data).length !== 0){
    //                 this.notes = response.data
    //             }
    //         })
    //         .catch(error => {
    //             this.errorToast(error.response.error)
    //         })
    //     }
    // },
    // mounted() {
    //     this.getCustomerNotes();
    // }
}
</script>
<style scoped>
.table-color{
    background-color: #f7fffd!important;
}
.header-color{
    background-color: lightblue;
}

</style>
