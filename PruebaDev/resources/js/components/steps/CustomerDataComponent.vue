<template>
    <div class="row mx-0">
        <div class="col-12 my-3">
            <h4 class="text-center">Datos Cliente</h4>
            <div class="container">
                <div class="row mx-0">
                    <div class="col-12">
                        <a-form :label-col="{ span: 6 }" :wrapper-col="{ span: 14 }" >
                            <a-form-item label="Nombre">
                                <a-input
                                    v-model="datos.datos_cliente.nombre"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Apellido Paterno">
                                <a-input
                                    v-model="datos.datos_cliente.apellido_paterno"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Apellido Materno">
                                <a-input
                                    v-model="datos.datos_cliente.apellido_materno"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="RFC">
                                <a-input
                                    v-model="datos.datos_cliente.rfc"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Fecha de Nacimiento">
                                <a-input
                                    v-model="datos.datos_cliente.fecha_nacimiento"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Ingresos">
                                <a-input
                                    v-model="datos.datos_cliente.ingresos"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Egresos">
                                <a-input
                                    v-model="datos.datos_cliente.egresos"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="No. de Dependientes">
                                <a-input
                                    v-model="datos.datos_cliente.no_dependientes"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Estado Civil">
                                <a-input
                                    v-model="datos.datos_cliente.estado_civil"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Genero">
                                <a-input
                                    v-model="datos.datos_cliente.genero"
                                    disabled
                                />
                            </a-form-item>
                            <a-form-item label="Último grado de Estudios">
                                <a-input
                                    v-model="datos.datos_cliente.ultimo_grado_estudios"
                                    disabled
                                />
                            </a-form-item>
                            <!-- <a-form-item :wrapper-col="{ span: 12, offset: 18 }">
                                <a-button type="primary" html-type="submit">
                                    Guardar
                                </a-button>
                            </a-form-item> -->
                        </a-form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-3">
            <h4 class="text-center">Datos Domicilio</h4>
            <p class="text-center">
                Desea utilizar los datos de domicilio actual?
                <a-switch default-checked @change="onChangeDomicilio">
                    <a-icon slot="checkedChildren" type="check" />
                    <a-icon slot="unCheckedChildren" type="close" />
                </a-switch>
            </p>
            <div class="container">
                <div class="row mx-0">
                    <div class="col-12">
                        <a-form :label-col="{ span: 6 }" :wrapper-col="{ span: 14 }" @submit="handleSubmit">
                            <a-form-item label="CP">
                                <a-input
                                    v-model="datos.datos_domicilio.cp"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-item>
                            <a-form-item label="Estado">
                                <a-input
                                    v-model="datos.datos_domicilio.estado"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-item>
                            <a-form-item label="Municipio">
                                <a-input
                                    v-model="datos.datos_domicilio.municipio"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-item>
                            <a-form-item label="Colonia">
                                <a-input
                                    v-model="datos.datos_domicilio.colonia"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-item>
                            <a-form-item label="Calle">
                                <a-input
                                    v-model="datos.datos_domicilio.calle"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-item>
                            <a-form-item label="No. Exterior">
                                <a-input
                                    v-model="datos.datos_domicilio.no_exterior"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-item>
                            <a-form-item label="No. Interior">
                                <a-input
                                    v-model="datos.datos_domicilio.no_interior"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-item>
                            <a-form-item :wrapper-col="{ span: 12, offset: 18 }" :hidden="!this.nuevoDomicilio">
                                <a-button type="primary" html-type="submit">
                                    Guardar
                                </a-button>
                            </a-form-item>
                        </a-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        rfc: String
    },
    beforeMount() {
        
    },
    mounted() {
        this.getDatosRegistro();
    },
    data() {
        return {
            formLayout: 'horizontal',
            form: this.$form.createForm(this, { name: 'coordinated' }),
            datos: {
                datos_cliente: {},
                datos_domicilio: {},
                datos_credito: {}
            },
            cacheDatos: {},
            nuevoDomicilio: false,
        }
    },
    methods: {
        getDatosRegistro() {
            let me = this;
            axios.get('/cliente/datos/' + this.rfc)
            .then((result) => {
                console.log(result);
                me.datos.datos_cliente = result.data.datos_cliente;
                me.datos.datos_domicilio = result.data.datos_domicilio;
                me.datos.datos_credito = result.data.datos_credito;
                me.cacheDatos = result.data;
            }).catch((err) => {
                console.log(err);
            });
        },
        handleSubmit(e) {
            e.preventDefault();
            this.form.validateFields((err, values) => {
                if (!err) {
                    console.log('Received values of form: ', values);
                }
            });
        },
        handleSelectChange(value) {
            console.log(value);
            this.form.setFieldsValue({
                note: `Hi, ${value === 'male' ? 'man' : 'lady'}!`,
            });
        },
        onChangeDomicilio(checked) {
            this.nuevoDomicilio = !checked;
            if (!this.nuevoDomicilio) {
                this.datos.datos_domicilio = this.cacheDatos.datos_domicilio;
            } else if (this.nuevoDomicilio) {
                this.datos.datos_domicilio = {};
            }
        },
    },
}
</script>