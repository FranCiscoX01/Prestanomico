<template>
    <div class="container">
        <div class="row mx-0">
            <div class="col-12">
                <a-form :form="form" :label-col="{ span: 5 }" :wrapper-col="{ span: 12 }" @submit="handleSubmit">
                    <a-form-item label="RFC">
                        <a-input
                            v-decorator="['rfc', { rules: [{ required: true, message: 'Por favor ingrese su RFC!' }] }]"
                        />
                    </a-form-item>
                    <a-form-item :wrapper-col="{ span: 12, offset: 5 }">
                        <a-button type="primary" html-type="submit" :loading="loading">
                            Continuar
                        </a-button>
                    </a-form-item>
                </a-form>
            </div>
        </div>
    </div>
</template>

<script>
import LoginUser from '../services/UserLoginService.vue';
import SearchRFC from '../services/SearchRFCService.vue';

export default {
    data() {
        return {
            formLayout: 'horizontal',
            form: this.$form.createForm(this, { name: 'coordinated' }),
            loading: false,
        }
    },
    mounted() {

    },
    methods: {
        handleSubmit(e) {
            this.loading = true
            e.preventDefault();
            this.form.validateFields((err, values) => {
                if (!err) {
                    console.log('Received values of form: ', values);
                    this.generateToken(values);
                }
            });
        },
        generateToken(rfc) {
            let me = this;
            LoginUser.token(rfc)
            .then((result) => {
                console.log(result);
                me.search(result.token, rfc);
            }).catch((err) => {
                console.log(err);
            });
        },
        search(token, rfc) {
            let me = this;
            SearchRFC.search(token, rfc)
            .then(res => {
                console.log(res)
                me.saveRegistro(res.datos);
            })
            .catch(err => {
                console.log(err);
                if (!err.success) {
                    me.$notification.error({
                        message: err.message,
                        description: 'Ocurrio un error. Intentelo de nuevo.',
                        duration: 0,
                    });
                }
                me.loading = false
            })
        },
        saveRegistro(data) {
            let me = this;
            axios.post('/salvar-registro', {
                datos_credito: data.datos_credito,
                datos_domicilio: data.datos_domicilio,
                datos_personal: data.datos_personales
            })
            .then(res => {
                console.log(res);
                if(res.data.success) {
                    window.location.href = `/proceso/${res.data.rfc}`;
                }
                me.loading = false
            })
            .catch(err => {
                console.log(err);
            })
        }
    },
}
</script>