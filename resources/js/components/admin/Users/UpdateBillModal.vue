<template>
    <div class="modal fade" id="updateBilling" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-target=".bd-example-modal-lg" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-3">
            <form @submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Billing Payments</h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="$emit('close-modal')"
                         ><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4 py-2">
                        <!-- <h6 class="text-in-lining text-muted mb-1">Pending Amount</h6> -->
                        <div class="row no-gutters">
                            <div class="col-6 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Package Amount</label>
                                    <input type="text" class="form-control" v-model="data.price" placeholder="00.00 Rs">
                                </div>
                            </div>
                            <div class="col-6 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Installation</label>
                                    <input type="text" class="form-control" v-model="data.installation_charges" placeholder="00.00 Rs">
                                </div>
                            </div>
                            <div class="col-6 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Device Charges</label> <span class=" badge badge-pill badge-info mb-1"  style="font-size:0.55rem !important;"> Split </span>
                                    <input type="text" v-model="data.device_charges" class="form-control" placeholder="00.00 Rs">
                                </div>
                            </div>
                            <div class="col-6 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Security</label>
                                    <input type="text" v-model="data.security" class="form-control" placeholder="00.00 Rs">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="mb-0">Status</label>
                                    <select class="form-control" v-model="data.status">
                                        <option value="Pending" >Pending</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="d-flex justify-content-end border-top py-2 pr-2 align-items-center">
                                    <p class="font-weight-bold mb-0 pr-3">Total Pending Payment: </p>
                                    <h4 class="font-weight-bold mb-0">{{ data.total_bill }} <sub class="text-dark"> Rs </sub></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right p-2 border-top">
                        <button type="submit" class="btn btn-success px-5"><i class="fa-regular fa-floppy-disk text-white"></i> Save</button>
                        <button type="button" class="btn btn-danger px-5" data-dismiss="modal"><i class="fa-solid fa-xmark text-white"></i> Close</button>
                    </div>
                 </div>
            </form>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default {
    name:'update-bill-modal',
    props :['modalType', 'objId'],
    components: { DatePicker},
    data() {
        return {
            data: {
                price: 0,
                installation_charges: 0,
                device_charges: 0,
                security: 0,
                status: '',
                total_bill: 0,
            },
            loading:false,
            packages:null,
        }
    },
    methods: {
        save() {
            this.loading = true;
            axios({
                url: `/admin/users/update/prices/${this.objId}`,
                method: 'POST',
                data: this.data,
            })
                .then(response => {
                    this.loading = false
                    this.successToast(response.data.message)
                    this.$emit('close-modal');
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        getDataForEdit() {
            this.loading = true
            axios({
                url: `/admin/users/${this.objId}/edit`,
                method: 'GET',
            })
            .then(response => {
                this.loading = false
                this.data = response.data.data
            })
            .catch(error => {
                this.errorToast(error.response.error)
            })
        },
        computeTotalBill() {
            this.data.total_bill =
                parseInt(this.data.security ? this.data.security : 0) +
                parseInt(this.data.device_charges ? this.data.device_charges : 0) +
                parseInt(this.data.installation_charges ? this.data.installation_charges : 0) +
                parseInt(this.data.price ? this.data.price : 0);
            },
    },
    watch: {
        'data.security': 'computeTotalBill',
        'data.device_charges': 'computeTotalBill',
        'data.installation_charges': 'computeTotalBill',
        'data.price': 'computeTotalBill',
    },
    mounted() {
        if (this.modalType === 'edit' && this.objId) {
            this.getDataForEdit();
        }
        this.computeTotalBill();
        
    }
}
</script>
<style scoped>
    .text-in-lining {
        position: relative;
        display: flex;
        align-items: center;
    }

    .text-in-lining::before,
    .text-in-lining::after {
        content: "";
        flex: 1;
        height: 1px; /* Adjust the height of the line as needed */
        background-color: rgba(128, 128, 128, 0.708); /* Adjust the color of the line as needed */
        margin: 0px 10px; /* Adjust the spacing between the line and text as needed */
    }

    /* Optional: Adjust the style of the text */
    .text-in-lining {
        margin: 0;
        padding: 0;
    }
</style>
