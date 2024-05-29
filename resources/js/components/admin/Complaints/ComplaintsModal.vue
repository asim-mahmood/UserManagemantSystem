<template>
    <div class="modal fade mt-2" id="complaintsModal" tabindex="-1" aria-hidden="true"
        data-target=".bd-example-modal-lg" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalType }} Complaint</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="$emit('close-modal')"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="circle-container">
                            <div class="circle">
                                <i class="fa-regular fa-file-lines icon"></i>
                            </div>
                        </div>
                        <div class="mt-5 package-container px-3 pb-2 pt-5">
                            <div class="row no-gutters">
                                <div class="col-4 pr-3">
                                    <div class="">
                                        <label class="mb-0">User ID <sup>*</sup></label>
                                        <treeselect v-model="data.user_id" :options="customers" :normalizer="normalizer"
                                            :searchable="true" :clearable="true" :required="true"
                                            placeholder="Select User"></treeselect>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Complainant Name </label>
                                        <input type="text" class="form-control" v-model="data.complaint_by"
                                            placeholder="Complainant By">
                                    </div>
                                </div>
                                <div class="col-4 pl-3">
                                    <div class="form-group">
                                        <label class="mb-0">Call Back No </label>
                                        <input type="number" class="form-control" v-model="data.mobile"
                                            placeholder="Call Back Number" @input="limitNumber">
                                    </div>
                                </div>
                                <div class="col-4 pr-3">
                                    <div class="form-group">
                                        <label class="mb-0">Problem Type <sup>*</sup></label>
                                        <select class="form-control" v-model="data.problem" required>
                                            <option selected disabled value="">Select Problem</option>
                                            <option value="Slow Browsing">Slow Browsing</option>
                                            <option value="No Internet">No Internet</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="mb-0">Date</label>
                                            <date-picker v-model="data.date" type="date" value-type="YYYY-MM-DD"
                                                format="DD-MMM-YYYY" placeholder="DD-MM-YYYY"></date-picker>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="mb-0">Error Details</label>
                                        <textarea type="text" class="form-control" v-model="data.description"
                                            placeholder="Details" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right p-2 border-top">
                        <button type="submit" class="btn btn-outline-info mr-2 px-5" v-if="modalType == 'Add'">
                            <span v-if="!loading">Save</span>
                            <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                        </button>
                        <button type="submit" class="btn btn-outline-info mr-2 px-5" v-if="modalType == 'Edit'">
                            Update</button>
                        <button type="button" class="btn btn-outline-danger px-5" @click="$emit('close-modal')">
                            Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import moment from 'moment';
export default {
    name: 'complaints-modal',
    props: ['modalType', 'objId'],
    components: { DatePicker, Treeselect },
    data() {
        return {
            data: {
                user_id: null,
                complaint_by: '',
                mobile: '',
                problem: '',
                date: moment().format('YYYY-MM-DD'),
                description: ' ',
            },
            loading: false,
            customers: []
        }
    },
    computed: {
        isRequired() {
            return true;
        }
    },
    methods: {
        save() {
            this.loading = true;
            let url = this.modalType == 'Add' ? '/admin/complaints' : `/admin/complaints/${this.objId}`;
            let method = this.modalType == 'Add' ? 'POST' : 'PUT';

            axios({
                url: url,
                method: method,
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
            // console.log('here');
            this.loading = true
            axios({
                url: `/admin/complaints/${this.objId}/edit`,
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
        getCustomers() {
            // console.log('here');
            this.loading = true
            axios({
                url: `/get/customers`,
                method: 'GET',
            })
                .then(response => {
                    this.loading = false
                    this.customers = response.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        closeTab(tabId) {
            this.items = this.items.filter(item => item.id !== tabId)
            if (this.items.length === 0) {
                this.$emit('close-modal')
            }
        },
        normalizer(node) {
            return {
                id: node.id,
                label: node.user_id,
            };
        },
    },
    mounted() {
        if (this.modalType === 'Edit' && this.objId) {
            this.getDataForEdit();
        }
        this.getCustomers();
    },
    watch: {
        'data.mobile'(newVal, oldVal) {
            const maxLength = 11;
            if (newVal.length > maxLength) {
                this.data.mobile = newVal.slice(0, maxLength);
            }
        }
    }
}
</script>
<style scoped>
.form-header {
    background-color: #eaf5ff;
}

.form-header,
h6,
i {
    color: #51aafc;
}

.user {
    display: inline-block;
    /* Ensures that the element is treated as a block, but lays out as an inline-level element */
    overflow: hidden;
    /* Prevents content from overflowing */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 4px 7px;
    background-color: #0561851a;
}

/**Circle Css  */
.circle-container {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 20px;
    left: 362px;

}

.circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    /* Adjust the width as needed */
    height: 80px;
    /* Adjust the height as needed */
    background-color: orange;
    border: 8px solid rgb(255, 255, 255);
    border-radius: 50%;
    box-shadow: 1px 4px 8px rgba(0, 0, 0, 0.377);
    /* Adjust the shadow as needed */
}

.icon {
    font-size: 2rem;
    /* Adjust the font size as needed */
    color: white;
    text-shadow: 1px 4px 4px rgba(0, 0, 0, 0.267);
    font-size: 2.5rem;
}

.package-container {
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.377);
}
</style>
