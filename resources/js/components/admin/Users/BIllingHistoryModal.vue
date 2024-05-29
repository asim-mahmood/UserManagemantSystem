<template>
    <div class="modal fade" id="billingHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-target=".bd-example-modal-lg" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-0 modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title"><span v-if="modalType == 'read'">User</span> Billing History</h5>
                    </div>
                    <div class="d-flex justify-content-end align-items-center" v-if="modalType != 'read'">
                        <!-- <label class="mb-0 pr-3" style="text-wrap: nowrap;">Billing Date</label> -->
                        <date-picker v-model="bill.billing_date" type="date" value-type="YYYY-MM-DD"
                            format="DD-MMM-YYYY" placeholder="DD-MM-YYYY"></date-picker>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="$emit('close-modal')"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body p-3">
                    <form @submit.prevent="save">
                        <fieldset class="p-2 border mb-0" v-if="modalType != 'read'">
                            <legend class=" mb-0 px-3">
                                {{ user.user_name ? user.user_name : 'No Name Found' }}
                            </legend>
                            <div class="row no-gutters py-2">
                                <div class="col-4 pr-2 pb-3">
                                    <label class="mb-0">Package</label>
                                    <input type="text" v-model="user.package.speed" class="form-control" disabled>
                                </div>
                                <div class="col-4 pr-2 pb-3">
                                    <label class="mb-0">User ID</label>
                                    <input type="text" v-model="user.user_id" class="form-control" disabled>
                                </div>
                                <div class="col-4 pb-3">
                                    <label class="mb-0">Amount</label>
                                    <input type="number" v-model="user.package.price" class="form-control"
                                        placeholder="Total Amount" readonly>
                                </div>
                                <div class="col-4 pr-2">
                                    <label class="mb-0">Month</label>
                                    <select v-model="bill.month" class="form-control" required>
                                        <option value="" disabled selected>Select month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <div class="col-4 pr-2">
                                    <label class="mb-0">Paid</label>
                                    <input type="number" v-model="bill.paid" class="form-control"
                                        placeholder="No Paid Amount" @input="getPendingAmount">
                                </div>
                                <div class="col-4">
                                    <label class="mb-0">Pending</label>
                                    <input type="number" v-model="bill.pending" class="form-control"
                                        placeholder="No Pending Amount" readonly>
                                </div>
                            </div>
                        </fieldset>
                        <div class="bg-gradient-white table-responsive border">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="py-2">
                                        <th scope="col" class="py-2">Sr #</th>
                                        <th scope="col" class="py-2">User ID</th>
                                        <th scope="col" class="py-2">User Name</th>
                                        <th scope="col" class="py-2">Billing Date</th>
                                        <th scope="col" class="py-2">Package</th>
                                        <th scope="col" class="py-2">Month</th>
                                        <th scope="col" class="py-2">Billed By</th>
                                        <th scope="col" class="py-2">Bill</th>
                                        <th scope="col" class="py-2">Paid Bill</th>
                                        <th scope="col" class="py-2">Pending Bill</th>
                                        <th scope="col" class="py-2" v-if="modalType != 'read'">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(obj, index) in previous_bills" :key="index">
                                        <td scope="col" class="py-2 align-middle">{{ getSerialNumber(index) }}</td>
                                        <td scope="col" class="py-2 align-middle">{{ obj.customer_id }}</td>
                                        <td scope="col" class="py-2 align-middle">{{ user.user_name }}</td>
                                        <td scope="col" class="py-2 align-middle">{{ obj.created_at | dateFormat }}</td>
                                        <td class="py-2 align-middle">{{ getPackageSpeed(obj.package_id) }}</td>
                                        <td scope="col" class="py-2 align-middle">{{ obj.month }}</td>
                                        <td scope="col" class="py-2 align-middle">{{ obj.billed_by }}</td>
                                        <td scope="col" class="py-2 align-right text-info">{{ obj.amount ? obj.amount :
                            0 }}</td>
                                        <td scope="col" class="py-2 align-right text-success">{{ obj.paid ? obj.paid : 0
                                            }}</td>
                                        <td scope="col" class="py-2 align-right text-warning">{{ obj.pending ?
                            obj.pending : 0 }}</td>
                                        <td scope="col" class="py-2 align-middle" v-if="modalType != 'read'">
                                            <span class="text-info cursor-pointer pr-3" @click="updateBill(obj)"><i
                                                    class="fa-solid fa-square-pen"></i></span>
                                            <span class="text-danger cursor-pointer"
                                                @click="deleteBill(obj, obj.customer_id)"><i
                                                    class="fa-regular fa-trash-can"></i></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border bg-light p-2 mt-2 shadow-sm row no-gutters">
                            <div class="col-10">
                                <h6>Pending Amount:</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="text-danger text-right h6">PKR {{ getPendingAmountTotal }}</h6>
                            </div>
                        </div>
                        <div class="text-right p-2 border-top">
                            <button type="submit" v-if="modalType == 'add'" class="btn btn-outline-info mr-3 px-5">
                                SAVE</button>
                            <button type="submit" v-if="modalType == 'edit'" class="btn btn-outline-info mr-3 px-5">
                                UPDATE</button>
                            <button type="button" class="btn btn-outline-danger mr-3 px-5" data-dismiss="modal"
                                @click="$emit('close-modal')"> CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
export default {
    name: 'billing-history-modal',
    props: ['modalType', 'user'],
    components: { DatePicker },
    data() {
        return {
            bill: {
                user_id: this.user.user_id,
                month: '',
                billing_date: moment().format('YYYY-MM-DD'),
                amount: this.user.package.price,
                package_id: this.user.package.id,
                paid: this.user.package.price,
                pending: '',
            },
            packages: [],
            is_update_bill: false,
            previous_bills: [],
            loading: false,
        }
    },
    computed: {
        shouldShowContent() {
            return this.obj.is_deleted !== 1;
        }
    },
    methods: {
        save() {
            this.loading = true;
            let url = this.modalType == 'add' ? '/admin/users/add-bill' : `/admin/users/update-bill/${this.objId}`;
            let method = this.modalType == 'add' ? 'POST' : 'PUT';

            axios({
                url: url,
                method: method,
                data: this.bill,
            })
                .then(response => {
                    this.loading = false
                    this.successToast(response.data.message)
                    // this.$emit('close-modal');
                    this.getFormData()
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        getSerialNumber(originalIndex) {
            let serialNumber = 1; // initialize the counter

            // Loop through previous_bills to find the appropriate serial number
            for (let i = 0; i < originalIndex; i++) {
                if (this.previous_bills[i].is_deleted !== 1) {
                    serialNumber++;
                }
            }

            return serialNumber;
        },
        getPrice(id) {
            const selectedPackage = this.packages.find(obj => obj.id === id);
            if (selectedPackage) {
                this.data.price = selectedPackage.price;
                this.data.package_id = selectedPackage.id;
            }
        },
        updateBill(obj) {
            this.modalType = 'edit'
            this.objId = obj.id
            this.bill = obj
        },
        deleteBill(obj, customer_id) {
            axios.delete(`/admin/users/delete-bill/${obj.id}/${customer_id}`)
                .then(response => {
                    this.successToast(response.data.message);
                    this.getFormData(); // Assuming you have a method to refresh data
                })
                .catch(error => {
                    console.error('Error deleting bill', error);
                    this.errorToast('Error deleting bill');
                });
        },
        closeTab(tabId) {
            this.items = this.items.filter(item => item.id !== tabId)
            if (this.items.length === 0) {
                this.$emit('close-modal')
            }
        },
        getPendingAmount() {
            this.bill.pending = this.bill.amount - this.bill.paid
        },
        getDataForEdit() {
            console.log('here');
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
        getFormData() {
            this.data_loading = true
            axios({
                url: `/admin/get/bills/form/data`,
                method: 'POST',
                data: {
                    userId: this.user.user_id
                },
            })
                .then(response => {
                    this.data_loading = false
                    this.packages = response.data.packages
                    this.previous_bills = response.data.previous_bills
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        }
    },
    computed: {
        // Compute the package speed based on the package_id
        getPackageSpeed() {
            return (packageId) => {
                const foundPackage = this.packages.find((pkg) => pkg.id === packageId);
                return foundPackage ? foundPackage.speed : 'N/A';
            };
        },
        getPendingAmountTotal() {
            return this.previous_bills.reduce((total, bill) => {
                if (bill.is_deleted === 0) {
                    return total + bill.pending;
                }
                return total;
            }, 0);
        }

    },
    watch: {
        'data.package_id': function (newId, oldId) {
            if (newId !== oldId) {
                this.getPrice(newId); // Call getPrice whenever package_id changes
            }
        },
    },
    mounted() {
        this.getFormData();
        // if (this.modalType === 'edit' && this.objId) {
        //     this.getDataForEdit();
        // }
    }
}
</script>
<style scoped>
/* Input User Style Label inside the border  */
.input-wrapper {
    position: relative;
}

.custom-input-style {
    border: 1px solid gray;
    position: relative;
    margin: 10px;
    line-height: 6ex;
}

.custom-label-input {
    position: absolute;
    top: 0.2ex;
    z-index: 1;
    left: 2em;
    background-color: white;
    padding: 0 5px;
}

fieldset {
    border: 1px solid #094658 !important;
    padding: 0 1em 1em 1em !important;
    margin: 0 0 1em 0 !important;
    border-radius: 0.4rem;
}

legend {
    width: inherit;
    padding: 0 0.9rem;
    border-bottom: none;
    font-size: 1rem;
    color: #094658;
}

.custom-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.custom-container::before,
.custom-container::after {
    content: "";
    flex: 1;
    height: 2px;
    /* Adjust the height of the line as needed */
    background-color: #094658;
    /* Adjust the color of the line as needed */
    margin: 0px 0px;
    /* Adjust the spacing between the line and the container as needed */
}

.circle-bg {
    position: relative;
    background-color: #64dbff;
    border: #094658 2px solid;
    width: 40px;
    /* Adjust the size of the circle */
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.381);
}

.icon-custom {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #094658;
    /* Set the icon color */
    font-size: 1.2rem
}

.pill-bg {
    position: relative;
    background-color: #64dbff;
    border: #094658 2px solid;
    width: auto;
    /* Adjust the width of the pill */
    height: 40px;
    /* Adjust the height of the pill */
    border-radius: 20px;
    /* Set border-radius to half of the height for a pill shape */
    box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.381);
    padding: 4px 8px;
}
</style>
