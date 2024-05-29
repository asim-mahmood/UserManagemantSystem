<template>
    <div class="custom-bg responsive-font">
        <div class="fiber-tel-nav ">
            <nav class="navbar justify-content-between">
                <div class="">
                    <img src="/images/fiber_logo-updated.png" alt="Flag" class="fiber-logo-width">
                </div>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#payBillModal"
                    @click="openModal()">
                    <i class="fa-solid fa-money-bill"></i> Pay Bill
                </button>
                <a href="/employee/logout" class="btn btn-info admin-login btn-sm"><i
                        class="fa-solid fa-right-from-bracket"></i> <span class="logout">Logout</span></a>
            </nav>
        </div>
        <div class="row no-gutters">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 p-2">
                <div class="text-center complaints-card-body">
                    <i class="fa-solid text-warning fa-triangle-exclamation complaint-dashboard-icon"></i>
                    <p class="mb-1">Total Complaints</p>
                    <h4 class="mb-0">{{ counts.totalComplaintsCount }}</h4>
                    <div class="d-flex justify-content-center">
                        <p class="pr-2 text-size"><span class="text-success">{{ counts.totalSlowBrowsingCount }}</span>
                            Slow Browsing</p>
                        <p class="pr-2 text-size"><span class="text-danger">{{ counts.totalNoInternetCount }}</span> No
                            Internet</p>
                        <p class="text-size"><span class="text-info">{{ counts.totalOtherCount }}</span> Other</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 p-2">
                <div class="text-center complaints-card-body">
                    <i class="fa-solid text-warning fa-clock-rotate-left complaint-dashboard-icon"></i>
                    <p class="mb-1">Pending Complaints</p>
                    <h4 class="mb-0">{{ counts.pendingComplaintsCount }}</h4>
                    <div class="d-flex justify-content-center">
                        <p class="pr-2 text-size"><span class="text-success">{{ counts.pendingSlowBrowsingCount
                                }}</span> Slow Browsing</p>
                        <p class="pr-2 text-size"><span class="text-danger">{{ counts.pendingNoInternetCount }}</span>
                            No Internet</p>
                        <p class="text-size"><span class="text-info">{{ counts.pendingOtherCount }}</span> Other</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 p-2 ">
                <div class="text-center complaints-card-body">
                    <i class="fa-regular fa-circle-check complaint-dashboard-icon"></i>
                    <p class="mb-1">Resolved Complaints</p>
                    <h4 class="mb-0">{{ counts.resolvedComplaintsCount }}</h4>
                    <div class="d-flex justify-content-center">
                        <p class="pr-2 text-size"><span class="text-success">{{ counts.resolvedSlowBrowsingCount
                                }}</span> Slow Browsing</p>
                        <p class="pr-2 text-size"><span class="text-danger">{{ counts.resolvedNoInternetCount }}</span>
                            No Internet</p>
                        <p class="text-size"><span class="text-info">{{ counts.resolvedOtherCount }}</span> Other</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="p-2 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" v-for="(complaint, index) in complaints "
                :key="index">
                <div class="complaints-card-body">
                    <div class="d-flex justify-content-between text-size pb-1 align-items-center">
                        <span class="badge badge-info badge-pill p-2 mr-2 badge-shadow">Token No - {{ index + 1
                            }}</span>
                        <span class="text-size badge badge-light p-2 badge-pill badge-shadow"><i
                                class="fa-solid text-warning fa-calendar-days"></i> {{ complaint.date | dateFormat
                            }}</span>
                        <button type="button" class="btn border-0 badge-pill badge-shadow px-2 btn-sm"
                            @click.prevent="updateComplaintStatus(complaint.id)"
                            :class="complaint.is_active == 0 ? 'btn-danger' : 'btn-success'">
                            {{ complaint.is_active == 0 ? 'Pending' : 'Resolved' }}
                        </button>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge"><i class="fa-solid text-warning fa-id-badge"></i></span>
                                </div>
                                <label class="text-muted mb-0">User Id</label>
                                <p class="mb-0">{{ complaint.customer.user_id }}</p>
                            </div>
                        </div>
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge"><i
                                            class="fa-solid text-warning fa-quote-left"></i></span>
                                </div>
                                <label class="text-muted mb-0">User Name</label>
                                <p class="mb-0">{{ complaint.customer.user_name }}</p>
                            </div>
                        </div>
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge"><i
                                            class="fa-solid text-warning fa-mobile-screen-button"></i></span>
                                </div>
                                <label class="text-muted mb-0">Mobile No</label>
                                <p class="mb-0">{{ complaint.customer.mobile_number != null ?
                        complaint.customer.mobile_number : 'Not Found' }}</p>
                            </div>
                        </div>
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge"><i
                                            class="fa-solid text-warning fa-location-dot"></i></span>
                                </div>
                                <label class="text-muted mb-0">Address</label>
                                <p class="desc-limit mb-0" data-toggle="tooltip" data-placement="top"
                                    :title="complaint.customer.address">{{ complaint.customer.address }}</p>
                            </div>
                        </div>
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge"><i class="fa-solid text-warning fa-user"></i></span>
                                </div>
                                <label class="text-muted mb-0">Complaint By</label>
                                <p class="mb-0">{{ complaint.complaint_by }}</p>
                            </div>
                        </div>
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge "><i
                                            class="fa-solid text-warning fa-triangle-exclamation"></i></span>
                                </div>
                                <label class="text-muted mb-0">Complaint</label>
                                <p class="mb-0">{{ complaint.problem }}</p>
                            </div>
                        </div>
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge"><i
                                            class="fa-solid text-warning fa-mobile-retro"></i></span>
                                </div>
                                <label class="text-muted mb-0">Mobile</label>
                                <p class="mb-0">{{ complaint.mobile }}</p>
                            </div>
                        </div>
                        <div class="col-6 p-1 text-center">
                            <div class="card-radius badge-shadow badge-light p-2">
                                <div class="pb-1">
                                    <span class="custom-badge"><i
                                            class="fa-solid text-warning fa-circle-info"></i></span>
                                </div>
                                <label class="text-muted mb-0">Details</label>
                                <p class="mb-0">{{ complaint.description != null ? complaint.description :
                        'No Details Found' }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pt-2 mb-0">
                        <label class="mb-0">Technician Feedback</label>
                        <textarea type="text" class="form-control mb-0" v-model="complaint.feedback"
                            placeholder="Details" rows="3"></textarea>
                    </div>
                    <div class="text-right mt-2">
                        <button type="button" class="btn btn-outline-info btn-sm" @click="addFeedback(complaint)"><i
                                class="fa-regular fa-paper-plane"></i> Submit Feedback</button>
                    </div>
                </div>
            </div>
        </div>
        <pay-user-bill v-if="is_pay_bill_model" @close-modal="closeModel">
        </pay-user-bill>
    </div>
</template>

<script>
export default {
    name: "employee-dashboard",
    props: ['employee', 'complaints', 'counts'],
    data() {
        return {
            is_pay_bill_model: false
        }
    },


    methods: {
        updateComplaintStatus(id) {
            axios({
                url: `/employee/complaints/update/is-active/${id}`,
                method: 'GET'
            })
                .then(response => {
                    const updatedComplaint = response.data.complaint;

                    console.log(updatedComplaint.id);


                    const index = this.complaints.findIndex(complaint => complaint.id === updatedComplaint.id);

                    if (index !== -1) {
                        this.complaints[index].is_active = updatedComplaint.is_active;
                        this.successToast(response.data.message);
                        window.location.reload();
                    }
                })
                .catch(error => {
                    // Handle errors
                    this.errorToast(response.data.error);
                });
        },
        closeModel() {
            this.is_pay_bill_model = false;
            $(".modal-backdrop").remove();
            $("body").removeClass("modal-open");
        },
        openModal() {
            this.is_pay_bill_model = true;
        },
        addFeedback(complaint) {
            axios({
                url: `/employee/complaints/add/feedback/${complaint.id}`,
                method: 'POST',
                data: { feedback: complaint.feedback }
            })
                .then(response => {
                    this.successToast(response.data.message);
                })
                .catch(error => {
                    // Handle errors
                    this.errorToast(response.data.error);
                });
        }
    }

}
</script>
<style scoped>
.edit-button {
    color: #007bff;
    text-decoration: none;
    transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
}

.custom-bg {
    height: 100vh;
    font-family: calibri;
}

label {
    font-weight: 600 !important;
}

.complaints-card-body {
    padding: 1rem;
    border: 2px solid #17a2b8;
    border-radius: 8px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px;
    background-color: white;

}

.text-size {
    font-size: 0.8rem;
}

/* .custom-badge {
    display: inline-block;
    width: 23px; 
    height: 23px; 
    border-radius: 50%;
    background-color: #ffc273;
    border:1px solid #ffa327;
    align-items: center;

    justify-content: center;
} */
.custom-badge i {
    color: #f8b966;
    font-size: 1.5rem;
    text-shadow: 1px 1px #787878;
}

.badge-shadow {
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

fieldset {
    border: none !important;
    padding: 0 0.5em 0em 0.5em !important;
    margin: 0 !important;
    border-radius: 0.6rem;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}

legend {
    width: inherit;
    padding: 0 0.8rem;
    border-bottom: none;
    font-size: 0.8rem;
    font-weight: bold;
    font-family: calibri !important;
}

.complaint-dashboard-icon {
    font-size: 3rem;
    color: #ffc107;
    margin-bottom: 0.4rem;

}

.fiber-logo-width {
    width: 9rem !important;
}

.admin-login {
    background-color: #144a5b !important;
    border-color: 1px solid #024154 !important;
    color: #ffffff;
    border-radius: 2rem !important;
    padding: 0.3rem 1rem !important;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;

}

.fiber-tel-nav {
    background-color: rgba(255, 255, 255, 0.526) !important;
    backdrop-filter: blur(2px) !important;
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.551) 0px 3px 3px 0px !important;
}

.submit_button {
    position: relative;
    right: 13px;
    bottom: 71px;

}

.primary-border {
    border: 2px solid #ffc273;
    border-radius: 5px;
}

.card-radius {
    border-radius: 10px;
}

@media (max-width:500px) {

    .responsive-font,
    p,
    span,
    textarea,
    button,
    a,
    label {
        font-size: 85% !important;
    }

    .complaint-dashboard-icon {
        font-size: 2rem;
    }
}

@media screen and (max-width: 320px) {
    .fiber-logo-width {
        width: 7rem !important;
    }

    .logout {
        display: none;
    }
}
</style>