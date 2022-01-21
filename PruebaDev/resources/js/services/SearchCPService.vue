<script>
export default new class {
    cp(token, cp) {
        return axios.get(`https://sitiowebdesarrollo.centralus.cloudapp.azure.com/api/codigo_postal/${cp}`, {
            headers: { 'Authorization': `Bearer ${token}` }
        })
        .then((result) => {
            console.log(result);
            return result.data
        }).catch((err) => {
            console.log(err);
            throw err.response.data
        });
    }
}
</script>