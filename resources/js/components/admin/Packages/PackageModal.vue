<template>
    <div class="modal fade mt-5" id="packageModal" tabindex="-1" aria-hidden="true" data-target=".bd-example-modal-lg"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-0 ">
            <form @submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalType }} Package</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="$emit('close-modal')"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="circle-container">
                            <div class="circle">
                                <!-- <i class="icon fas fa-plus"></i> -->
                                <i class="icon material-symbols-outlined ">format_list_bulleted_add</i>
                            </div>
                        </div>
                        <div class="mt-5 package-container px-3 pb-2 pt-5">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="mb-0">Package Name <sup>*</sup></label>
                                        <input type="text" v-model="data.name" class="form-control"
                                            placeholder="Package Name" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="mb-0">Speed <sup>*</sup></label>
                                        <input type="text" v-model="data.speed" class="form-control" placeholder="Mbps"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="mb-0">Price <sup>*</sup></label>
                                        <input type="number" v-model="data.price" class="form-control"
                                            placeholder="00.00 Pkr" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="mb-0">Cost</label>
                                        <input type="number" v-model="data.cost" class="form-control"
                                            placeholder="00.00 Pkr">
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
                        <button type="submit" class="btn btn-outline-info mr-2 px-5" :disabled="is_user_id_taken"
                            v-if="modalType == 'Edit'"> Update</button>
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
export default {
    name: 'package-modal',
    props: ['modalType', 'objId'],
    components: { DatePicker },
    data() {
        return {
            data: {
                'name': '',
                'speed': '',
                'price': '',
                'cost': ''
            },
            loading: false,
        }
    },
    methods: {
        save() {
            this.loading = true;
            let url = this.modalType == 'Add' ? '/admin/packages' : `/admin/packages/${this.objId}`;
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
            console.log('here');
            this.loading = true
            axios({
                url: `/admin/packages/${this.objId}/edit`,
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
        closeTab(tabId) {
            this.items = this.items.filter(item => item.id !== tabId)
            if (this.items.length === 0) {
                this.$emit('close-modal')
            }
        }
    },
    mounted() {
        if (this.modalType === 'Edit' && this.objId) {
            this.getDataForEdit();
        }
    },
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
    /* Adjust the height as needed */
    position: absolute;
    top: 24px;
    left: 201px;

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
