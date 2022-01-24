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
                        v-if="current == steps.length - 1 && !this.aceptadaOferta"
                        type="primary"
                        @click="ofertaAceptada()"
                    >
                        Aceptar
                    </a-button>
                    <a-button
                        v-if="current == steps.length - 1 && !this.aceptadaOferta"
                        type="danger"
                        @click="ofertaRechazada()"
                    >
                        Rechazar
                    </a-button>
                    <a-button v-if="current > 0 && !this.aceptadaOferta" style="margin-left: 8px" @click="prev">
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
import CustomerData from './steps/CustomerDataComponent.vue'
import LoanData from './steps/LoanDataComponent.vue'
import ConfirmOffer from './steps/ConfirmOfferComponent.vue'

export default {
    components: {
        'CustomerData': CustomerData,
        'LoanData': LoanData,
        'ConfirmOffer': ConfirmOffer,
    },
    props: {
        rfc: String,
    },
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
                    component: 'LoanData',
                    props: {
                        rfc: this.rfc
                    }
                },
                {
                    title: 'Oferta',
                    component: 'ConfirmOffer',
                    props: {
                        rfc: this.rfc
                    }
                },
            ],
            aceptadaOferta: false,
        }
    },
    beforeMount() {
        this.getDatosRegistro()
    },
    mounted() {

    },
    methods: {
        getDatosRegistro() {
            let me = this;
            axios.get('/cliente/datos/' + this.rfc)
            .then((result) => {
                console.log(result);
                if (result.data.datos_cliente.status_id == 2) {
                    me.current = 1;
                }
                if (result.data.datos_cliente.status_id == 3 || result.data.datos_cliente.status_id == 4) {
                    me.current = 2;
                    me.aceptadaOferta = true;
                }
                if (result.data.datos_cliente.status_id == 1) {
                    me.current = 0;
                }
                console.log(me.aceptadaOferta);
            }).catch((err) => {
                console.log(err);
            });
        },
        next() {
            this.current++;
            console.log(this.current);
            if(this.current == 1) {
                this.ofertaVista()
            }
        },
        prev() {
            this.current--;
            console.log(this.current);
        },
        ofertaVista() {
            let me = this;
            axios.post('/actualizar-oferta', {
                rfc: me.rfc,
                status: 2,
            })
            .then((result) => {
                console.log(result);
                if (result.data.success) {
                    me.$message.success('Oferta vista.');
                } else {
                    me.$message.warning('Algo salio mal.');
                    me.current--;
                }
            }).catch((err) => {
                console.log(err);
                me.$message.warning('Algo salio mal.');
                me.current--;
            });
        },
        ofertaAceptada() {
            let me = this;
            axios.post('/actualizar-oferta', {
                rfc: me.rfc,
                status: 3,
            })
            .then((result) => {
                console.log(result);
                if (result.data.success) {
                    me.$message.success('Oferta Aceptada.');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    me.$message.warning('Algo salio mal.');
                    me.current--;
                }
            }).catch((err) => {
                console.log(err);
                me.$message.warning('Algo salio mal.');
                me.current--;
            });
        },
        ofertaRechazada() {
            let me = this;
            axios.post('/actualizar-oferta', {
                rfc: me.rfc,
                status: 4,
            })
            .then((result) => {
                console.log(result);
                if (result.data.success) {
                    me.$message.error('Oferta Rechazada.');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    me.$message.warning('Algo salio mal.');
                    me.current--;
                }
            }).catch((err) => {
                console.log(err);
                me.$message.warning('Algo salio mal.');
                me.current--;
            });
        }
    },
}
</script>