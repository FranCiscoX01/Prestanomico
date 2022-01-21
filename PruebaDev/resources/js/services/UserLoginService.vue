<script>
export default new class {
    token() {
        return axios.post('https://sitiowebdesarrollo.centralus.cloudapp.azure.com/api/login', {
            email: 'javier030205bt@gmail.com',
            password: 'Javier.2022PT'
        })
        .then(res => {
            // console.log(res);
            return res.data;
        })
        .catch(err => {
            console.log(err);
            throw err.response.data;
        });
    }
}
</script>
