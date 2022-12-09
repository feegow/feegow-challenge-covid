
import { cpfMask } from '../../utils/utils';

import React, { useState } from 'react';

import FuncionarioService from '../../services/FuncionarioService.ts';

function CadastrarFuncionario() {

const [nome, setNome] = useState("");
const [cpf, setCpf] = useState("");
const [dtNascimento, setDtNascimento] = useState("");
const [comorbidade, setComorbidade] = useState("");

const [dtPrimeiraDose, setDtPrimeiraDose] = useState("");
const [nomeDose1, setNomeDose1] = useState("");
const [lote1, setLote1] = useState("");
const [dtValidadeDose1, setDtValidadeDose1] = useState("");

const [dtSegundaDose, setDtSegundaDose] = useState("");
const [nomeDose2, setNomeDose2] = useState("");
const [lote2, setLote2] = useState("");
const [dtValidadeDose2, setDtValidadeDose2] = useState("");

const [dtTerceiraDose, setDtTerceiraDose] = useState("");
const [nomeDose3, setNomeDose3] = useState("");
const [lote3, setLote3] = useState("");
const [dtValidadeDose3, setDtValidadeDose3] = useState("");

const handleCpf = (e) => {
  console.log(e);
  setCpf(cpfMask(e))
}

const clickCadastrar = () => {
 
  FuncionarioService.createFuncionario({
    "nome" : nome,
    "cpf" : cpf,
    "dtNascimento" : dtNascimento,
    "comorbidade" : comorbidade
  }).then((r) => {
    console.log(r);
  });
}

  return (
<div className="wrapper mb-5 bg-light" >
  <div className="main col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-5 bg-light" >
  <div className="container bg-light" >
  <div className="div card bg-dark m-5 bg-dark" style={{ borderRadius: "20px", padding: "13px 5px", margin: 10, display: 'contents'}}>
							
                <h3  className="card-header text-center bg-light">CADASTRO DE COLABORADORES QUE FORAM VACINADOS CONTRA COVID-19</h3>
  
              <div className='col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'/>
							<div className="card-body col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style={{ borderRadius: "20px", padding: "13px 5px", margin: 10, display: 'contents'}}>
										<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-secondary" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block'}}>
                  <div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
											<h5 className="form-label text-white mt-2 mb-2">NOME COMPLETO</h5>
											<input className="form-control form-control-lg text-center" onChange={(e) => {setNome(e.target.value)}} type="text" name="name" placeholder="Informe o nome completo"/>
										</div>
										<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
											<h5 className="form-label text-white mt-2 mb-2">CPF</h5>
											<input className="form-control form-control-lg text-center col-6" maxLength="14"  name="cpf" value={cpf} onChange={(e) => handleCpf(e.target.value) } placeholder="Informe seu CPF"/>
										</div>
										<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
											<h5 className="form-label text-white mt-2 mb-2">DATA DE NASCIMENTO</h5>
                      <input className="form-control form-control-lg text-center col-6" onChange={(e) => {setDtNascimento(e.target.value)}} type="date" name="dtNascimento"/>
										</div>
                    <div className="row text-center bg-danger" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block'}}>
                    <h5 className="form-label text-white mt-2 mb-2 text-center">PORTADOR DE COMORBIDADE?</h5>
                    <input type="checkbox" className="form-check-input" onClick={(e) => { setComorbidade(e.target.checked)}} />
										</div>
                  </div>
                  
										<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-primary" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block'}}>
											<h5 className="form-label text-white mt-2 mb-2">DATA DA PRIMEIRA DOSE</h5>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setDtPrimeiraDose(e.target.value)}} type="date" name="dtPrimeira"/>
											<h5 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
											<h6 className="form-label text-white mt-2 mb-2">NOME </h6>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setNomeDose1(e.target.value)}} type="text" name="nomeVacina1" placeholder="Informe o Nome da vacina"/>
											<h6 className="form-label text-white mt-2 mb-2">LOTE </h6>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setLote1(e.target.value)}} type="text" name="loteVacina1" placeholder="Informe o Lote da vacina"/>
											<h6 className="form-label text-white mt-2 mb-2">DATA VALIDADE </h6>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setDtValidadeDose1(e.target.value)}} type="date" name="dtVacina1" placeholder="Informe a data de validade da vacina"/>
										</div>
                  
										<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-warning" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block'}}>
											<h5 className="form-label text-white mt-2 mb-2">DATA DA SEGUNDA DOSE</h5>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setDtSegundaDose(e.target.value)}} type="date" name="dtSegunda" />
                      <h5 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
											<h6 className="form-label text-white mt-2 mb-2">NOME </h6>
                      <input className="form-control form-control-lg text-center col-6" onChange={(e) => {setNomeDose2(e.target.value)}} type="text" name="nomeVacina2" placeholder="Informe o Nome da vacina"/>
											<h6 className="form-label text-white mt-2 mb-2">LOTE </h6>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setLote2(e.target.value)}} type="text" name="loteVacina2" placeholder="Informe o Lote da vacina"/>
											<h6 className="form-label text-white mt-2 mb-2">DATA VALIDADE </h6>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setDtValidadeDose2(e.target.value)}} type="date" name="dtVacina2" placeholder="Informe a data de validade da vacina"/>
										</div>
                  
										<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-info" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block'}}>
											<h5 className="form-label text-white mt-2 mb-2">DATA DA TERCEIRA DOSE</h5>
											<input className="form-control form-control-lg text-center" onChange={(e) => {setDtTerceiraDose(e.target.value)}} type="date" name="dtTerceira" />
                      <h5 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
											<h6 className="form-label text-white mt-2 mb-2">NOME </h6>
                      <input className="form-control form-control-lg text-center col-6" onChange={(e) => {setNomeDose3(e.target.value)}} type="text" name="nomeVacina3" placeholder="Informe o Nome da vacina"/>
											<h6 className="form-label text-white mt-2 mb-2">LOTE </h6>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setLote3(e.target.value)}} type="text" name="loteVacina3" placeholder="Informe o Lote da vacina"/>
											<h6 className="form-label text-white mt-2 mb-2">DATA VALIDADE </h6>
											<input className="form-control form-control-lg text-center col-6" onChange={(e) => {setDtValidadeDose3(e.target.value)}} type="date" name="dtVacina3" placeholder="Informe a data de validade da vacina"/>
										</div>
										
										<div className="text-center mt-3">
											<button className="btn btn-lg btn-primary mb-5" onClick={() => { clickCadastrar() }}>CADASTRAR</button>
			
										</div>
							
							</div>
						</div>
						</div>
						</div>
						</div>

  );
}

export default CadastrarFuncionario;
