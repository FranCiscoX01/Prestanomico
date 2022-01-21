<template>
    <div class="container">
        <div class="row mx-0">
            <div class="col-12">
                <a-steps :current="current">
                    <a-step v-for="item in steps" :key="item.title" :title="item.title" />
                </a-steps>
                <div class="steps-content">
                    <component :is="steps[current].component" v-bind="steps[current].props"></component>
                </div>
                <div class="steps-action">
                    <a-button v-if="current < steps.length - 1" type="primary" @click="next">
                        Continuar
                    </a-button>
                    <a-button
                        v-if="current == steps.length - 1"
                        type="primary"
                        @click="$message.success('Processing complete!')"
                    >
                        Done
                    </a-button>
                    <a-button v-if="current > 0" style="margin-left: 8px" @click="prev">
                        Regresar
                    </a-button>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.steps-content {
    margin-top: 16px;
    border: 1px dashed #e9e9e9;
    border-radius: 6px;
    background-color: #fafafa;
    min-height: 200px;
    /* text-align: center; */
    padding-top: 80px;
}

.steps-action {
    margin-top: 24px;
}
</style>
<script>
import LoginUser from '../services/UserLoginService.vue';
import CustomerData from './steps/CustomerDataComponent.vue'

export default {
    components: {
        'CustomerData': CustomerData,
    },
    props: ['rfc'],
    data() {
        return {
            current: 0,
            steps: [
                {
                    title: 'Datos Personales',
                    component: 'CustomerData',
                    props: {
                        rfc: this.rfc
                    }
                },
                {
                    title: 'Datos de Crédito',
                    component: 'Second-content',
                },
                {
                    title: 'Oferta',
                    component: 'Last-content',
                },
            ],
        }
    },
    mounted() {
        
    },
    methods: {
        next() {
            this.current++;
        },
        prev() {
            this.current--;
        },
    },
}
</script>