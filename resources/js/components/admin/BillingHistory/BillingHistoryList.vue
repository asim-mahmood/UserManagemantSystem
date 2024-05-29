<template>
    <div>
        <div class="shadow-sm p-2 mt-3">
            <div class="bg-white p-2 align-items-center">
                <div class="pr-2 d-flex justify-content-between">
                    <h5 class="mb-0">Billing History</h5>
                    <div class="d-flex">
                        <date-picker v-model="start_date" type="date" value-type="YYYY-MM-DD" format="DD-MMM-YYYY"
                            placeholder="Start Date" class="pr-3" @change="getData"></date-picker>
                        <date-picker v-model="end_date" type="date" value-type="YYYY-MM-DD" format="DD-MMM-YYYY"
                            placeholder="End Date" @change="getData"></date-picker>
                    </div>
                    <div class="d-flex">
                        <select class="form-control mr-3" v-model="bill_type">
                            <option value="" selected disabled>Select Billed By</option>
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>                            
                        </select>
                    </div>
                    <div class="d-flex">
                        <select class="form-control mr-3" v-model="search_by">
                            <option value="" selected disabled>Select Billed By</option>
                            <option value="">All</option>
                            <option value="Admin">Admin</option>
                            <option v-for="employee in employees" :key="employee.name" :value="employee.name">{{
                                employee.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-white table-responsive px-2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="py-2">
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                Sr #
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-child pr-2"></i>User Id
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-child pr-2"></i>User Name
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-calendar-days pr-2"></i>Billing Date
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-clipboard-list pr-2"></i>Package
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-calendar-days pr-2"></i>Month
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-calendar-days pr-2"></i>Billed By
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-calendar-days pr-2"></i>Time
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-dollar pr-2"></i>Bill
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-dollar pr-2"></i>Paid Bill
                            </th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">
                                <i class="fa-solid fa-dollar pr-2"></i>Pending Bill
                            </th>
                            <!-- <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-regular fa-trash-can pr-2"></i>Delete</th> -->
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="(obj, index) in filteredData" :key="index">
                            <td class="py-2 text-nowrap align-middle">{{ index + 1 }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit cursor-pointer text-info"
                                data-toggle="modal" data-target="#billingHistory"
                                @click="openHistoryFormModal(obj.customer)">
                                {{ obj.customer_id }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">
                                {{ obj.customer ? obj.customer.user_name : "-" }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">
                                {{ obj.billing_date | dateFormat }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">
                                {{ obj.customer ? obj.customer.package.speed : "-" }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">
                                {{ obj.month }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">
                                {{ obj.billed_by }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">
                                {{ obj.updated_at | timeFormat }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit font-weight-bold text-info">
                                {{ obj.amount ? obj.amount : "0.00" }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit font-weight-bold text-success">
                                {{ obj.paid ? obj.paid : "0.00" }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit font-weight-bold text-warning">
                                {{ obj.pending ? obj.pending : "0.00" }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="fixed-bottom bg-white py-3">
                    <div class="container-fluid">
                        <div class="row text-right mr-4">
                            <div class="col">
                                <strong>Total Amount: <span class="text-info">{{ getTotal('amount') }} </span> </strong>
                            </div>
                            <div class="col">
                                <strong>Total Paid: <span class="text-success">{{ getTotal('paid') }} </span> </strong>
                            </div>
                            <div class="col">
                                <strong>Total Pending: <span class="text-warning">{{ getTotal('pending') }}
                                    </span></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <billing-history-modal v-if="is_history_form_model" modalType='read' :user="billCustomer"
            @close-modal="closeModel">
        </billing-history-modal>
    </div>
</template>
<script>
import moment from "moment";
export default {
    name: "billing-history",
    props: [],
    data() {
        return {
            billing_history: [],
            employees: [],
            start_date: moment().startOf("month").format("YYYY-MM-DD"),
            end_date: moment().format("YYYY-MM-DD"),
            is_history_form_model: false,
            billCustomer: {},
            search_by: '',
            bill_type: ''
        };
    },
    methods: {
        openFormModal(modalType, id) {
            this.modal_type = modalType;
            this.obj_id = id;
            this.is_form_model = true;
        },
        openHistoryFormModal(customer) {
            this.billCustomer = customer
            this.is_history_form_model = true
        },
        closeModel() {
            this.is_history_form_model = false;
            $(".modal-backdrop").remove();
            $("body").removeClass('modal-open');
        },
        filterData() {
            this.data_loading = true;

        },
        getEmployeeData() {
            this.data_loading = true
            axios({
                url: `/admin/get/employees`,
                method: 'GET',
            })
                .then(response => {
                    this.data_loading = false
                    this.employees = response.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        formatAmount(amount) {
            if (amount === undefined || amount === null) {
                return '0.00';
            }
            // Convert amount to string and format with commas
            return parseFloat(amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        },
        getData() {
            this.data_loading = true;
            axios({
                url: `/admin/get/billing_history/${this.start_date}/${this.end_date}`,
                method: "GET",
            })
                .then((response) => {
                    this.data_loading = false;
                    this.billing_history = response.data.data;
                })
                .catch((error) => {
                    this.errorToast(error.response.error);
                });
        },
    },
    watch: {
        // Watch for changes in search_by property
        search_by(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.filterData(); // Call filterData method when search_by changes
            }
        }
    },
    computed: {
        getTotal() {
            return function (column) {
                const total = this.filteredData.reduce((total, obj) => total + parseFloat(obj[column] || 0), 0);
                return this.formatAmount(total);
            }
        },
        filteredData() {
            const searchValue = this.search_by.toLowerCase(); // Convert search_by value to lowercase
            const billType = this.bill_type; // Get the bill_type value           
            if (!searchValue && !billType) {
                return this.billing_history; // Return all data when search_by and bill_type are empty
            }
            return this.billing_history.filter(item => {        
                // Filter based on search_by value
                if ((searchValue == 'admin' && item.billed_by.toLowerCase() == 'admin') || searchValue == '' ||
                    (this.employees.find(employee => employee.name.toLowerCase() == searchValue && item.billed_by.toLowerCase() == searchValue))) {
                    // Check if bill_type is Pending and obj.pending is not 0.00
                    if (billType == 'Pending' && parseFloat(item.pending) > 0.00) {                        
                        return true;
                    }
                    // Check if bill_type is Paid and obj.paid is not 0.00
                    if (billType == 'Paid' && parseFloat(item.paid) !== 0.00 && parseFloat(item.paid) == parseFloat(item.amount) ) {                        
                        return true;
                    }
                    // Return true if no bill_type condition matches
                    if (!billType) {
                        return true;
                    }
                }
                return false; // Otherwise, don't include the item
            });
        }

    },
    mounted() {
        this.getData();
        this.getEmployeeData();
    },
};
</script>
<style scoped>
.user-table-data,
.table thead td {
    padding: 0px;
}

.primary-color {
    color: #007bff;
}

.edit-button {
    color: #007bff;
    text-decoration: none;
    transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
}

.edit-button:hover {
    color: #f08c44;
    /* Change text color on hover */
}

th {
    white-space: nowrap;
}

.desc-limit {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 150px;
}

.edit-button {
    color: #007bff;
    text-decoration: none;
    transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
}

.edit-button:hover {
    color: #f08c44;
}

.complaints-card-body {
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px;
    background-color: white;
}

.tex-size {
    font-size: 0.8rem;
}

.custom-badge {
    display: inline-block;
    width: 28px;
    /* Adjust size as needed */
    height: 28px;
    /* Adjust size as needed */
    border-radius: 50%;
    background-color: #ffc273;
    border: 1px solid #ffa327;
    text-align: center;
    align-items: center;
    display: flex;
    justify-content: center;
    line-height: 50px;
}

.custom-badge i {
    color: white;
}

.badge-shadow {
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
        rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

fieldset {
    border: 1px solid #9c9c9c !important;
    padding: 0 0.5em 0em 0.5em !important;
    margin: 0 !important;
    border-radius: 0.4rem;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
        rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}

legend {
    width: inherit;
    padding: 0 0.4rem;
    border-bottom: none;
    font-size: 0.8rem;
    font-weight: bold;
}

.complaint-dashboard-icon {
    font-size: 3rem;
    color: #fec67d;
    margin-bottom: 0.4rem;
}
</style>
