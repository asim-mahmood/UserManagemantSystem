<template>
    <div class="modal fade mt-5" id="addAccountModal" tabindex="-1" aria-hidden="true" data-target=".bd-example-modal-lg" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-0 ">
            <form @submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{modalType}} Account</h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="$emit('close-modal')"
                        ><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-3">                   
                        <div class="circle-container">
                            <div class="circle">
                                <i class="icon fa-solid fa-sack-dollar"></i>
                            </div>
                        </div>
                        <div class="mt-5 package-container px-3 pb-2 pt-5">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="mb-0">Account Title <sup>*</sup></label>
                                        <input type="text" v-model="data.name" class="form-control" placeholder="Account Name" required>
                                    </div>    
                                    <div class="form-group">
                                        <label class="mb-0">Opening Balance <sup>*</sup></label>
                                        <input type="number" v-model="data.opening_balance" class="form-control" placeholder="Amount" required>
                                    </div>                                   
                                    <div class="form-group">
                                        <label class="mb-0">Account Head <sup>*</sup></label>
                                        <select class="form-control" v-model="data.head_id" required>
                                            <option value="" selected disabled>Select Head Type</option>
                                            <option v-for="obj in account_heads" :key="obj.id" :value="obj.id">
                                                {{ obj.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right p-2 border-top">
                        <button type="submit" class="btn btn-outline-info mr-2 px-5" v-if="modalType == 'Add'">
                            <span v-if="!loading">Save</span>                            
                            <span v-if="loading" class="spinner-border spinner-sm"></span>
                        </button>
                        <button type="submit" class="btn btn-outline-info mr-2 px-5"  v-if="modalType == 'Edit'"> Update</button>
                        <button type="button" class="btn btn-outline-danger px-5" @click="$emit('close-modal')"> Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    export default {
        name:'add-account-modal',
        props :['modalType', 'objId'],
        components: { DatePicker },
        data() {
            return {
                data: {                                       
                    'name' : '',
                    'head_id' : '',
                    'opening_balance' : ''
                },
                account_heads: '',
                loading : false,
            }
        },
        methods: {
            save() {
                this.loading = true;
                let url = this.modalType == 'Add' ? '/admin/accounts' : `/admin/accounts/${this.objId}`;
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
                this.loading = true
                axios({
                    url: `/admin/accounts/${this.objId}/edit`,
                    method: 'GET',
                })
                .then(response => {
                    console.log('Getting data for edit...');
                    this.loading = false
                    this.data = response.data.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
            },
            getFormData() {                
                axios({
                    url: `/admin/accounts/get/form/data`,
                    method: 'GET',
                })
                .then(response => {                    
                    console.log('Form data received:', response.data);
                    this.account_heads = response.data.data
                    
                })
                .catch(error => {
                    console.error('Error fetching form data:', error);
                    this.errorToast(error.response.error)
                })
            },
            closeTab(tabId) {
                this.items = this.items.filter(item => item.id !== tabId)
                if (this.items.length === 0) {
                    this.$emit('close-modal')
                }
            }
        },
        mounted() {
            this.getFormData();
            if (this.modalType === 'Edit' && this.objId) {
                this.getDataForEdit();
            }
        },
    }
</script>
<style scoped>
    .form-header{
        background-color: #eaf5ff;
    }
    .form-header, h6 ,i{
        color:#51aafc ;
    }
    .user {
        display: inline-block; /* Ensures that the element is treated as a block, but lays out as an inline-level element */
        overflow: hidden; /* Prevents content from overflowing */
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
 /* Adjust the height as needed */
      position: absolute;
      top: 24px;
      left: 201px;

    }

    .circle {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 80px; /* Adjust the width as needed */
      height: 80px; /* Adjust the height as needed */
      background-color: orange;
      border: 8px solid rgb(255, 255, 255);
      border-radius: 50%;
      box-shadow: 1px 4px 8px rgba(0, 0, 0, 0.377); /* Adjust the shadow as needed */
    }

    .icon {
      font-size: 2rem; /* Adjust the font size as needed */
      color: white;
      text-shadow: 1px 4px 4px rgba(0, 0, 0, 0.267);
      font-size: 2.5rem;
    }
    .package-container{
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.377); 
    }
</style>
