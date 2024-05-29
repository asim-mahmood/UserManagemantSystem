<template>
    <div>
        <div class="container-fluid p-3">
            <div class="border-bottom text-muted p-3 d-flex justify-content-between align-items-center">
                <!-- <h5><i class="fa-solid fa-building"></i> Ledgers  <button class="btn btn-outline-info border-0 btn-flat mr-3"><i class="fa-solid fa-plus"></i> Add New Account</button><button class="btn btn-outline-info border-0 btn-flat"><i class="fa-solid fa-plus"></i> Add Transaction</button></h5>                           -->
                <h5>
                    <button class="btn btn-outline-info border-0 btn-flat mr-3" 
                        data-toggle="modal"
                        data-target="#addTransactioModal"
                        @click= "openFormModal('Add', null)"><i class="fa-solid fa-plus"></i> Add Transaction
                    </button>
                    <button class="btn btn-outline-info border-0 btn-flat" 
                        data-toggle="modal"
                        data-target="#addAccountModal"
                        @click= "openAccountModal('Add', null)">
                        <i class="fa-solid fa-plus"></i> 
                        Add New Account
                    </button>
                </h5>                          
            </div>
            <div class="row no-gutters pt-3">
                <div class="col-6 d-flex">
                    <!-- <button class="btn btn-primary btn-sm badge-pill mr-2"><i class="fa-solid fa-plus"></i> Add Transaction</button> -->
                    <!-- <button class="btn btn-warning btn-sm badge-pill mr-2"><i class="fa-solid fa-book"></i> Create New Head</button>
                    <button class="btn btn-info btn-sm badge-pill"><i class="fa-solid fa-file-pdf"></i> Download / <i class="fa-solid fa-print"></i> Print</button> -->
                </div>
                <!-- <div class="col-3 pr-2">
                    <select class="custom-select badge-pill border-primary" id="inputGroupSelect01">
                        <option selected>Select Days</option>
                        <option value="1">Today</option>
                        <option value="2">7 Days</option>
                        <option value="3">1 Month</option>
                        <option value="4">3 Month</option>
                        <option value="5">6 Month</option>
                        <option value="6">1 Year</option>
                    </select>
                </div>
                <div class="col-3">
                    <input type="search" class="form-control badge-pill border-primary " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search">
                </div> -->
            </div>
            <!-- <div class="pt-3 pb-2 justify-content-end d-flex">
                <nav >
                    <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                    </ul>
                </nav>
            </div> -->
            <div>
                <table class="table table-striped border rounded">
                    <thead>
                        <tr class="text-muted">
                            <!-- <th scope="col"><input type="checkbox"/></th> -->
                            <th scope="col">#</th>
                            <th scope="col"><i class="fa-solid fa-qrcode"></i> Account ID</th>
                            <!-- <th scope="col"><i class="fa-solid fa-calendar-days"></i> Date</th> -->
                            <th scope="col"><i class="fa-solid fa-book"></i> Account Title</th>
                            <th scope="col"><i class="fa-regular fa-circle-question"></i> Type</th>
                            <!-- <th scope="col"><i class="fa-solid fa-money-bill-transfer"></i> Method</th> -->
                            <!-- <th scope="col"><i class="fa-solid fa-circle-user"></i> R/P By</th> -->
                            <th scope="col"><i class="fa-solid fa-sack-dollar"></i> Amount</th>
                            <th scope="col"><i class="fa-solid fa-pencil"></i> Narration</th>
                            <!-- <th scope="col"><i class="fa-solid fa-cash-register"></i> Balance</th> -->
                            <th scope="col"><i class="fa-regular fa-trash-can"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(obj, index) in transactions" :key="index">
                            <!-- <td><input type="checkbox"/></td> -->
                            <td class="py-2 text-nowrap align-middle">{{ index + 1 }}</td>
                            <td class="py-2 text-nowrap align-middle edit-button cursor-pointer " data-toggle="modal" data-target="#addTransactioModal" @click= "openFormModal('Edit', obj.id)">
                                {{ obj.account.title}}
                            </td>
                            <td class="py-2 text-nowrap align-middle">
                                {{ obj.account.name }}
                            </td>                                    
                            <td class="py-2 text-nowrap align-middle">
                                <i v-if="obj.account.head.name === 'Income'" class="fa-solid fa-circle-arrow-up text-success"></i>
                                    <i v-else-if="obj.account.head.name === 'Expense'" class="fa-solid fa-circle-arrow-down text-danger"></i>
                                {{ obj.account.head.name }}
                            </td>
                            <td :class="['py-2 text-nowrap align-middle', {'text-success' : obj.account.head.name === 'Income'}, {'text-danger' : obj.account.head.name === 'Expense'}]">                                        
                                Rs. <span class="font-weight-bold">{{ formatAmount(obj.amount) }}</span> 
                            </td>       
                            <td class="py-2 text-nowrap align-middle">
                                {{ obj.narration }}
                            </td>                     
                            <td><i class="fa-regular fa-trash-can text-danger"></i></td>
                        </tr>                                 
                    </tbody>
                </table>
            </div>
        </div>
        <transaction-modal
            v-if="is_form_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </transaction-modal>
        <add-account-modal
            v-if="is_account_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </add-account-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "transactions-list",
    props: [],
    data() {
        return {
            transactions: '',
            modal_type: '',
            obj_id: '', 
            loading: false,
            is_form_model: false,
            is_account_model: false,
            defaultEmployeeId: 'defaultEmployeeId', // Set default employee id here
            defaultEmployeeName: 'Default Employee',

        }
    },    
    methods: {
        openFormModal(modalType, id) {
            this.modal_type = modalType
            this.obj_id = id
            this.is_form_model = true
        },
        formatAmount(amount) {
            if (amount === undefined || amount === null) {
                return '0.00';
            }
            // Convert amount to string and format with commas
            return parseFloat(amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        },
        openAccountModal(modalType, id) {
            this.modal_type = modalType
            this.obj_id = id
            this.is_account_model = true
        },
        getData() {
            this.data_loading = true
            axios({
                url: `/admin/get/transactions`,
                method: 'GET',
            })
            .then(response => {
                this.data_loading = false
                this.transactions = response.data.data
                this.employees = response.data.employees
            })
            .catch(error => {
                this.errorToast(error.response.error)
            })
        },       
        closeModel(){
            this.is_form_model=false;
            this.is_account_model=false;
            this.getData();
            $(".modal-backdrop").remove();
            $("body").removeClass('modal-open');
        },
        deleteInventory(objId) {
            axios.delete(`/admin/employees/${objId}`)
            .then(response => {
                this.successToast(response.data.message);
                this.getData();
            })
            .catch(error => {
                console.error('Error deleting employee', error);
                this.errorToast('Error deleting employees');
            });
        },
    },
    computed:{
        
    },
    mounted() {
        this.getData();
    },
    
    
}
</script>
<style scoped>
    .user-table-data, .table thead td{
        padding: 0px;
    }
    .primary-color{
        color: #007bff;
    }
    .edit-button{
        color: #007bff;
        text-decoration: none;
        transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
    }
    .edit-button:hover{
        color: #f08c44; /* Change text color on hover */
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
    .edit-button{
        color: #007bff;
        text-decoration: none;
        transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
    }
    .edit-button:hover{
        color: #f08c44; 
    }
    .complaints-card-body{
        padding: 1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px;
        background-color: white;
        
    }
    .tex-size{
        font-size: 0.8rem;
    }
    .custom-badge {
        display: inline-block;
        width: 28px; /* Adjust size as needed */
        height: 28px; /* Adjust size as needed */
        border-radius: 50%;
        background-color: #ffc273;
        border:1px solid #ffa327;
        text-align: center;
        align-items: center;
        display: flex;
        justify-content: center;
        line-height: 50px; 
    }
    .custom-badge i {
        color: white;
    }
    .badge-shadow{
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }
    fieldset {
        border: 1px solid #9c9c9c !important;
        padding: 0 0.5em 0em 0.5em !important;
        margin: 0  !important;
        border-radius: 0.4rem;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
    }
    legend {
        width:inherit;
        padding:0 0.4rem;
        border-bottom:none;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .complaint-dashboard-icon{
        font-size: 3rem;
        color: #fec67d;
        margin-bottom: 0.4rem;

    }
</style>
