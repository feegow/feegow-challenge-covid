import apiService from './Api';

const createFuncionario = (nome : any, cpf : any, dtNascimento : any, comorbidade : any) =>
{

    return apiService.post("setColaborador", { nome, cpf, dtNascimento, comorbidade }).then((result : any) => {
        return result;
    })
}

const updateFuncionario = (nome : any, cpf : any, dtNascimento : any, comorbidade : any, idPrimeiraDoseCovid : any, idSegundaDoseCovid : any, idTerceiraDoseCovid : any) =>
{

    return apiService.put("updateColaborador", { nome, cpf, dtNascimento, comorbidade, idPrimeiraDoseCovid, idSegundaDoseCovid, idTerceiraDoseCovid }).then((result : any) => {
        return result;
    })
}

const createDoseCovid = (idFuncionario : any, dtDoseCovid : any, nome : any, lote : any, dtValidade : any) =>
{

    return apiService.post("setDoseCovid", { idFuncionario, dtDoseCovid, nome, lote, dtValidade }).then((result : any) => {
        return result;
    })
}

const updateDoseCovid = (id : any, dtDoseCovid : any, nome : any, lote : any, dtValidade : any) =>
{

    return apiService.post("updateDoseCovid", { id, dtDoseCovid, nome, lote, dtValidade }).then((result : any) => {
        return result;
    })
}

const findColaborador = (id : any) =>
{

    return apiService.get("getColaboradorById",  {params : {id}}  ).then((result : any) => {
        return result;
    })
}
const findColaboradorAllFilter = (nome : any) =>
{

    return apiService.get("getColaboradorAllFilter",  {params : {nome}}  ).then((result : any) => {
        return result;
    })
}

const findAllColaborador = (body : any) =>
{

    return apiService.get("getColaboradorAll", {params : body} ).then((result : any) => {
        return result;
    })
}

export default {
    createFuncionario,
    createDoseCovid,
    findAllColaborador,
    findColaborador,
    updateFuncionario,
    updateDoseCovid,
    findColaboradorAllFilter
}