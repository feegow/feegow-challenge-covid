import apiService from './Api';

const createFuncionario = (json : any) =>
{

    return apiService.post("setFuncionario", { json }).then((result : any) => {
        return result;
    })
}

export default {
    createFuncionario,
}