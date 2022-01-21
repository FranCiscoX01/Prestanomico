<template>
    <div class="row mx-0">
        <div class="col-12">
            <a-result 
                title="Datos de Crédito"
                sub-title="Estos son los datos para el otorgamiento de su crédito. Favor de revisar todo."
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
export default {
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