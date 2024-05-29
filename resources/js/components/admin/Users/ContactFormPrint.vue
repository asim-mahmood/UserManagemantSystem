 <template>
    <div class="modal fade" id="contactFormPrint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-target=".bd-example-modal-lg" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-0 modal-xl">
            <div class="modal-content">
                <div class="modal-header">        
                    <h5>User Contract Form</h5>            
                    <div class="">                       
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="$emit('close-modal')"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body p-3">
                    <form id="myForm">
                        <div id="printForm">
                            <div class="d-flex justify-content-between">
                                <div class="" style="max-width: 200px; ">              
                                    <img src="/images/connect_logo.png" alt="Connect" style="max-width: 100%; height: auto; "> 
                                    <p class="text-right">Communication (Pvt Ltd)</p>                 
                                </div>
                                <div class="" style="max-width: 200px; ">
                                    <img src="/images/fiber_logo-updated.png" alt="Fiber Telecom" style="max-width: 100%; height: auto; ">
                                    <p class="text-right">Internet Service</p>  
                                </div>
                            </div>
                            <hr style=" border: 2px solid">
                            <div>
                                <div>
                                    <h4 class="text-center">Registration Form for New Internet Connection</h4>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-1">Do You Have Valid National Identity Card?</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center pr-5">
                                            <label class="pr-4 mb-1">Yes</label>
                                            <input type="checkbox" class="">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <label class="pr-4 mb-1">No</label>
                                            <input type="checkbox" class="">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <p class="pr-2 font-weight-bold">Date:</p>
                                        <div class="">
                                            <span>{{ user_data.today }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-4">
                                <h5>Customer Information</h5>
                                <div class="border border-dark">
                                    <div class="border-bottom pl-3 border-dark pt-2 row no-gutters">
                                        <div class="col-2">
                                            <p class="font-weight-bold">Customer Name:</p>
                                        </div>
                                        <div class="col-7">
                                            <p> {{ user_data.user_name }} <span class="font-weight-bold"> S/o </span><span>{{ user_data.father_name }} </span></p>
                                        </div>
                                        <div class="col-1">
                                            <p class="font-weight-bold">User Id:</p>
                                        </div>
                                        <div class="col-2">
                                            <p>{{ user_data.user_id }}</p>
                                        </div>
                                    </div>
                                    <div class="border-bottom pl-3 border-dark pt-2 row no-gutters">
                                        <div class="col-2">
                                            <p class="font-weight-bold">CNIC No:</p>
                                        </div>
                                        <div class="col-10">
                                            <p class="">{{ user_data.cnic }}</p>
                                        </div>
                                    </div>
                                    <div class="border-bottom pl-3 border-dark pt-2 row no-gutters">
                                        <div class="col-2">
                                            <p class="font-weight-bold">Mobile No:</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="">{{ user_data.mobile_number }}</p>
                                        </div>
                                        <div class="col-5">
                                            <p class="">{{ user_data.mobile_number2 }}</p>
                                        </div>
                                        
                                    </div>
                                    <div class="border-bottom pl-3 border-dark pt-2 row no-gutters">
                                        <div class="col-2">
                                            <p class="font-weight-bold">Address:</p>
                                        </div>
                                        <div class="col-10 text-wrap">
                                            <p class="">{{ user_data.address }}</p>
                                        </div>
                                    </div>
                                    <div class="pl-3 pt-2 row no-gutters" >
                                        <div class="col-2">
                                            <p class="font-weight-bold">Email Address:</p>
                                        </div>
                                        <div class="col-10">
                                            <p class="">{{ user_data.email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="">
                                <h5 class="">Available Internet Packages</h5>
                                <div class="row no-gutters border p-2 border-secondary">
                                    <div class="d-flex align-items-center col-1">
                                        <label class="pl-2 mb-1"><span>{{ user_data.package_id }}</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>3</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>4</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>5</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>6</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>8</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>10</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>12</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>15</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>16</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>20</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>25</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-1">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>30</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center col-2">
                                        <input type="checkbox" class="">
                                        <label class="pl-2 mb-1"><span>__</span> Mbps</label>
                                    </div>
                                    <div class="d-flex align-items-center pr-5 col-2">
                                       <p></p>
                                    </div>
                                </div>
                            </div> -->
                            <h5>Package Information</h5>
                            <div class="row no-gutters border p-2 mt-4 border-secondary">
                                <div class="col-12">
                                    <div class="row no-gutters">
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Speed: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>{{ user_data.package.speed }}</span>
                                        </div>
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Package: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>{{ user_data.package_type }}</span>
                                        </div>
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Price: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>Rs. {{ user_data.price }} </span>
                                        </div>
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Installation Charges: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>Rs. {{ user_data.installation_charges }}</span>
                                        </div>
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Device Charges: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>Rs. {{ user_data.device_charges }}</span>
                                        </div>
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Security: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>Rs. {{ user_data.security }}</span>
                                        </div>
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Device Property: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>{{ user_data.device_property }}</span>
                                        </div>
                                        
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Device Purchasing: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>{{ user_data.purchasing }}</span>
                                        </div>
                                        <div class="col-2">
                                            <p class="pl-2 mb-1 font-weight-bold">Total Payment: </p>
                                        </div>
                                        <div class="col-2">
                                            <span>Rs. <strong>{{ user_data.total_bill }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex py-4">
                                <h6 class="font-weight-bold pr-3">Note:</h6>
                                <h6 class="font-weight-bold">All internet packages include unlimited data and include taxes.</h6>
                            </div>
                            <div class="border-top pt-5 border-secondary">
                                <h5>Term & Conditions</h5>
                                <p>Please read the following term and conditions carefully before signing the customer Agreement Form between Connect Communication (Pvt Ltd) and the Customer.</p>
                                <ul>
                                    <li>Rates and Charges as long as customer subscribe the service, Customer agrees to pay in advance the applicable service rate for service plan. </li>
                                    <li>If customer break the devices or water Damage or not return customer will pay devices full payment.</li>
                                    <li>The Company will take back those equipment’s which are property of Connect Communication after closing connection.</li>
                                    <li>Customer is responsible to return company’s equipment’s if not company can sue for equipment.</li>
                                    <li>Internet Connection Sharing strictly prohibited.</li>
                                    <li>Installation Charges None Refundable.</li>
                                    <li>Monthly Billing will be in advance.</li>
                                    <li>Internet package consist on 30 days. </li>
                                </ul>
                                <h5>Usage the Customer shall</h5>
                                <ol class="mb-5">
                                    <li> Not use the internet service for any unlawful purposes.</li>
                                    <li>Not attempt to gain unauthorized access to any computer system connected to the internet.</li>
                                    <li>Not introduce any computer virus into the internet or the computer systems.</li>
                                    <li>Comply with all provisions of Pakistan Telecommunication (re-organization) Act 1996.</li>
                                    <li>Any unlawful activity from provided IP from Connect Communication to Customer he/she        well be held responsible</li>
                                </ol>
                                <div class="d-flex justify-content-between px-2 border-bottom py-2" style="margin-top: 11rem !important;">
                                    <p class="font-weight-bold">Sales Representative</p>
                                    <p class="font-weight-bold">Customer's Signature</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-right p-2">
                            <button type="button" class="btn btn-outline-info mr-3 px-5" @click="printFormContent">Print
                             </button>
                            <button type="button" class="btn btn-outline-danger px-5" data-dismiss="modal" @click="$emit('close-modal')"> CLOSE</button>
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
    name: 'contact-form-print',
    props: ['user_data'],
    components: { DatePicker },
    data() {
        return {                     
            loading: false,
            modalContent: ''           
        }
    },
    methods: {       
        printFormContent() {
            const formToPrint = document.getElementById('printForm'); // Replace 'printForm' with your actual form ID
            // Create a new window
            const printWindow = window.open('', '_blank');
            // Get the HTML content of the form
            const formHTML = formToPrint.outerHTML;
            // Include Bootstrap stylesheet in the new window
            const bootstrapLink = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
            // Include print styles for Bootstrap
            const printStyles = '<style type="text/css">@media print{body{visibility:visible!important}.print-section{display:block!important}.d-print-none{display:none!important}}</style>';
            // Write the form HTML, Bootstrap stylesheet, and print styles to the new window
            printWindow.document.write(`
                <html>
                <head>
                    <title>Print Form</title>
                    ${bootstrapLink}
                    ${printStyles}
                </head>
                <body>${formHTML}</body>
                </html>
            `);
            // Close the document for writing
            printWindow.document.close();
            // Introduce a small delay before printing
            setTimeout(() => {
                // Print the new window
                printWindow.print();
            }, 400); // Adjust the delay as needed
        }  
    },   
}
</script>
<style scoped>
        .custom-header {
            position: relative;
            display: flex;
            align-items: center;
        }

        .custom-header::before,
        .custom-header::after {
            content: "";
            flex: 1;
            height: 1px; /* Adjust the height of the line as needed */
            background-color: rgba(128, 128, 128, 0.708); /* Adjust the color of the line as needed */
            margin: 0px 10px; /* Adjust the spacing between the line and text as needed */
        }
</style>
