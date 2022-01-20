<script>
export default new class {
    search(token, rfc) {
        // const config = {
        //     headers: { Authorization: `Bearer ${token}` }
        // };
        // debugger
        return axios.post('https://sitiowebdesarrollo.centralus.cloudapp.azure.com/api/datosRenovacion', {
            rfc: rfc.rfc,
        }, {
            headers: { 'Authorization': `Bearer ${token}` }
        })
        .then(res => {
            // console.log(res);
            return res.data;
        })
        .catch(err => {
            // console.log(err);
            throw err.response.data;
        });
    }
}
</script>