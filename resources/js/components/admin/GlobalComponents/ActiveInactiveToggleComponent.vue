<template>
    <div class="">
      <label>
          <input type="checkbox" class="toggle-checkbox">
          <div class="toggle-container">
              <div class="toggle-slider"></div>
              <div class="toggle-text"></div>
          </div>
      </label>
    </div>
</template>

<script>
export default {
    name: "active-inactive-toggle-component",
    props:[
    ],
    data(){
        return {
            
        }
    },
    methods: {
        
    }
}
</script>
<style scoped>
   .toggle-checkbox {
            display: none;
        }
        .toggle-container {
            position: relative;
            width: 93px;
            height: 30px;
            background-color: #ccc;
            border-radius: 15px;
            cursor: pointer;
        }

        .toggle-slider {
            position: absolute;
            top: 3px;
            left: 4px;
            width: 24px;
            height: 24px;
            background-color: #fff;
            border-radius: 50%;
            transition: 0.6s;
        }

        .toggle-text {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translate(0, -50%);
            width: 100%;
            text-align: center;
            font-size: 0.7rem;
            z-index: 1;
        }

        .toggle-checkbox + .toggle-container {
            background-color: #ccc;
        }

        .toggle-checkbox:not(:checked) + .toggle-container .toggle-text::before {
            content: "Active";
            color: white;
        }

        .toggle-checkbox:checked + .toggle-container {
            background-color: #b0b0b0;
        }
        .toggle-checkbox + .toggle-container {
            background-color: #ffb327;
        }

        .toggle-checkbox:checked + .toggle-container .toggle-slider {
            left: 65px;
        }


        .toggle-checkbox:checked + .toggle-container .toggle-text::before {
            content: "In-Active";
            color: #fff;

            padding-right: 42px;
        }

</style>
