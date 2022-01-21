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
                        <a-form-model :label-col="{ span: 6 }" :wrapper-col="{ span: 14 }" ref="ruleForm" :rules="rules" :model="datos.datos_domicilio">
                            <a-form-model-item label="CP" ref="cp" prop="cp">
                                <a-input
                                    v-model="datos.datos_domicilio.cp"
                                    :disabled="!this.nuevoDomicilio"
                                    @blur="generarToken()"
                                />
                            </a-form-model-item>
                            <a-spin tip="Loading..." v-if="!this.nuevoDomicilio || !encontradoCP" :spinning="encontradoCPSelect">
                                <a-form-model-item label="Estado" ref="estado" prop="estado">
                                    <a-input
                                        v-model="datos.datos_domicilio.estado"
                                        :disabled="!this.nuevoDomicilio || !encontradoCP"
                                    />
                                </a-form-model-item>
                                <a-form-model-item label="Municipio" ref="municipio" prop="municipio">
                                    <a-input
                                        v-model="datos.datos_domicilio.municipio"
                                        :disabled="!this.nuevoDomicilio || !encontradoCP"
                                    />
                                </a-form-model-item>
                                <a-form-model-item label="Colonia" v-if="!this.nuevoDomicilio" ref="colonia" prop="colonia">
                                    <a-input
                                        v-model="datos.datos_domicilio.colonia"
                                        :disabled="!this.nuevoDomicilio"
                                    />
                                </a-form-model-item>
                                <a-form-model-item label="Colonia" v-if="this.nuevoDomicilio" ref="colonia" prop="colonia">
                                    <a-select v-model="datos.datos_domicilio.colonia" placeholder="Selecciona colonia">
                                        <a-select-option v-for="c in this.colonias" :key="c.id">
                                            {{ c.colonia }}
                                        </a-select-option>
                                    </a-select>
                                </a-form-model-item>
                            </a-spin>
                            <a-form-model-item label="Calle" ref="calle" prop="calle">
                                <a-input
                                    v-model="datos.datos_domicilio.calle"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-model-item>
                            <a-form-model-item label="No. Exterior" ref="no_exterior" prop="no_exterior">
                                <a-input
                                    v-model="datos.datos_domicilio.no_exterior"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-model-item>
                            <a-form-model-item label="No. Interior" ref="no_interior" prop="no_interior">
                                <a-input
                                    v-model="datos.datos_domicilio.no_interior"
                                    :disabled="!this.nuevoDomicilio"
                                />
                            </a-form-model-item>
                            <a-form-model-item :wrapper-col="{ span: 12, offset: 18 }" :hidden="!this.nuevoDomicilio">
                                <a-button type="primary" @click="handleSubmit">
                                    Guardar
                                </a-button>
                            </a-form-model-item>
                        </a-form-model>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoginUser from '../../services/UserLoginService.vue';
import PostalCode from '../../services/SearchCPService.vue'

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
            rules: {
                cp: [{ required: true, message: 'Por favor ingreso código postal valido', trigger: 'blur' }],
                estado: [{ required: false, message: 'Escriba el estado correspodiente' }],
                municipio: [{ required: false, message: 'Escriba el municipio correspodiente' }],
                colonia: [{ required: true, message: 'Por favor seleccione una colonia', trigger: 'blur' }],
                calle: [{ required: true, message: 'Escriba la calle de su domicilio', trigger: 'change' }],
                no_exterior: [{ required: true, message: 'Escriba el número exterior de su domicilio', trigger: 'blur' }],
                no_interior: [{ required: true, message: 'Escriba el número interior de su domicilio', trigger: 'blur' }],
            },
            datos: {
                datos_cliente: {},
                datos_domicilio: {},
                datos_credito: {}
            },
            cacheDatos: {},
            nuevoDomicilio: false,
            encontradoCP: false,
            encontradoCPSelect: false,
            colonias: [],
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
        handleSubmit() {
            let me = this;
            this.$refs.ruleForm.validate(valid => {
                if (valid) {
                    // alert('submit!');
                    // console.log(this.datos);
                    axios.post('/salvar-cambios-domicilio', {
                        cliente: me.datos.datos_cliente,
                        credito: me.datos.datos_credito,
                        domicilio: me.datos.datos_domicilio,
                    })
                    .then((result) => {
                        console.log(result);
                        if (result.data.success)
                            window.location.reload();
                            
                    }).catch((err) => {
                        console.log(err);
                    });
                } else {
                    console.log('error submit!!');
                    console.log(this.datos);
                    return false;
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
        generarToken() {
            let me = this;
            me.encontradoCP = false;
            me.encontradoCPSelect = true;
            me.colonias = [];

            LoginUser.token()
            .then((result) => {
                console.log(result);
                me.searchCP(result.token, me.datos.datos_domicilio.cp);
            }).catch((err) => {
                console.log(err);
            });
        },
        searchCP(token, cp) {
            let me = this;
            PostalCode.cp(token, cp)
            .then((result) => {
                console.log(result);
                me.datos.datos_domicilio.estado = result.estado;
                me.datos.datos_domicilio.municipio = result.delegacion_municipio;
                me.colonias = result.colonias;

                // me.encontradoCP = true;
                me.encontradoCPSelect = false;
            }).catch((err) => {
                console.log(err);
                me.$notification.error({
                    message: err.message,
                    description: 'Algo salio mal, intentelo nuevamente.',
                });
                me.encontradoCPSelect = false;
            });
        },
    },
}
</script>