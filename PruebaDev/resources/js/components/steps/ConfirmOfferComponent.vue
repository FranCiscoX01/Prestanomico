<template>
    <div class="row mx-0">
        <div class="col-12" v-if="cliente.status_id == 3">
            <a-result
                status="success"
                title="Oferta de Crédito Aceptada!"
                sub-title="Estaremos contactandolo en estos días. Dentro de un mes podrá realizar otra solicitud de crédito."
            >
                <template #extra>
                    <div class="row mx-0">
                        <div class="col-12 text-center">
                            <h4>Faltan:</h4>
                        </div>
                        <div class="col-12 mt-2 mb-2">
                            <Countdown :deadline="cliente.nueva_fecha"></Countdown>
                        </div>
                        <div class="col-12 text-center">
                            <p>para poder realizar una nueva solicitud.</p>
                        </div>
                    </div>
                </template>
            </a-result>
        </div>
        <div class="col-12" v-if="cliente.status_id == 4">
            <a-result 
                title="Oferta Rechazada"
                sub-title="La oferta fue rechazada, dentro de un mes podrá realizar otra solicitud de crédito."
            >
                <template #icon>
                    <a-icon type="frown" theme="twoTone" />
                </template>
                <template #extra>
                    <div class="row mx-0">
                        <div class="col-12 text-center">
                            <h4>Faltan:</h4>
                        </div>
                        <div class="col-12 mt-2 mb-2">
                            <Countdown :deadline="cliente.nueva_fecha"></Countdown>
                        </div>
                        <div class="col-12 text-center">
                            <p>para poder realizar una nueva solicitud.</p>
                        </div>
                    </div>
                </template>
            </a-result>
        </div>
        <div class="col-12" v-if="cliente.status_id == 2">
            <a-result 
                status="404" 
                :title="'Hola ' + cliente.nombre + ' ' + cliente.apellido_paterno + ' ' + cliente.apellido_materno" 
                sub-title="Está de acuerdo con la oferta para proporcionarle el crédito?"
            >
                <template #extra>
                    <div class="row mx-0">
                        <div class="col-md-4 col-6 offset-md-3 text-center">
                            <h5>Monto</h5>
                        </div>
                        <div class="col-5 text-left">
                            {{ formatterMoney(credito.monto) }}
                        </div>
                        <div class="col-md-4 col-6 offset-md-3 text-center">
                            <h5>Plazo</h5>
                        </div>
                        <div class="col-5 text-left">
                            {{ credito.plazo }}
                        </div>
                        <div class="col-md-4 col-6 offset-md-3 text-center">
                            <h5>Pagos Mensuales</h5>
                        </div>
                        <div class="col-5 text-left">
                            {{ formatterMoney(credito.pago_mensual) }}
                        </div>
                        <div class="col-md-4 col-6 offset-md-3 text-center">
                            <h5>Tasa de Intereses</h5>
                        </div>
                        <div class="col-5 text-left">
                            {{ credito.tasa_interes }}
                        </div>
                    </div>
                </template>
            </a-result>
        </div>
    </div>
</template>

<script>
import Countdown from 'vuejs-countdown'

export default {
    components: { Countdown },
    props: {
        rfc: String
    },
    data() {
        return {
            credito: {},
            cliente: {},
        }
    },
    mounted() {
        this.getDatosCredito();
    },
    methods: {
        getDatosCredito() {
            let me = this;
            axios.get('/credito/datos/' + this.rfc)
            .then((result) => {
                console.log(result);
                me.credito = result.data.datos_credito;
                me.cliente = result.data.datos_cliente;
            }).catch((err) => {
                console.log(err);
            });
        },
        formatterMoney(money) {
            const formatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            })

            return formatter.format(money)
        },
    },
}
</script>